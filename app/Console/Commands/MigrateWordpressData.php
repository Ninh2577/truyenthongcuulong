<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class MigrateWordpressData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:wordpress {--prefix= : The table prefix for wordpress database (e.g. wp_)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from legacy WordPress database to Laravel database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting WordPress data migration...');

        try {
            DB::connection('wordpress_legacy')->getPdo();
        } catch (\Exception $e) {
            $this->error('Could not connect to the wordpress_legacy database. Please check your config/database.php settings.');
            $this->error($e->getMessage());
            return 1;
        }

        $prefix = $this->option('prefix') ?: config('database.connections.wordpress_legacy.prefix');
        if (empty($prefix)) {
            $prefix = $this->ask('What is your WordPress table prefix?', 'wp_');
        }
        
        // Cập nhật lại prefix cho connection để Laravel tự động gắn
        config(['database.connections.wordpress_legacy.prefix' => $prefix]);
        DB::purge('wordpress_legacy');

        $this->info("Using table prefix: {$prefix}");

        $this->migrateUsers();
        $this->migrateCategories();
        $this->migratePosts();

        $this->info('Migration completed successfully!');
        return 0;
    }

    protected function migrateUsers()
    {
        $this->info('Migrating users...');
        
        try {
            // Note: If you get "Table doesn't exist", double check the prefix
            $wpUsers = DB::connection('wordpress_legacy')->table('users')->get();
            $count = 0;
            
            foreach ($wpUsers as $wpUser) {
                User::firstOrCreate(
                    ['email' => $wpUser->user_email],
                    [
                        'name' => $wpUser->display_name ?: $wpUser->user_login,
                        'password' => $wpUser->user_pass, 
                        'created_at' => $wpUser->user_registered,
                    ]
                );
                $count++;
            }
            
            $this->info("Migrated {$count} users.");
        } catch (\Exception $e) {
            $this->warn("Error migrating users: " . $e->getMessage());
        }
    }

    protected function migrateCategories()
    {
        $this->info('Migrating categories...');
        
        try {
            $wpCategories = DB::connection('wordpress_legacy')
                ->table('terms as t')
                ->join('term_taxonomy as tt', 't.term_id', '=', 'tt.term_id')
                ->where('tt.taxonomy', 'category')
                ->get();

            $count = 0;
            foreach ($wpCategories as $wpCat) {
                Category::updateOrCreate(
                    ['slug' => $wpCat->slug],
                    [
                        'name' => $wpCat->name,
                        'description' => $wpCat->description,
                        'type' => 'general',
                    ]
                );
                $count++;
            }
            
            $this->info("Migrated {$count} categories.");
        } catch (\Exception $e) {
            $this->warn("Error migrating categories: " . $e->getMessage());
        }
    }

    protected function migratePosts()
    {
        $this->info('Migrating posts...');
        
        try {
            $wpPosts = DB::connection('wordpress_legacy')
                ->table('posts')
                ->where('post_type', 'post')
                ->where('post_status', 'publish')
                ->get();

            $defaultUser = User::first();
            $count = 0;

            foreach ($wpPosts as $wpPost) {
                // Find matching category
                $categoryId = null;
                $termRel = DB::connection('wordpress_legacy')
                    ->table('term_relationships as tr')
                    ->join('term_taxonomy as tt', 'tr.term_taxonomy_id', '=', 'tt.term_taxonomy_id')
                    ->join('terms as t', 'tt.term_id', '=', 't.term_id')
                    ->where('tr.object_id', $wpPost->ID)
                    ->where('tt.taxonomy', 'category')
                    ->first();
                
                if ($termRel) {
                    $laravelCat = Category::where('slug', $termRel->slug)->first();
                    if ($laravelCat) {
                        $categoryId = $laravelCat->id;
                    }
                }

                // Get thumbnail URL
                $thumbnail = null;
                $meta = DB::connection('wordpress_legacy')
                    ->table('postmeta')
                    ->where('post_id', $wpPost->ID)
                    ->where('meta_key', '_thumbnail_id')
                    ->first();
                
                if ($meta && $meta->meta_value) {
                    $attachment = DB::connection('wordpress_legacy')
                        ->table('posts')
                        ->where('ID', $meta->meta_value)
                        ->first();
                    if ($attachment) {
                        $thumbnail = $attachment->guid;
                    }
                }

                Post::updateOrCreate(
                    ['slug' => $wpPost->post_name ?: Str::slug($wpPost->post_title)],
                    [
                        'title' => $wpPost->post_title,
                        'content' => $wpPost->post_content,
                        'summary' => $wpPost->post_excerpt,
                        'status' => 'published',
                        'published_at' => $wpPost->post_date,
                        'category_id' => $categoryId,
                        'author_id' => $defaultUser ? $defaultUser->id : null,
                        'thumbnail' => $thumbnail,
                        'views' => 0,
                    ]
                );
                
                $count++;
            }
            
            $this->info("Migrated {$count} posts.");
        } catch (\Exception $e) {
            $this->warn("Error migrating posts: " . $e->getMessage());
        }
    }
}
