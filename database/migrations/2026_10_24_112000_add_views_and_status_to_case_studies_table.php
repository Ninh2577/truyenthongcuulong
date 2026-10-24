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
        if (Schema::hasTable('case_studies')) {
            Schema::table('case_studies', function (Blueprint $table) {
                if (!Schema::hasColumn('case_studies', 'views')) {
                    $table->unsignedBigInteger('views')->default(0)->after('order');
                }
                if (!Schema::hasColumn('case_studies', 'status')) {
                    $table->string('status', 30)->default('active')->after('order');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('case_studies')) {
            Schema::table('case_studies', function (Blueprint $table) {
                if (Schema::hasColumn('case_studies', 'views')) {
                    $table->dropColumn('views');
                }
                if (Schema::hasColumn('case_studies', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};
