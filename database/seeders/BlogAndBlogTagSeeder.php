<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogAndBlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            # code...
            DB::table('blog_blog_tag')->insert([
                'blog_id' => rand(1, 9),
                'blog_tag_id' => rand(1, 9),
            ]);
        }
    }
}
