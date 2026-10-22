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
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_page')->default(false)->after('article_type')->index();
            $table->string('page_template', 50)->default('standard')->after('is_page');
            $table->boolean('show_toc')->default(true)->after('page_template');
            $table->boolean('show_cta_form')->default(true)->after('show_toc');
            $table->boolean('show_author_date')->default(true)->after('show_cta_form');
            $table->string('schema_type', 50)->default('Article')->after('show_author_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['is_page']);
            $table->dropColumn([
                'is_page',
                'page_template',
                'show_toc',
                'show_cta_form',
                'show_author_date',
                'schema_type',
            ]);
        });
    }
};
