<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('thumbnail');
            $table->string('views_metric', 50)->default('1.5M+')->after('video_url');
            $table->string('reach_metric', 50)->default('5.2M+')->after('views_metric');
            $table->string('conversion_metric', 50)->default('+240%')->after('reach_metric');
        });
    }

    public function down(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'views_metric', 'reach_metric', 'conversion_metric']);
        });
    }
};
