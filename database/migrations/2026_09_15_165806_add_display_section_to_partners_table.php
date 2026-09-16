<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // 1 = Top Tier (max 3), 2 = Gold Tier (max 3), 3 = Strategic (max 12), null = không hiển thị ở mục nào
            $table->unsignedTinyInteger('display_section')->nullable()->after('show_on_partner_page')
                  ->comment('Mục hiển thị trên trang đối tác: 1=Top Tier, 2=Gold Tier, 3=Strategic. Null = không hiển thị.');
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('display_section');
        });
    }
};
