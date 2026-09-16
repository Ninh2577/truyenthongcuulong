<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Lấy dữ liệu cũ (integer) trước khi đổi kiểu
        $partners = DB::table('partners')->select('id', 'display_section')->get();

        // Đổi cột sang JSON
        Schema::table('partners', function (Blueprint $table) {
            $table->json('display_sections')->nullable()->after('show_on_partner_page')
                  ->comment('Mảng mục hiển thị: [1,2,3] — 1=Top, 2=Gold, 3=Strategic');
        });

        // Migrate dữ liệu cũ: integer -> JSON array
        foreach ($partners as $partner) {
            if (!is_null($partner->display_section)) {
                DB::table('partners')->where('id', $partner->id)->update([
                    'display_sections' => json_encode([(int)$partner->display_section]),
                ]);
            }
        }

        // Xóa cột cũ
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('display_section');
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->unsignedTinyInteger('display_section')->nullable()->after('show_on_partner_page');
            $table->dropColumn('display_sections');
        });
    }
};
