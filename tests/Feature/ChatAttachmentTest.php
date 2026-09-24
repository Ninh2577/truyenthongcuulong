<?php

namespace Tests\Feature;

use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Models\ChatAttachment;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use App\Services\Chat\ChatAgentMessageService;
use App\Services\Chat\ChatAttachmentService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ChatAttachmentTest extends TestCase
{
    protected string $cookieName;
    protected ChatAttachmentService $attachmentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials();
        $this->disableCookieEncryption();
        $this->cookieName = config('chat.cookie_name', 'chat_visitor_token');
        $this->attachmentService = app(ChatAttachmentService::class);
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

    protected function createPdfFile(string $name = 'document.pdf', int $sizeKb = 20): UploadedFile
    {
        $header = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\n%%EOF\n";
        $targetBytes = $sizeKb * 1024;
        $padLength = max(0, $targetBytes - strlen($header));
        $content = $header . str_repeat('A', $padLength);
        return UploadedFile::fake()->createWithContent($name, $content);
    }

    /**
     * Group A: Allowed File Types (JPG, JPEG, PNG, WEBP, GIF, PDF, DOC, DOCX)
     */
    public function test_01_all_allowed_file_types_are_accepted(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        // 1. JPG & PNG
        $jpg = UploadedFile::fake()->image('image.jpg', 50, 50);
        $png = UploadedFile::fake()->image('image.png', 50, 50);
        // 2. GIF
        $gif = UploadedFile::fake()->image('anim.gif', 50, 50);
        // 3. PDF
        $pdf = $this->createPdfFile('sample.pdf', 10);
        // 4. DOCX (real zip container with Word document XML)
        $docxPath = tempnam(sys_get_temp_dir(), 'docx') . '.docx';
        $zip = new \ZipArchive();
        $zip->open($docxPath, \ZipArchive::CREATE);
        $zip->addFromString('word/document.xml', '<?xml version="1.0"?><w:document xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:body><w:p><w:r><w:t>Hello</w:t></w:r></w:p></w:body></w:document>');
        $zip->close();
        $docx = new UploadedFile($docxPath, 'sample.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', null, true);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'message' => 'Allowed files batch',
                'attachments' => [$jpg, $png, $gif, $pdf, $docx],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
        $this->assertCount(5, $res->json('data.attachments'));
    }

    /**
     * Group A: Explicitly Rejected Extensions
     * SVG, PHP, PHTML, PHAR, HTML, HTM, JS, EXE, DLL, BAT, CMD, COM, JAR, ZIP, RAR, 7Z
     */
    public function test_02_all_strictly_rejected_extensions_are_blocked(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $forbiddenExtensions = [
            'svg', 'php', 'phtml', 'phar', 'html', 'htm', 'js',
            'exe', 'dll', 'bat', 'cmd', 'com', 'jar', 'zip', 'rar', '7z',
        ];

        foreach ($forbiddenExtensions as $ext) {
            $file = UploadedFile::fake()->create("test_file.{$ext}", 10);

            $res = $this->withCookie($this->cookieName, $session['token'])
                ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                    'message' => "Testing forbidden .{$ext}",
                    'attachments' => [$file],
                ], ['Accept' => 'application/json']);

            $res->assertStatus(422);
            $this->assertDatabaseMissing('chat_attachments', [
                'original_name' => "test_file.{$ext}",
            ]);
        }
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 1: PHP payload with filename image.png and client MIME image/png => MUST REJECT
     */
    public function test_03_spoof_case_1_php_payload_named_png_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $phpDisguisedAsPng = UploadedFile::fake()->createWithContent(
            'image.png',
            "<?php phpinfo(); ?>\n" . str_repeat('A', 100)
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$phpDisguisedAsPng],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 2: PHP payload with filename photo.jpg and client MIME image/jpeg => MUST REJECT
     */
    public function test_04_spoof_case_2_php_payload_named_jpg_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $phpDisguisedAsJpg = UploadedFile::fake()->createWithContent(
            'photo.jpg',
            "<?= system(\$_GET['cmd']); ?>"
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$phpDisguisedAsJpg],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 3: SVG/XML payload with filename image.png and client MIME image/png => MUST REJECT
     */
    public function test_05_spoof_case_3_svg_xml_payload_named_png_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $svgDisguisedAsPng = UploadedFile::fake()->createWithContent(
            'image.png',
            "<?xml version=\"1.0\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"5\" cy=\"5\" r=\"5\"/></svg>"
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$svgDisguisedAsPng],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 4: SVG payload with filename image.jpg => MUST REJECT
     */
    public function test_06_spoof_case_4_svg_payload_named_jpg_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $svgDisguisedAsJpg = UploadedFile::fake()->createWithContent(
            'image.jpg',
            "<svg onload=\"alert(document.cookie)\"><rect width=\"100\" height=\"100\"/></svg>"
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$svgDisguisedAsJpg],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 5: HTML payload disguised as image.png => MUST REJECT
     */
    public function test_07_spoof_case_5_html_payload_disguised_as_image_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $htmlDisguised = UploadedFile::fake()->createWithContent(
            'image.png',
            "<!DOCTYPE html><html><head><title>Phish</title></head><body><h1>Fake Login</h1></body></html>"
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$htmlDisguised],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 6: JavaScript payload disguised as image.png => MUST REJECT
     */
    public function test_08_spoof_case_6_js_payload_disguised_as_image_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $jsDisguised = UploadedFile::fake()->createWithContent(
            'image.png',
            "<script type=\"text/javascript\">alert('XSS');</script>"
        );

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$jsDisguised],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group B: Content-Aware Spoof Tests (Section 4)
     * Case 7: Valid PNG, JPG, PDF with valid extensions => MUST ACCEPT
     */
    public function test_09_spoof_case_7_valid_files_are_accepted(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $realPng = UploadedFile::fake()->image('real.png', 50, 50);
        $realJpg = UploadedFile::fake()->image('real.jpg', 50, 50);
        $realPdf = $this->createPdfFile('real.pdf', 10);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'message' => 'Real genuine files',
                'attachments' => [$realPng, $realJpg, $realPdf],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
        $this->assertCount(3, $res->json('data.attachments'));
        $this->assertCount(3, Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group C: Size Limit Tests (Section 5)
     * Image: exactly at 5120 KB limit => ACCEPT
     */
    public function test_10_image_exactly_at_limit_is_accepted(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        // 5120 KB exactly
        $imgAtLimit = UploadedFile::fake()->image('limit_exact.jpg')->size(5120);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$imgAtLimit],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
    }

    /**
     * Group C: Size Limit Tests (Section 5)
     * Image: above 5120 KB limit => REJECT (422) with NO physical file or record created
     */
    public function test_11_image_above_limit_is_rejected_without_physical_or_db_remnants(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        // 5121 KB (above 5120 KB limit)
        $imgAboveLimit = UploadedFile::fake()->image('limit_exceeded.jpg')->size(5121);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$imgAboveLimit],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        // Verify no attachment record and no physical file
        $this->assertDatabaseMissing('chat_attachments', [
            'original_name' => 'limit_exceeded.jpg',
        ]);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group C: Size Limit Tests (Section 5)
     * Document: exactly at 10240 KB limit => ACCEPT
     */
    public function test_12_document_exactly_at_limit_is_accepted(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $docAtLimit = $this->createPdfFile('doc_at_limit.pdf', 10240);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$docAtLimit],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(201);
    }

    /**
     * Group C: Size Limit Tests (Section 5)
     * Document: above 10240 KB limit => REJECT (422) with NO physical file or record created
     */
    public function test_13_document_above_limit_is_rejected_without_remnants(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $docAboveLimit = $this->createPdfFile('doc_huge.pdf', 10241);

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$docAboveLimit],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
        $this->assertDatabaseMissing('chat_attachments', [
            'original_name' => 'doc_huge.pdf',
        ]);
        $this->assertEmpty(Storage::disk('chat_private')->allFiles());
    }

    /**
     * Group D: Max Attachments Per Message (Section 6)
     * 1 file => ACCEPT; 5 files => ACCEPT; 6 files => REJECT (422) with NO partial state
     */
    public function test_14_max_attachments_boundary_and_no_partial_state(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        // 1. Single file => ACCEPT
        $single = [UploadedFile::fake()->image('single.png', 20, 20)];
        $resSingle = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => $single,
            ], ['Accept' => 'application/json']);
        $resSingle->assertStatus(201);

        // 2. Exactly 5 files => ACCEPT
        $batch5 = [
            UploadedFile::fake()->image('b1.png', 20, 20),
            UploadedFile::fake()->image('b2.png', 20, 20),
            UploadedFile::fake()->image('b3.png', 20, 20),
            UploadedFile::fake()->image('b4.png', 20, 20),
            UploadedFile::fake()->image('b5.png', 20, 20),
        ];
        $res5 = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => $batch5,
            ], ['Accept' => 'application/json']);
        $res5->assertStatus(201);
        $this->assertCount(5, $res5->json('data.attachments'));

        $countBefore6 = ChatAttachment::count();
        $filesBefore6 = count(Storage::disk('chat_private')->allFiles());

        // 3. Batch of 6 files => MUST REJECT 422 and leave ZERO partial state
        $batch6 = [
            UploadedFile::fake()->image('f1.png', 20, 20),
            UploadedFile::fake()->image('f2.png', 20, 20),
            UploadedFile::fake()->image('f3.png', 20, 20),
            UploadedFile::fake()->image('f4.png', 20, 20),
            UploadedFile::fake()->image('f5.png', 20, 20),
            UploadedFile::fake()->image('f6.png', 20, 20),
        ];
        $res6 = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => $batch6,
            ], ['Accept' => 'application/json']);
        $res6->assertStatus(422);

        // Verify NO partial state created
        $this->assertEquals($countBefore6, ChatAttachment::count(), 'No new attachments should be saved to DB.');
        $this->assertEquals($filesBefore6, count(Storage::disk('chat_private')->allFiles()), 'No new physical files should be written.');
    }

    /**
     * Empty file (0 bytes) is rejected.
     */
    public function test_15_empty_zero_byte_file_is_rejected(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        $zeroByteFile = UploadedFile::fake()->createWithContent('empty.png', '');

        $res = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/messages", [
                'attachments' => [$zeroByteFile],
            ], ['Accept' => 'application/json']);

        $res->assertStatus(422);
    }

    /**
     * Rate Limiting: 20 uploads in 1 minute, 21st triggers 429.
     */
    public function test_16_upload_rate_limiter_blocks_excessive_requests(): void
    {
        Storage::fake('chat_private');
        $session = $this->createVisitorSession();
        $conv = $this->createConversation($session['token']);

        RateLimiter::clear('chat-attachment-upload');

        for ($i = 0; $i < 20; $i++) {
            $img = UploadedFile::fake()->image("img_{$i}.png", 10, 10);
            $res = $this->withCookie($this->cookieName, $session['token'])
                ->post("/api/chat/conversations/{$conv['uuid']}/attachments", [
                    'attachments' => [$img],
                ], ['Accept' => 'application/json']);
            $res->assertStatus(201);
        }

        // 21st request must trigger 429
        $imgExtra = UploadedFile::fake()->image("img_extra.png", 10, 10);
        $resExtra = $this->withCookie($this->cookieName, $session['token'])
            ->post("/api/chat/conversations/{$conv['uuid']}/attachments", [
                'attachments' => [$imgExtra],
            ], ['Accept' => 'application/json']);

        $resExtra->assertStatus(429);
    }

    /**
     * Agent can send message with attachments via ChatAgentMessageService.
     */
    public function test_17_agent_can_send_message_with_attachments(): void
    {
        Storage::fake('chat_private');

        Role::firstOrCreate(['name' => 'Biên Tập Viên']);
        $agent = User::factory()->create(['name' => 'Agent CSKH']);
        $agent->assignRole('Biên Tập Viên');

        $visitor = ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => 'Khách Hàng',
        ]);

        $conversation = ChatConversation::create([
            'conversation_uuid' => (string) Str::uuid(),
            'chat_visitor_id' => $visitor->id,
            'status' => ChatConversationStatus::Open,
            'assigned_agent_id' => $agent->id,
        ]);

        $agentService = app(ChatAgentMessageService::class);
        $image = UploadedFile::fake()->image('spec.png', 100, 100);

        $message = $agentService->sendAgentMessage(
            $agent,
            $conversation,
            'Quotation attachment',
            [$image]
        );

        $this->assertEquals(ChatMessageSenderType::Agent, $message->sender_type);
        $this->assertCount(1, $message->attachments);
        $this->assertEquals('spec.png', $message->attachments->first()->original_name);
        $this->assertDatabaseHas('chat_attachments', [
            'chat_message_id' => $message->id,
            'original_name' => 'spec.png',
        ]);
    }
}
