<?php

namespace App\Services\Chat;

use App\Models\ChatAttachment;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class ChatAttachmentService
{
    /**
     * Allowed Image Extensions and corresponding MIME types.
     */
    protected const ALLOWED_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    protected const ALLOWED_IMAGE_MIMES = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
    ];

    /**
     * Allowed Document Extensions and corresponding MIME types.
     */
    protected const ALLOWED_DOCUMENT_EXTENSIONS = ['pdf', 'doc', 'docx'];
    protected const ALLOWED_DOCUMENT_MIMES = [
        'application/pdf',
        'application/msword',
        'application/vnd.ms-office',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/zip',
    ];

    /**
     * Strictly blocked extensions that must NEVER be allowed.
     */
    protected const STRICTLY_BLOCKED_EXTENSIONS = [
        'svg', 'php', 'phtml', 'phar', 'html', 'htm', 'js', 'sh',
        'exe', 'dll', 'bat', 'cmd', 'com', 'jar', 'zip', 'rar', '7z',
        'cgi', 'pl', 'py',
    ];

    /**
     * Validate an uploaded file strictly using deep MIME inspection, content scanning, and size boundaries.
     *
     * @throws UnprocessableEntityHttpException
     */
    public function validateFile(UploadedFile $file): array
    {
        $originalExt = strtolower($file->getClientOriginalExtension());
        $realPath = $file->getRealPath();

        // 1. Strictly block forbidden extensions
        if (in_array($originalExt, self::STRICTLY_BLOCKED_EXTENSIONS, true)) {
            throw new UnprocessableEntityHttpException("Định dạng tệp .{$originalExt} không được phép tải lên.");
        }

        $isImage = in_array($originalExt, self::ALLOWED_IMAGE_EXTENSIONS, true);
        $isDoc = in_array($originalExt, self::ALLOWED_DOCUMENT_EXTENSIONS, true);

        if (! $isImage && ! $isDoc) {
            throw new UnprocessableEntityHttpException("Định dạng tệp không được hỗ trợ. Chỉ cho phép ảnh (JPG, PNG, WEBP, GIF) hoặc tài liệu (PDF, DOC, DOCX).");
        }

        // 2. Validate file size
        if ($file->getSize() <= 0) {
            throw new UnprocessableEntityHttpException('Tệp rỗng không thể tải lên.');
        }

        $fileSizeKb = (int) ceil($file->getSize() / 1024);
        if ($isImage) {
            $maxKb = (int) config('chat.attachment_image_max_kb', 5120);
            if ($fileSizeKb > $maxKb) {
                throw new UnprocessableEntityHttpException("Kích thước tệp ảnh vượt quá giới hạn {$maxKb} KB.");
            }
        } else {
            $maxKb = (int) config('chat.attachment_document_max_kb', 10240);
            if ($fileSizeKb > $maxKb) {
                throw new UnprocessableEntityHttpException("Kích thước tệp tài liệu vượt quá giới hạn {$maxKb} KB.");
            }
        }

        // 3. Deep MIME detection from real file bytes
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo ? finfo_file($finfo, $realPath) : $file->getMimeType();
        if ($finfo) {
            finfo_close($finfo);
        }

        // Strictly reject SVG detection or any script MIME
        if (str_contains($detectedMime, 'svg') || str_contains($detectedMime, 'xml') && $isImage) {
            throw new UnprocessableEntityHttpException('Tệp SVG không được phép tải lên.');
        }

        if ($isImage && ! in_array($detectedMime, self::ALLOWED_IMAGE_MIMES, true)) {
            throw new UnprocessableEntityHttpException("Nội dung tệp không khớp với định dạng ảnh cho phép (MIME phát hiện: {$detectedMime}).");
        }

        if ($isDoc && ! in_array($detectedMime, self::ALLOWED_DOCUMENT_MIMES, true)) {
            throw new UnprocessableEntityHttpException("Nội dung tệp không khớp với định dạng tài liệu cho phép (MIME phát hiện: {$detectedMime}).");
        }

        // 4. Content signature inspection (Anti-spoofing against PHP / Script / HTML payloads disguised as images/documents)
        $handle = fopen($realPath, 'rb');
        if ($handle) {
            $sample = fread($handle, 4096);
            fclose($handle);

            if (preg_match('/<\?php|<\?=|<script\b|<\/script>|<svg\b|<html\b|<!doctype\s+html|<body\b/i', $sample)) {
                throw new UnprocessableEntityHttpException('Tệp chứa mã script hoặc nội dung độc hại không được phép tải lên.');
            }
        }

        return [
            'is_image' => $isImage,
            'detected_mime' => $detectedMime,
            'file_size' => $file->getSize(),
        ];
    }

    /**
     * Store attachments for a chat message atomically with compensation cleanup on rollback.
     *
     * @param  array<UploadedFile>  $files
     * @return Collection<int, ChatAttachment>
     */
    public function storeAttachmentsForMessage(ChatMessage $message, array $files): Collection
    {
        $maxFiles = (int) config('chat.attachment_max_files_per_message', 5);
        if (count($files) > $maxFiles) {
            throw new UnprocessableEntityHttpException("Mỗi tin nhắn chỉ được đính kèm tối đa {$maxFiles} tệp.");
        }

        // Pre-validate all files before writing to disk
        $validatedData = [];
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }
            $validatedData[] = [
                'file' => $file,
                'meta' => $this->validateFile($file),
            ];
        }

        $disk = config('chat.attachment_disk', 'chat_private');
        $storedPaths = [];
        $createdAttachments = new Collection();

        try {
            DB::transaction(function () use ($message, $validatedData, $disk, &$storedPaths, &$createdAttachments) {
                $subFolder = date('Y/m');

                foreach ($validatedData as $item) {
                    /** @var UploadedFile $file */
                    $file = $item['file'];
                    $meta = $item['meta'];

                    $attachmentUuid = (string) Str::uuid();
                    $storedFileName = "{$attachmentUuid}.bin";
                    $relativeStoredPath = "{$subFolder}/{$storedFileName}";

                    // Write to private storage
                    $path = Storage::disk($disk)->putFileAs($subFolder, $file, $storedFileName);
                    if (! $path) {
                        throw new \RuntimeException('Không thể ghi tệp vào bộ nhớ lưu trữ riêng tư.');
                    }

                    $storedPaths[] = $relativeStoredPath;

                    // Sanitize original filename
                    $safeOriginalName = $this->sanitizeOriginalFilename($file->getClientOriginalName());

                    // Create database record
                    $attachment = $message->attachments()->create([
                        'attachment_uuid' => $attachmentUuid,
                        'original_name' => $safeOriginalName,
                        'stored_path' => $relativeStoredPath,
                        'disk' => $disk,
                        'mime_type' => $meta['detected_mime'],
                        'file_size' => $meta['file_size'],
                    ]);

                    $createdAttachments->push($attachment);
                }
            });

            return $createdAttachments;
        } catch (Throwable $e) {
            // Compensation strategy: cleanup any orphaned files written to disk during failed transaction
            foreach ($storedPaths as $orphanPath) {
                Storage::disk($disk)->delete($orphanPath);
            }

            throw $e;
        }
    }

    /**
     * Download or stream attachment with authorization checks and strict security headers.
     *
     * @throws NotFoundHttpException
     */
    public function downloadAttachment(ChatAttachment $attachment, ?ChatVisitor $visitor, ?User $user): StreamedResponse
    {
        $conversation = $attachment->message->conversation;

        // Verify authorization
        $isAuthorized = false;

        if ($visitor && (int) $conversation->chat_visitor_id === (int) $visitor->id) {
            $isAuthorized = true;
        } elseif ($user && Gate::forUser($user)->allows('view', $conversation)) {
            $isAuthorized = true;
        }

        if (! $isAuthorized) {
            // Fail closed: return 404 to avoid leaking attachment existence
            throw new NotFoundHttpException('Tệp đính kèm không tồn tại.');
        }

        $disk = $attachment->disk ?: config('chat.attachment_disk', 'chat_private');
        if (! Storage::disk($disk)->exists($attachment->stored_path)) {
            throw new NotFoundHttpException('Tệp đính kèm không tồn tại trên bộ nhớ.');
        }

        // Content-Disposition: inline for safe previewable files (images/PDF), attachment for documents
        $isInline = str_starts_with($attachment->mime_type, 'image/') || $attachment->mime_type === 'application/pdf';
        $disposition = $isInline ? 'inline' : 'attachment';

        $safeFilename = str_replace(['"', "'", "\r", "\n", '/', '\\', ';'], '', $attachment->original_name);
        if ($safeFilename === '') {
            $safeFilename = 'attachment';
        }

        $headers = [
            'Content-Type' => $attachment->mime_type,
            'Content-Length' => $attachment->file_size,
            'Content-Disposition' => "{$disposition}; filename=\"{$safeFilename}\"",
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        return Storage::disk($disk)->response($attachment->stored_path, $safeFilename, $headers);
    }

    /**
     * Sanitize original filename to prevent path traversal, HTML injection, semicolon injection, or control characters.
     */
    public function sanitizeOriginalFilename(string $filename): string
    {
        $name = basename($filename);
        // Remove null bytes, control characters, newlines, slashes, angle brackets, quotes, semicolons
        $name = preg_replace('/[\x00-\x1F\x7F<>"\':;\\\\\/]/u', '', $name);
        $name = trim($name);

        if ($name === '') {
            $name = 'attachment_' . Str::random(8);
        }

        return mb_substr($name, 0, 200);
    }
}
