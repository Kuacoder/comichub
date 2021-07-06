<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('customer_name');
            $table->string('customer_avatar');
            $table->string('customer_email');
            $table->string('customer_password');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->date('customer_birthday');
            $table->integer('customer_gender');
            $table->integer('customer_status');
            $table->integer('customer_title');
            $table->string('customer_cash');
            $table->string('cash_used');
            $table->string('customer_sales');
            $table->integer('customer_publish');
            $table->string('customer_bank');
            $table->string('customer_date');
            $table->string('customer_update');
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
        Schema::dropIfExists('tbl_customer');
    }
}
