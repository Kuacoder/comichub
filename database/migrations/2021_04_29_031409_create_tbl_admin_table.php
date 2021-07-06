<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_email');
            $table->string('admin_password');
            $table->string('admin_name');
            $table->string('admin_avatar');
            $table->string('admin_phone');
            $table->string('admin_address');
            $table->date('admin_birthday');
            $table->integer('admin_gender');
            $table->integer('admin_status');
            $table->integer('admin_title');
            $table->string('admin_cash');
            $table->string('admin_sales');
            $table->integer('admin_publish');
            $table->string('admin_date');
            $table->string('admin_update');
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
        Schema::dropIfExists('tbl_admin');
    }
}
