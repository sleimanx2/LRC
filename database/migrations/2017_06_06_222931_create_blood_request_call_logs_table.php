<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequestCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_request_call_logs', function($t)
        {
            $t->increments('id');
            $t->integer('blood_request_id');
            $t->integer('user_id');
            $t->integer('donor_id');
            $t->string('call_type');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blood_request_call_logs');
    }
}
