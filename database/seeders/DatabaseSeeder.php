<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
      while(true){
          $i++;
          $this->call(
            chapterunlock::class
            );
          if($i == 20){
              break;
          }
      }
    }
}