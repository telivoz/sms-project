<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubmitLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*CREATE TABLE public.submit_log (
    id integer NOT NULL,
    msgid character varying(45) NOT NULL,
    source_connector character varying(15) NOT NULL,
    routed_cid character varying(30) NOT NULL,
    source_addr character varying(40) NOT NULL,
    destination_addr character varying(40) NOT NULL,
    rate numeric(8,2) NOT NULL,
    pdu_count integer NOT NULL,
    short_message text NOT NULL,
    binary_message bytea NOT NULL,
    status character varying(15) NOT NULL,
    uid character varying(15) NOT NULL,
    trials integer,
    created_at timestamp with time zone NOT NULL,
    status_at timestamp with time zone NOT NULL,
    CONSTRAINT submit_log_pdu_count_check CHECK ((pdu_count >= 0)),
    CONSTRAINT submit_log_trials_check CHECK ((trials >= 0)));*/
        Schema::create('submit_logs', function (Blueprint $table) {
            $table->id();
            $table->char('msgid',45);
            $table->char('source_connector',15);
            $table->char('routed_cid',30);
            $table->char('source_addr',40);
            $table->char('destination_addr',40);
            $table->integer('rate');
            $table->integer('pdu_count');
            $table->text('short_message');
            $table->binary('binary_message');
            $table->string('status');
            $table->char('uid',15);
            $table->integer('trials')->nullable(true);
            $table->timestamp('created_at',$precision = 0);
            //$table->timestamp('status_at',$precision = 0);
        });
        DB::statement('ALTER TABLE submit_logs ADD CONSTRAINT submit_log_pdu_count_check CHECK ((pdu_count >= 0))');
        DB::statement('ALTER TABLE submit_logs ADD CONSTRAINT submit_log_trials_check CHECK ((trials >= 0))');

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
