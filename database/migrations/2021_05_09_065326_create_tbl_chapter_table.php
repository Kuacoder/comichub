<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chapter', function (Blueprint $table) {
            $table->bigIncrements('chapter_id');
            $table->integer('comic_id');
            $table->string('chapter_name');
            $table->string('chapter_desc');
            $table->string('chapter_img');
            $table->integer('status');
            $table->integer('display');
            $table->integer('numberical_order');
            $table->string('chapter_price');
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
        Schema::dropIfExists('tbl_chapter');
    }
}
