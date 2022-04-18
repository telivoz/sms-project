<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uid');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('address');
            $table->string('phone');
            $table->string('company');
            $table->string('balance');
            $table->string('rate');
            $table->integer('profile');
            $table->string('currency');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
