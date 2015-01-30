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
        Schema::create('blood_donors', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('first_name');
            $table->string('last_name');

            $table->integer('blood_type_id');

            $table->string('phone_primary');
            $table->string('phone_secondary');
            $table->string('email')->unique();

            $table->string('location');
            $table->decimal('latitude', 18, 14);
            $table->decimal('longitude', 18, 14);

            $table->date('birthday');
            $table->string('gender',40);


            $table->integer('donation_requested');
            $table->integer('donation_completed');

            // if the donor wants to donate regularly
            $table->boolean('golden_donor');

            // the last time the user donated
            $table->date('incapable_till');


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
        Schema::drop('blood_donors');
	}

}
