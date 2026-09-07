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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('pillar_group', 50)->nullable()->after('type');
            $table->integer('display_order')->default(0)->after('pillar_group');
            $table->boolean('is_industry_filter')->default(false)->after('display_order');
            $table->index('pillar_group');
            $table->index('is_industry_filter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['pillar_group']);
            $table->dropIndex(['is_industry_filter']);
            $table->dropColumn(['pillar_group', 'display_order', 'is_industry_filter']);
        });
    }
};
