<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(true)->after('is_active');
            $table->boolean('show_on_media')->default(true)->after('show_on_home');
            $table->boolean('show_on_clients')->default(true)->after('show_on_media');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['show_on_home', 'show_on_media', 'show_on_clients']);
        });
    }
};
