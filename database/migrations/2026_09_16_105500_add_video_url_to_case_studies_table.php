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
        Schema::table('case_studies', function (Blueprint $table) {
            if (!Schema::hasColumn('case_studies', 'video_url')) {
                $table->string('video_url', 500)->nullable()->after('thumbnail');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            if (Schema::hasColumn('case_studies', 'video_url')) {
                $table->dropColumn('video_url');
            }
        });
    }
};
