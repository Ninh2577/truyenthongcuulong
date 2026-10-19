<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->string('client_message_id', 64)->nullable()->after('message_uuid')->index();
            $table->timestamp('deleted_at')->nullable()->after('recalled_at');
        });
    }

    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropIndex(['client_message_id']);
            $table->dropColumn(['client_message_id', 'deleted_at']);
        });
    }
};
