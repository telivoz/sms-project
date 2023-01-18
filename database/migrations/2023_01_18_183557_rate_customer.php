<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RateCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('rate_customers', function (Blueprint $table) {
		    $table->id();
		    $table->timestamps();
		    $table->string('code');
		    $table->string('destination');
		    $table->string('company');
		    $table->float('cost');
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
