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
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->boolean('show_on_pricing_page')->default(true)->after('is_active');
            $table->boolean('show_on_service_page')->default(true)->after('show_on_pricing_page');
            $table->string('target_page')->nullable()->after('show_on_service_page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropColumn(['show_on_pricing_page', 'show_on_service_page', 'target_page']);
        });
    }
};
