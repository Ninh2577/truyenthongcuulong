<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', 'admin@truyenthongcuulong.com')
                ->where(function ($query) {
                    $query->where('name', 'admin@truyenthongcuulong.com')
                        ->orWhere('name', 'LIKE', '%@%')
                        ->orWhereNull('name')
                        ->orWhere('name', '');
                })
                ->update(['name' => 'Quản trị viên']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No down migration required
    }
};
