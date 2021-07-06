<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class chapterunlock extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('tbl_chapterunlock')->insert([
            'comic_name' => Str::random(10),
            'chapter_id' => rand(1, 10),
            'comic_id' => rand(1, 300),
            'customer_id' => rand(1, 124),
            'author_comic' => Str::random(10),
            'chapter_name' => Str::random(10),
            'author_chapter' => Str::random(10),
            'chapter_price' => rand(1, 5000),
            'buyer' => Str::random(10),
            'day_create_order' => date('y-m-d',time())
        ]);
    }
}