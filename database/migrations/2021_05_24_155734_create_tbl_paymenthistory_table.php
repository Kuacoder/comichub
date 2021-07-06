<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPaymenthistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_paymenthistory', function (Blueprint $table) {
            $table->bigIncrements('payment_history_id');
            $table->integer('customer_id');
            $table->integer('payment_history_status');
            $table->string('payment_history_create_date');
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
        Schema::dropIfExists('tbl_paymenthistory');
    }
}
