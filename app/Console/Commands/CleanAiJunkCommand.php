<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Services\Content\ContentSanitizerService;
use Illuminate\Support\Facades\Cache;

class CleanAiJunkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:clean-ai {--dry-run : Chỉ quét kiểm tra mã rác AI mà không lưu thay đổi vào CSDL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quét và làm sạch toàn bộ mã rác do copy-paste từ chatbot AI (citation-xx, ng-tns-*, markdown-main-panel, containers rác)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        $this->info($dryRun 
            ? '🔍 [CHẾ ĐỘ KIỂM TRA] Đang quét bài viết tìm mã rác AI (Không sửa DB)...' 
            : '🚀 Đang bắt đầu quét và làm sạch mã rác AI trong CSDL...'
        );

        $posts = Post::all();
        $totalChecked = 0;
        $totalCleaned = 0;
        $cleanedRows = [];

        foreach ($posts as $post) {
            $totalChecked++;
            $originalContent = $post->content;

            if (empty($originalContent)) {
                continue;
            }

            // Kiểm tra xem có chứa dấu hiệu AI không
            $hasAiFootprints = (
                str_contains($originalContent, 'citation-') ||
                str_contains($originalContent, 'ng-tns-') ||
                str_contains($originalContent, 'ng-trigger') ||
                str_contains($originalContent, 'ng-animate') ||
                str_contains($originalContent, 'markdown-main-panel') ||
                str_contains($originalContent, 'enable-luminous-fast-follows') ||
                str_contains($originalContent, 'formatted-code-block-internal-container') ||
                str_contains($originalContent, 'text-token-') ||
                str_contains($originalContent, 'bg-token-') ||
                str_contains($originalContent, 'font-claude-') ||
                str_contains($originalContent, 'code-block ng-tns-')
            );

            $cleanedContent = ContentSanitizerService::clean($originalContent);

            if ($hasAiFootprints || $cleanedContent !== $originalContent) {
                $totalCleaned++;
                $cleanedRows[] = [
                    'ID' => $post->id,
                    'Tiêu đề' => \Illuminate\Support\Str::limit($post->title, 40),
                    'Slug' => $post->slug,
                    'Kích thước trước' => strlen($originalContent) . ' bytes',
                    'Kích thước sau' => strlen($cleanedContent) . ' bytes',
                ];

                if (!$dryRun) {
                    // Cập nhật trực tiếp vào DB
                    $post->content = $cleanedContent;
                    $post->saveQuietly();

                    // Xóa cache bài viết
                    Cache::forget('post_editorial_' . $post->id);
                    Cache::forget('post_editorial_v5_' . $post->id . '_' . $post->updated_at->timestamp);
                }
            }
        }

        if (!$dryRun) {
            Cache::forget('home_page_data');
            Cache::forget('template_showcase_metadata');
        }

        if (count($cleanedRows) > 0) {
            $this->table(['ID', 'Tiêu đề', 'Slug', 'Kích thước trước', 'Kích thước sau'], $cleanedRows);
            $this->info("✅ Đã phát hiện và " . ($dryRun ? "sẽ làm sạch" : "làm sạch thành công") . " {$totalCleaned} / {$totalChecked} bài viết chứa mã rác AI.");
        } else {
            $this->info("🎉 Tuyệt vời! Không phát hiện bài viết nào chứa mã rác AI trong CSDL ({$totalChecked} bài đã quét).");
        }

        return Command::SUCCESS;
    }
}
