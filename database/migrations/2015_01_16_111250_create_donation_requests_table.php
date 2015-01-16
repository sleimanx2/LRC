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
        Schema::create('donation_requests', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id');
            $table->integer('donor_id');
            $table->integer('bloodRequest_id');
            $table->boolean('confirmed');
            $table->boolean('declined');

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
        Schema::drop('donation_requests');
	}

}
