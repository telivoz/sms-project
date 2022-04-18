<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Providers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*CREATE TABLE public.provider (                                                                                                                                                                
  uid character varying(255) NOT NULL,
  updated_by character varying NULL,
  updated_at timestamp without time zone NOT NULL,
  created_by character varying NOT NULL,
  created_at timestamp without time zone NOT NULL,
  rate_int character varying(255) NOT NULL,
  rate_br character varying(255) NOT NULL,
  balance character varying(255) NOT NULL,
  company_cnpj character varying(255) NOT NULL,
  company character varying(255) NOT NULL,
  phone character varying(255) NULL,
  address character varying(255) NULL,
  name character varying(255) NOT NULL,
  id integer NOT NULL
);
*/
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('address');
            $table->string('phone');
            $table->string('company');
            $table->string('balance');
            $table->string('rate');
            
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
