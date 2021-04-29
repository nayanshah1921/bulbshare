<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('room_type_id');
            $table->integer('room_id')->default(0);
            $table->integer('days')->default(0);
            $table->date('booking_date');
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->integer('status');
            $table->date('payment_date')->nullable();
            $table->integer('payment_mode')->default(0);
            $table->string('instrument_no')->nullable();
            $table->date('instrument_date')->nullable();
            $table->string('instrument_bank')->nullable();
            $table->text('instructions')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
