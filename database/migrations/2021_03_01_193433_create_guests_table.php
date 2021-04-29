<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->string('guest_code');
            $table->string('email_id');
            $table->integer('mobile_no');
            $table->text('address')->nullable();
            $table->integer('city_id')->default(0);
            $table->integer('state_id')->default(0);
            $table->integer('pincode')->nullable();
            $table->string('company_name')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->unsignedBigInteger('added_by');
            $table->foreign('added_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('guests');
    }
}
