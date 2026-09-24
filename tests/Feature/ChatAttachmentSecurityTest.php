<?php

namespace Tests\Feature;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatAttachment;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\ChatAttachmentService;
use App\Services\Chat\ChatMessageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatAttachmentSecurityTest extends TestCase
{
    protected string $cookieName;
    protected ChatAttachmentService $attachmentService;
    protected ChatMessageService $messageService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        $this->attachmentService = app(ChatAttachmentService::class);
        $this->messageService = app(ChatMessageService::class);
        RateLimiter::clear('chat-message-send');
        RateLimiter::clear('chat-session-init');
        RateLimiter::clear('chat-attachment-upload');
    }

    protected function createVisitorSession(): array
    {
        $this->defaultCookies = [];
        $res = $this->postJson('/api/chat/session/init');
        $cookie = $res->getCookie($this->cookieName, false);

        return [
            'visitor_uuid' => $res->json('visitor_uuid'),
            'token' => $cookie?->getValue(),
            'visitor' => ChatVisitor::where('visitor_uuid', $res->json('visitor_uuid'))->first(),
        ];
    }

    protected function createConversation(string $token): array
    {
        $res = $this->withCookie($this->cookieName, $token)
            ->postJson('/api/chat/conversations');

        return [
            'uuid' => $res->json('data.conversation_uuid'),
            'conversation' => ChatConversation::where('conversation_uuid', $res->json('data.conversation_uuid'))->first(),
        ];
    }

    /**
     * 1. Files are stored strictly in private disk with .bin extension and no executable names.
     */
    public function test_01_attachment_stored_in_private_disk_with_bin_extension(): void
    {
        Storage::fake('chat_private');
        Storage::fake('public');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('avatar.png', 50, 50);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'message' => 'Check this avatar',
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
        $attachmentUuid = $res->json('data.attachments.0.attachment_uuid');
        $attachment = ChatAttachment::where('attachment_uuid', $attachmentUuid)->firstOrFail();

        $this->assertEquals('chat_private', $attachment->disk);
        $this->assertStringEndsWith('.bin', $attachment->stored_path);
        $this->assertStringContainsString($attachmentUuid, $attachment->stored_path);
        Storage::disk('chat_private')->assertExists($attachment->stored_path);
        Storage::disk('public')->assertMissing($attachment->stored_path);
    }

    /**
     * 2. Public URL Leak Check: verify responses do not leak storage paths or private filesystem info.
     */
    public function test_02_responses_do_not_leak_private_filesystem_paths(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('secret_photo.png', 50, 50);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
        $content = $res->getContent();

        $this->assertStringNotContainsString('/storage/', $content);
        $this->assertStringNotContainsString('storage/app', $content);
        $this->assertStringNotContainsString('private/chat_attachments', $content);
        $this->assertStringNotContainsString('.bin', $content);
        $this->assertStringContainsString('/api/chat/attachments/', $res->json('data.attachments.0.download_url'));
    }

    /**
     * 3. Authorization / IDOR Matrix: Visitor A can download their own attachment.
     */
    public function test_03_visitor_a_can_download_own_attachment(): void
    {
        Storage::fake('chat_private');

        $sessionA = $this->createVisitorSession();
        $convA = $this->createConversation($sessionA['token']);

        $imageA = UploadedFile::fake()->image('docA.png', 50, 50);

        $resA = $this->withCookie($this->cookieName, $sessionA['token'])
            ->post("/api/chat/conversations/{$convA['uuid']}/messages", [
                'attachments' => [$imageA],
            ], ['Accept' => 'application/json']);

        $attachmentUuidA = $resA->json('data.attachments.0.attachment_uuid');

        $downloadRes = $this->withCookie($this->cookieName, $sessionA['token'])
            ->get("/api/chat/attachments/{$attachmentUuidA}");

        $downloadRes->assertStatus(200);
    }

    /**
     * 4. Authorization / IDOR Matrix: Visitor A cannot download Visitor B's attachment (404 fail-closed).
     */
    public function test_04_visitor_a_cannot_download_visitor_b_attachment(): void
    {
        Storage::fake('chat_private');

        $sessionA = $this->createVisitorSession();
        $convA = $this->createConversation($sessionA['token']);

        $sessionB = $this->createVisitorSession();
        $convB = $this->createConversation($sessionB['token']);

        $imageB = UploadedFile::fake()->image('privateB.png', 50, 50);

        $resB = $this->withCookie($this->cookieName, $sessionB['token'])
            ->post("/api/chat/conversations/{$convB['uuid']}/messages", [
                'attachments' => [$imageB],
            ], ['Accept' => 'application/json']);

        $attachmentUuidB = $resB->json('data.attachments.0.attachment_uuid');

        // Visitor A tries to download B's file
        $downloadRes = $this->withCookie($this->cookieName, $sessionA['token'])
            ->get("/api/chat/attachments/{$attachmentUuidB}");

        $downloadRes->assertStatus(404);
    }

    /**
     * 5. Authorization / IDOR Matrix: Visitor B cannot download Visitor A's attachment (404 fail-closed).
     */
    public function test_05_visitor_b_cannot_download_visitor_a_attachment(): void
    {
        Storage::fake('chat_private');

        $sessionA = $this->createVisitorSession();
        $convA = $this->createConversation($sessionA['token']);

        $sessionB = $this->createVisitorSession();
        $convB = $this->createConversation($sessionB['token']);

        $imageA = UploadedFile::fake()->image('privateA.png', 50, 50);

        $resA = $this->withCookie($this->cookieName, $sessionA['token'])
            ->post("/api/chat/conversations/{$convA['uuid']}/messages", [
                'attachments' => [$imageA],
            ], ['Accept' => 'application/json']);

        $attachmentUuidA = $resA->json('data.attachments.0.attachment_uuid');

        // Visitor B tries to download A's file
        $downloadRes = $this->withCookie($this->cookieName, $sessionB['token'])
            ->get("/api/chat/attachments/{$attachmentUuidA}");

        $downloadRes->assertStatus(404);
    }

    /**
     * 6. Authorization / IDOR Matrix: Unauthenticated request cannot download attachment (404 fail-closed).
     */
    public function test_06_unauthenticated_request_cannot_download_attachment(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('unauth_test.png', 50, 50);

        $resMsg = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $attachmentUuid = $resMsg->json('data.attachments.0.attachment_uuid');

        // Download without any cookie or session
        $this->defaultCookies = [];
        $downloadRes = $this->get("/api/chat/attachments/{$attachmentUuid}");

        $downloadRes->assertStatus(404);
    }

    /**
     * 7. Guessing / non-existent attachment UUID returns 404.
     */
    public function test_07_invalid_or_random_uuid_returns_404(): void
    {
        $session = $this->createVisitorSession();
        $randomUuid = (string) Str::uuid();

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->get("/api/chat/attachments/{$randomUuid}");

        $res->assertStatus(404);
    }

    /**
     * 8. Agent Authorization: Authorized CSKH agent can download attachment.
     */
    public function test_08_authorized_agent_can_download_attachment(): void
    {
        Storage::fake('chat_private');

        Role::firstOrCreate(['name' => 'Biên Tập Viên']);
        $agent = User::factory()->create(['name' => 'Support Agent']);
        $agent->assignRole('Biên Tập Viên');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('client_receipt.png', 50, 50);

        $resMsg = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $attachmentUuid = $resMsg->json('data.attachments.0.attachment_uuid');

        // Agent downloads attachment
        $downloadRes = $this->actingAs($agent)
            ->get("/api/chat/attachments/{$attachmentUuid}");

        $downloadRes->assertStatus(200);
    }

    /**
     * 9. Agent Authorization: Authenticated user without role cannot download attachment (404 fail-closed).
     */
    public function test_09_unauthorized_user_cannot_download_attachment(): void
    {
        Storage::fake('chat_private');

        $randomUser = User::factory()->create(['name' => 'Random Authenticated User']);

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('confidential.png', 50, 50);

        $resMsg = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $attachmentUuid = $resMsg->json('data.attachments.0.attachment_uuid');

        // Unprivileged user downloads
        $this->defaultCookies = [];
        $downloadRes = $this->actingAs($randomUser)
            ->get("/api/chat/attachments/{$attachmentUuid}");

        $downloadRes->assertStatus(404);
    }

    /**
     * 10. Attachment ↔ Message Integrity: Cannot upload attachment to another visitor's conversation.
     */
    public function test_10_attachment_message_integrity_cannot_upload_to_foreign_conversation(): void
    {
        Storage::fake('chat_private');

        $sessionA = $this->createVisitorSession();
        $convA = $this->createConversation($sessionA['token']);

        $sessionB = $this->createVisitorSession();
        $convB = $this->createConversation($sessionB['token']);

        $image = UploadedFile::fake()->image('cross_post.png', 50, 50);

        // Visitor A tries to post to Conv B
        $res = $this->withCookie($this->cookieName, $sessionA['token'])
            ->post("/api/chat/conversations/{$convB['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(404);
        $this->assertDatabaseMissing('chat_attachments', [
            'original_name' => 'cross_post.png',
        ]);
    }

    /**
     * 11. Download Filename Hardening: Malicious filenames are sanitized safely without header injection.
     */
    public function test_11_download_filename_hardening_and_sanitization(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        // 1. Malicious executable filenames must be rejected at upload
        $executableMalicious = [
            '../../evil.php',
            '"..\..\evil.php"',
        ];
        foreach ($executableMalicious as $badExe) {
            $file = UploadedFile::fake()->create($badExe, 10);
            $res = $this->withCookie($this->cookieName, $session['token'])
                ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                    'attachments' => [$file],
                ], ['Accept' => 'application/json']);
            $res->assertStatus(422);
        }

        // 2. Malicious metadata filenames with valid image content must have Content-Disposition sanitized on download
        $sanitizedMalicious = [
            '../../evil.png',
            '<script>alert(1)</script>.png',
            'foo"; malicious=.png',
            "test\r\ninjected-header:value.png",
        ];

        foreach ($sanitizedMalicious as $badName) {
            $file = UploadedFile::fake()->image($badName, 50, 50);

            $res = $this->withCookie($this->cookieName, $session['token'])
                ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                    'attachments' => [$file],
                ], ['Accept' => 'application/json']);

            $res->assertStatus(201);
            $attachmentUuid = $res->json('data.attachments.0.attachment_uuid');

            $downloadRes = $this->withCookie($this->cookieName, $session['token'])
                ->get("/api/chat/attachments/{$attachmentUuid}");

            $downloadRes->assertStatus(200);

            $disposition = $downloadRes->headers->get('Content-Disposition');
            $this->assertStringNotContainsString('../', $disposition);
            $this->assertStringNotContainsString('..\\', $disposition);
            $this->assertStringNotContainsString('<script>', $disposition);
            $this->assertStringNotContainsString("\r", $disposition);
            $this->assertStringNotContainsString("\n", $disposition);
            $this->assertNull($downloadRes->headers->get('injected-header'));
        }
    }

    /**
     * 12. Download Security Headers: nosniff, private cache control, no-store.
     */
    public function test_12_download_security_headers_present(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('security_header.png', 50, 50);

        $resMsg = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $attachmentUuid = $resMsg->json('data.attachments.0.attachment_uuid');

        $downloadRes = $this->withCookie($this->cookieName, $session['token'])
            ->get("/api/chat/attachments/{$attachmentUuid}");

        $downloadRes->assertStatus(200);
        $downloadRes->assertHeader('X-Content-Type-Options', 'nosniff');
        $downloadRes->assertHeader('Content-Type', 'image/png');
        $this->assertStringContainsString('private', $downloadRes->headers->get('Cache-Control'));
        $this->assertStringContainsString('no-store', $downloadRes->headers->get('Cache-Control'));
        $this->assertStringContainsString('no-cache', $downloadRes->headers->get('Cache-Control'));
        $this->assertStringContainsString('must-revalidate', $downloadRes->headers->get('Cache-Control'));
        $this->assertEquals('no-cache', $downloadRes->headers->get('Pragma'));
    }

    /**
     * 13. Multi-file Transaction: 5 valid files in batch all succeed.
     */
    public function test_13_multi_file_batch_of_5_files_all_succeed(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $files = [
            UploadedFile::fake()->image('p1.png', 30, 30),
            UploadedFile::fake()->image('p2.png', 30, 30),
            UploadedFile::fake()->image('p3.png', 30, 30),
            UploadedFile::fake()->image('p4.png', 30, 30),
            UploadedFile::fake()->image('p5.png', 30, 30),
        ];

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'message' => 'Batch of 5 valid files',
                'attachments' => $files,
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
        $this->assertCount(5, $res->json('data.attachments'));
        $this->assertCount(5, Storage::disk('chat_private')->allFiles());
    }

    /**
     * 14. Multi-file Transaction Rollback & Cleanup: partial failure purges all written physical files.
     */
    public function test_14_multi_file_rollback_compensates_by_purging_orphaned_files(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $files = [
            UploadedFile::fake()->image('batch_f1.png', 40, 40),
            UploadedFile::fake()->image('batch_f2.png', 40, 40),
            UploadedFile::fake()->image('batch_f3.png', 40, 40),
        ];

        $mockMessage = ChatMessage::create([
            'message_uuid' => (string) Str::uuid(),
            'chat_conversation_id' => $conv['conversation']->id,
            'sender_type' => ChatMessageSenderType::Visitor,
            'sender_user_id' => null,
            'message_body' => 'Multi-file rollback message',
        ]);

        // Fail during the 3rd attachment save
        $saveCounter = 0;
        ChatAttachment::saving(function () use (&$saveCounter) {
            $saveCounter++;
            if ($saveCounter === 3) {
                throw new \RuntimeException('Simulated failure during 3rd file DB save');
            }
        });

        try {
            $this->attachmentService->storeAttachmentsForMessage($mockMessage, $files);
        } catch (\RuntimeException $e) {
            // Expected simulated exception
        }

        // Verify that NO files remain orphaned on disk, and NO attachments saved in DB
        $filesInStorage = Storage::disk('chat_private')->allFiles();
        $this->assertEmpty($filesInStorage, 'All written files must be purged when transaction rolls back.');
        $this->assertEquals(0, ChatAttachment::where('chat_message_id', $mockMessage->id)->count());
    }

    /**
     * 15. Recalled message masks attachments in API response.
     */
    public function test_15_recalled_message_masks_attachments_in_api_response(): void
    {
        Storage::fake('chat_private');

        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $image = UploadedFile::fake()->image('confidential_photo.png', 50, 50);

        $resMsg = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'message' => 'Top secret receipt',
                'attachments' => [$image],
            ], ['Accept' => 'application/json']);

        $messageUuid = $resMsg->json('data.message_uuid');

        $recallRes = $this->withCookie($this->cookieName, $session['token'])
            ->postJson("/api/chat/conversations/{$conv['uuid']}/messages/{$messageUuid}/recall");

        $recallRes->assertStatus(200);
        $this->assertTrue($recallRes->json('data.recalled'));
        $this->assertEmpty($recallRes->json('data.attachments'));
    }

    /**
     * 16. HTTP Error Matrix: verify errors leak no stack traces, database exceptions, internal paths, or tokens.
     */
    public function test_16_http_errors_leak_no_sensitive_internals(): void
    {
        $session = $this->createVisitorSession();

        // 1. 404 scenario: invalid attachment
        $res404 = $this->withCookie($this->cookieName, $session['token'])
            ->get("/api/chat/attachments/" . Str::uuid());
        $res404->assertStatus(404);
        $this->assertStringNotContainsString('Stack trace', $res404->getContent());
        $this->assertStringNotContainsString('SQLSTATE', $res404->getContent());
        $this->assertStringNotContainsString('storage_path', $res404->getContent());

        // 2. 422 scenario: invalid attachment upload (empty message and no attachments)
        $res422 = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/" . Str::uuid() . "/messages", [], ['Accept' => 'application/json']);
        $res422->assertStatus(422);
        $this->assertStringNotContainsString('Stack trace', $res422->getContent());
        $this->assertStringNotContainsString('SQLSTATE', $res422->getContent());
    }
}
