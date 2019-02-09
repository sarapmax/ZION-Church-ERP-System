<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->date('date');
            $table->string('financial_witnesses')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('service_rounds');
    }
}
