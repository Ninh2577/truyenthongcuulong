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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('channel')->nullable()->default('website')->after('service_interested');
            $table->string('customer_type')->nullable()->default('Khách hàng mới')->after('fullname');
            $table->string('avatar')->nullable()->after('customer_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['channel', 'customer_type', 'avatar']);
        });
    }
};
