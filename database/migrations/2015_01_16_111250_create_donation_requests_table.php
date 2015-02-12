<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationRequestsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donations', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('donor_id');
            $table->integer('blood_request_id');
            $table->boolean('blood');
            $table->boolean('platelets');
            $table->date('will_donate_on');
            $table->text('note');
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
        Schema::drop('blood_donations');
    }

}
