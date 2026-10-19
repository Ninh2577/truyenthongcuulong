<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChatMessage;
use App\Models\ChatConversation;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;

class CheckMessagesTest extends TestCase
{
    public function test_guest_cannot_access_check_endpoint(): void
    {
        $response = $this->getJson('/cuulongteam/api/chat/check-new-messages');
        $response->assertStatus(401);
    }

    public function test_admin_can_poll_new_messages(): void
    {
        $admin = User::first() ?: User::factory()->create();

        // Baseline call
        $response = $this->actingAs($admin)->getJson('/cuulongteam/api/chat/check-new-messages?last_id=0');
        $response->assertOk();
        $response->assertJsonStructure(['has_new', 'latest_id', 'unread_total']);
        $baselineId = $response->json('latest_id');

        // Call with baselineId -> has_new should be false
        $response2 = $this->actingAs($admin)->getJson("/cuulongteam/api/chat/check-new-messages?last_id={$baselineId}");
        $response2->assertOk();
        $response2->assertJson(['has_new' => false]);
    }
}
