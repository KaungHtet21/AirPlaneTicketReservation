<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mileages', function (Blueprint $table) {
            $table->id('passenger_id');
            $table->string('passenger_name');
            $table->string('nrc')->nullable();
            $table->string('passport')->nullable();
            $table->string('miles_travelled');
            $table->string('membership_tier')->nullable();
            $table->string('member_code')->nullable();
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
        Schema::dropIfExists('mileages');
    }
};
