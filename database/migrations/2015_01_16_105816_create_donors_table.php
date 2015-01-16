<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('donors', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');

            $table->integer('blood_type_id');

            $table->string('phonePrimary');
            $table->string('phoneSecondary');
            $table->string('email')->unique();

            $table->string('location');
            $table->decimal('lat', 18, 14);
            $table->decimal('long', 18, 14);

            $table->integer('donation_requested');
            $table->integer('donation_completed');

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
        Schema::drop('donors');
	}

}
