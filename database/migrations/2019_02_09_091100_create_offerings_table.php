<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('financial_officer_id');
            $table->unsignedInteger('service_round_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('type');
            $table->unsignedBigInteger('amount');
            $table->boolean('need_receipt')->default(false);
            $table->timestamps();

            $table->foreign('service_round_id')->references('id')->on('service_rounds');
            $table->foreign('financial_officer_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerings');
    }
}
