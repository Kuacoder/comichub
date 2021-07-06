<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class customer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_customer')->insert([
            'customer_name' => Str::random(10),
            'customer_avatar' => rand(1,100).'.jpg',
            'customer_email' => Str::random(10).'@gmail.com',
            'customer_password' => Hash::make('password'),
            'customer_phone' => rand(),
            'customer_address' => Str::random(10),
            'customer_birthday' => date("Y-m-d",rand(0,time())),
            'customer_gender' => rand(1,2),
            'customer_status' => 1,
            'customer_title' => rand(0,1),
            'customer_cash' => 0,
            'customer_sales' => 0,
            'customer_publish' => 0,
            'cash_used' => 0,
            'number_noti' => 0,
            'customer_date' => time(),
            'customer_update' => 1619670581,
          
        ]);
    }
}
