<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Biên Tập Viên', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Cộng Tác Viên', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'panel_user', 'guard_name' => 'web']);

        $users = [
            [
                'id' => 1,
                'name' => 'Cửu Long Team',
                'email' => 'phucnguyen@truyenthongcuulong.com',
                'password' => '$2y$12$X78mBfL732TdOGn8i2sEBOZ.923ZQILNOB5FHdSz9snfKeb6CAzuy',
                'created_at' => '2026-09-15 02:40:00',
                'updated_at' => '2026-09-15 02:40:00',
            ],
            [
                'id' => 2,
                'name' => 'Minh',
                'email' => 'minhminh3898@gmail.com',
                'password' => '$2y$12$OK1LvJnqXO7sya/TLfp2geH9TfrwZuQeCFljKev7qVTFwxT8fOJbi',
                'created_at' => '2026-09-15 02:40:00',
                'updated_at' => '2026-09-15 02:40:00',
            ],
            [
                'id' => 3,
                'name' => 'Minh Thành',
                'email' => 'Caothanhtctva@gmail.com',
                'password' => '$2y$12$a7gEFDCFdOKUNpk/U.Fj9ea5sbgh4xUecbAM6npnD2p/ihWvT96eS',
                'created_at' => '2026-09-15 02:40:00',
                'updated_at' => '2026-09-15 02:40:00',
            ],
            [
                'id' => 4,
                'name' => 'hoangninh1712',
                'email' => 'hoangninh2577@gmail.com',
                'password' => '$2y$12$KLC.tyGB.APKBIWZNaQGdu8QuYRZyO92cV4Rwsaorsoh66JTZx4uW',
                'created_at' => '2026-09-15 02:40:01',
                'updated_at' => '2026-09-15 02:40:01',
            ],
            [
                'id' => 5,
                'name' => 'Quản trị viên',
                'email' => 'admin@truyenthongcuulong.com',
                'password' => '$2y$12$0Z67Vh6ecriBkQ4JBAbzaOv4tE2puuX88.mnT0jceYN83NNzAd87a',
                'remember_token' => 'tXP9V1lbcF9txrmsDjrE9TfqLauwH5iUmvLoSMDFAkZlGA9q4XUfjY1IJTbp',
                'created_at' => '2026-09-15 02:47:05',
                'updated_at' => '2026-09-15 02:47:05',
            ],
        ];

        foreach ($users as $u) {
            DB::table('users')->updateOrInsert(['id' => $u['id']], $u);
        }

        $adminUser = User::find(5);
        if ($adminUser) {
            $adminUser->syncRoles([$adminRole, $superAdminRole]);
        }

        $user1 = User::find(1);
        if ($user1) {
            $user1->syncRoles([$adminRole]);
        }

        $user4 = User::find(4);
        if ($user4) {
            $user4->syncRoles([$adminRole]);
        }
    }
}
