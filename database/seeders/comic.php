<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class comic extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_comic')->insert([
            'cate_id' => rand(1, 2),
            'author_id_comic' => rand(1, 124),
            'comic_name' => Str::random(10),
            'session_id' => '',
            'comic_gender' => mt_rand(0, 2),
            'comic_desc' => Str::random(10),
            'comic_content' => Str::random(10),
            'comic_img' => rand(1, 110).'.jpg',
            'cover_img' => 'khunganh.png',
            'comic_area' => mt_rand(1, 6),
            'comic_schedule' => 0,
            'comic_status' => 1,
            'display' => 1,
            'tag' => Str::random(10),
            'comic_price' => 0,
            'comic_view' => 0,
            'day_create' => time(),
            'day_update' => rand(0, time()),
        ]);
          
    }
}
