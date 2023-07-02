<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id('flight_id');
            $table->string('flight_number');
            $table->string('from');
            $table->string('to');
            $table->date('depart_date');
            $table->time('depart_time');
            $table->time('arrive_time');
            $table->string('flight_distance');
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
        Schema::dropIfExists('flights');
    }
}
