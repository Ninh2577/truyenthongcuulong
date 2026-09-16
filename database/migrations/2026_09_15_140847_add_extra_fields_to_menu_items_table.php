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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('subtitle')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('badge_color')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('bg_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'badge_text', 'badge_color', 'icon_color', 'bg_color']);
        });
    }
};
