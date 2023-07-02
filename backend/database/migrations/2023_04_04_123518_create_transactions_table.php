<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->integer('user_id');
            $table->integer('contact_id');
            $table->integer('departFlight_id');
            $table->integer('returnFlight_id')->nullable();
            $table->string('payment_id');
            $table->string('total_seats');
            $table->string('total_amount');
            $table->string('status');
            $table->date('transaction_date');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
