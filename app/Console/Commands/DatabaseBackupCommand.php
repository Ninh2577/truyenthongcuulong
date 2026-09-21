<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class DatabaseBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database
                            {--keep= : Number of recent backups to keep (defaults to config)}
                            {--no-verify : Skip post-dump integrity verification}
                            {--no-compress : Do not compress the dump with GZIP}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a secure database backup in private storage with retention and integrity verification';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $startTime = microtime(true);
        $lockTimeout = (int) config('backup.lock_timeout', 3600);
        $lock = Cache::lock('database-backup-execution-lock', $lockTimeout);

        if (!$lock->get()) {
            $msg = 'Another database backup process is currently running. Skipping execution to avoid overlap.';
            $this->warn($msg);
            Log::warning($msg);
            return Command::SUCCESS;
        }

        try {
            $this->info('Starting database backup...');
            Log::info('Database backup started.');

            // 1. Resolve database connection details
            $defaultConn = Config::get('database.default', 'mysql');
            $connConfig = Config::get("database.connections.{$defaultConn}");

            if (!$connConfig || ($connConfig['driver'] ?? '') !== 'mysql') {
                $errorMsg = "Unsupported database driver [{$connConfig['driver']}]. Only MySQL is supported.";
                $this->error($errorMsg);
                Log::error("Database backup failed: {$errorMsg}");
                return Command::FAILURE;
            }

            $host = $connConfig['host'] ?? '127.0.0.1';
            $port = (int) ($connConfig['port'] ?? 3306);
            $database = $connConfig['database'] ?? '';
            $username = $connConfig['username'] ?? 'root';
            $password = $connConfig['password'] ?? '';

            if (empty($database)) {
                $errorMsg = 'Database name is empty in configuration.';
                $this->error($errorMsg);
                Log::error("Database backup failed: {$errorMsg}");
                return Command::FAILURE;
            }

            // 2. Find mysqldump binary
            $dumpBinary = $this->resolveMysqldumpBinary();
            if (!$dumpBinary) {
                $errorMsg = 'Could not locate a functional mysqldump binary on the system.';
                $this->error($errorMsg);
                Log::error("Database backup failed: {$errorMsg}");
                return Command::FAILURE;
            }
            $this->line("Using dump binary: <comment>{$dumpBinary}</comment>");

            // 3. Resolve destination directories
            $diskName = config('backup.disk', 'local');
            $subPath = trim(config('backup.path', 'backups'), '/\\');
            $disk = Storage::disk($diskName);
            $fullBackupDir = $disk->path($subPath);

            if (!is_dir($fullBackupDir)) {
                mkdir($fullBackupDir, 0700, true);
            }

            $tmpDir = $fullBackupDir . DIRECTORY_SEPARATOR . '.tmp';
            if (!is_dir($tmpDir)) {
                mkdir($tmpDir, 0700, true);
            }

            // Ensure .gitignore exists in backups directory
            $gitignoreFile = $fullBackupDir . DIRECTORY_SEPARATOR . '.gitignore';
            if (!file_exists($gitignoreFile)) {
                file_put_contents($gitignoreFile, "*\n!.gitignore\n");
            }

            // 4. Create secure temporary MySQL credentials file (--defaults-extra-file)
            $timestamp = date('Y-m-d-His');
            $baseFilename = "backup-{$timestamp}";
            $rawSqlPath = $tmpDir . DIRECTORY_SEPARATOR . "{$baseFilename}.sql";

            $cnfFile = tempnam(sys_get_temp_dir(), 'my_bk_');
            $cnfContent = "[client]\n";
            $cnfContent .= "host=\"{$host}\"\n";
            $cnfContent .= "port={$port}\n";
            $cnfContent .= "user=\"{$username}\"\n";
            if (!empty($password)) {
                $cnfContent .= "password=\"{$password}\"\n";
            }
            file_put_contents($cnfFile, $cnfContent);
            @chmod($cnfFile, 0600);

            // 5. Execute mysqldump
            $cmd = sprintf(
                '"%s" --defaults-extra-file="%s" --single-transaction --quick --skip-lock-tables --default-character-set=utf8mb4 "%s" > "%s"',
                $dumpBinary,
                $cnfFile,
                $database,
                $rawSqlPath
            );

            $dumpOutput = [];
            $dumpCode = -1;
            exec($cmd, $dumpOutput, $dumpCode);

            // Immediately destroy credentials file
            @unlink($cnfFile);

            if ($dumpCode !== 0 || !file_exists($rawSqlPath) || filesize($rawSqlPath) === 0) {
                $errorMsg = "mysqldump exited with error code [{$dumpCode}].";
                $this->error($errorMsg);
                Log::error("Database backup failed: {$errorMsg}");
                @unlink($rawSqlPath);
                return Command::FAILURE;
            }

            $rawSize = filesize($rawSqlPath);
            $this->line("Dump completed. Raw SQL size: " . number_format($rawSize) . " bytes.");

            // 6. Compress with GZIP (unless --no-compress)
            $shouldCompress = config('backup.compress', true) && !$this->option('no-compress');
            $finalFilename = $shouldCompress ? "{$baseFilename}.sql.gz" : "{$baseFilename}.sql";
            $finalPath = $fullBackupDir . DIRECTORY_SEPARATOR . $finalFilename;

            if ($shouldCompress) {
                $this->line('Compressing dump with GZIP...');
                $compressSuccess = $this->compressGzip($rawSqlPath, $finalPath);
                @unlink($rawSqlPath);

                if (!$compressSuccess || !file_exists($finalPath) || filesize($finalPath) === 0) {
                    $errorMsg = 'Failed to compress database dump file.';
                    $this->error($errorMsg);
                    Log::error("Database backup failed: {$errorMsg}");
                    @unlink($finalPath);
                    return Command::FAILURE;
                }
            } else {
                rename($rawSqlPath, $finalPath);
            }

            // 7. Verify integrity (unless --no-verify)
            if (!$this->option('no-verify')) {
                $this->line('Verifying backup artifact integrity...');
                $integrityPassed = $this->verifyDumpIntegrity($finalPath, $shouldCompress);

                if (!$integrityPassed) {
                    $errorMsg = 'Backup integrity verification failed! Dump file is corrupted or incomplete.';
                    $this->error($errorMsg);
                    Log::error("Database backup failed: {$errorMsg}");
                    @unlink($finalPath);
                    return Command::FAILURE;
                }
                $this->info('Artifact integrity verified.');
            }

            $finalSize = filesize($finalPath);
            $duration = round(microtime(true) - $startTime, 2);

            $this->info("Backup created successfully: {$finalFilename}");
            $this->line("Size: " . number_format($finalSize) . " bytes ({$duration}s)");
            Log::info("Database backup created successfully: {$finalFilename} (" . number_format($finalSize) . " bytes in {$duration}s).");

            // 8. Retention pruning
            $keepCount = $this->option('keep') ? (int) $this->option('keep') : (int) config('backup.keep_count', 7);
            $this->pruneOldBackups($fullBackupDir, $keepCount);

            return Command::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Unexpected error during database backup: ' . $e->getMessage());
            Log::error('Database backup failed unexpectedly: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return Command::FAILURE;
        } finally {
            $lock->release();
        }
    }

    /**
     * Resolve functional mysqldump binary.
     */
    protected function resolveMysqldumpBinary(): ?string
    {
        $custom = config('backup.mysqldump_path') ?: env('DB_DUMP_BINARY_PATH');
        if ($custom && is_executable($custom)) {
            return $custom;
        }

        $candidates = [
            'C:\\Program Files\\MySQL\\MySQL Server 9.0\\bin\\mysqldump.exe',
            'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe',
            'C:\\Program Files\\MySQL\\MySQL Server 8.4\\bin\\mysqldump.exe',
            '/usr/bin/mysqldump',
            '/usr/local/bin/mysqldump',
            'mysqldump',
            'C:\\xampp\\mysql\\bin\\mysqldump.exe',
        ];

        foreach ($candidates as $bin) {
            $out = [];
            $code = -1;
            @exec("\"{$bin}\" --version 2>&1", $out, $code);
            if ($code === 0) {
                return $bin;
            }
        }

        return null;
    }

    /**
     * Compress file using GZIP stream.
     */
    protected function compressGzip(string $sourceFile, string $destGzipFile): bool
    {
        $src = @fopen($sourceFile, 'rb');
        if (!$src) return false;

        $dst = @gzopen($destGzipFile, 'wb9');
        if (!$dst) {
            fclose($src);
            return false;
        }

        while (!feof($src)) {
            $buffer = fread($src, 65536);
            if ($buffer === false) {
                fclose($src);
                gzclose($dst);
                return false;
            }
            gzwrite($dst, $buffer);
        }

        fclose($src);
        gzclose($dst);
        return true;
    }

    /**
     * Verify database dump header contains valid MySQL dump markers.
     */
    protected function verifyDumpIntegrity(string $filePath, bool $isGzip): bool
    {
        if (!file_exists($filePath) || filesize($filePath) < 100) {
            return false;
        }

        $header = '';
        if ($isGzip) {
            $gz = @gzopen($filePath, 'rb');
            if (!$gz) return false;
            $header = gzread($gz, 1024);
            gzclose($gz);
        } else {
            $fp = @fopen($filePath, 'rb');
            if (!$fp) return false;
            $header = fread($fp, 1024);
            fclose($fp);
        }

        return str_contains($header, 'MySQL dump') || str_contains($header, 'MariaDB dump');
    }

    /**
     * Prune backups exceeding the retention count.
     */
    protected function pruneOldBackups(string $backupDir, int $keepCount): void
    {
        if ($keepCount <= 0) return;

        $files = glob($backupDir . DIRECTORY_SEPARATOR . 'backup-*.sql*');
        if (!$files || count($files) <= $keepCount) {
            return;
        }

        // Sort descending by modified time (newest first)
        usort($files, function ($a, $b) {
            return filemtime($b) <=> filemtime($a);
        });

        $toDelete = array_slice($files, $keepCount);
        $deletedCount = 0;

        foreach ($toDelete as $file) {
            if (is_file($file) && @unlink($file)) {
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            $this->line("Retention policy applied: pruned {$deletedCount} old backup(s) (keeping {$keepCount}).");
            Log::info("Database backup retention pruned {$deletedCount} old backup(s).");
        }
    }
}
