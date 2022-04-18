<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoSmsdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mo_smsdetails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('client');
            $table->string('source_addr');
            $table->string('destination_addr');
            $table->string('service_type')->nullable();
            $table->string('short_message');
            $table->string('status');
            $table->string('provider');
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