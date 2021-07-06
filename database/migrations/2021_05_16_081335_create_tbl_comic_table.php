<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblComicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_comic', function (Blueprint $table) {
            $table->bigIncrements('comic_id');
            $table->integer('cate_id');
            $table->integer('author_id');
            $table->string('comic_name');
            $table->integer('comic_gender');
            $table->string('comic_desc');
            $table->string('comic_content');
            $table->string('comic_img');
            $table->string('cover_img');
            $table->integer('comic_area');
            $table->integer('comic_schedule');
            $table->integer('status');
            $table->integer('display');
            $table->string('tag');
            $table->string('comic_price');
            $table->string('day_create');
            $table->string('day_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_comic');
    }
}
