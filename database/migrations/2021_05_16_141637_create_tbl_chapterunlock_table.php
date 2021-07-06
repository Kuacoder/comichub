<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblChapterunlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chapterunlock', function (Blueprint $table) {
            $table->bigIncrements('chapterunlock_id');
            $table->integer('comic_id');
            $table->integer('chapter_id');
            $table->string('customer_id');
            $table->string('day_create');
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
        Schema::dropIfExists('tbl_chapterunlock');
    }
}
