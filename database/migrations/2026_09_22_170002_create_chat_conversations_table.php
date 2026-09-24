<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid('conversation_uuid')->unique();
            $table->foreignId('chat_visitor_id')
                ->constrained('chat_visitors')
                ->cascadeOnDelete();
            $table->foreignId('assigned_to_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('status', 30)->default('open')->index();
            $table->string('channel', 30)->default('human')->index();
            $table->timestamp('last_message_at')->nullable()->index();
            $table->unsignedInteger('visitor_unread_count')->default(0);
            $table->unsignedInteger('agent_unread_count')->default(0);
            $table->timestamp('closed_at')->nullable();
            $table->foreignId('closed_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'last_message_at']);
            $table->index(['assigned_to_user_id', 'status', 'last_message_at'], 'conv_assigned_status_last_msg_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_conversations');
    }
};
