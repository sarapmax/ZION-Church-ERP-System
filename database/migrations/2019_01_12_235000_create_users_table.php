<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->unsignedInteger('cell_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('administrative_status');
            $table->unsignedInteger('spiritual_status');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nickname');
            $table->string('gender');
            $table->date('birthday');
            $table->string('idcard', 13)->unique();
            $table->string('race');
            $table->string('nationality');
            $table->string('mobile_number', 10);
            $table->string('facebook')->nullable();
            $table->string('line')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cell_id')->references('id')->on('cells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
