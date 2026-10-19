<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->string('source_url', 500)->nullable()->after('channel');
            $table->string('source_path', 255)->nullable()->after('source_url');
            $table->string('source_title', 255)->nullable()->after('source_path');
            $table->json('tags')->nullable()->after('source_title');
            $table->string('lead_status', 50)->default('new')->after('tags')->index();
        });
    }

    public function down(): void
    {
        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropColumn(['source_url', 'source_path', 'source_title', 'tags', 'lead_status']);
        });
    }
};
