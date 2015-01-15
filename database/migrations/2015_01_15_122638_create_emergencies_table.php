<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergenciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('emergencies', function(Blueprint $table)
        {
            $table->increments('id');

            // Patient info
            $table->boolean('survived');
            $table->string('patientName');
            $table->string('parentName');
            $table->string('case_id');
            $table->string('phonePrimary');
            $table->string('phoneSecondary');

            // Location info start - end
            $table->string('location');
            $table->decimal('locationLat', 18, 14);
            $table->decimal('locationLong', 18, 14);

            $table->string('destination');
            $table->decimal('destinationLat', 18, 14);
            $table->decimal('destinationLong', 18, 14);


            // Misc
            $table->text('note');


            // Team info
            $table->integer('ambulance_id');
            $table->integer('driver_id');
            $table->integer('aiderOne_id');
            $table->integer('aiderTwo_id');
            $table->integer('aiderThree_id');


            // Timing
            $table->dateTime('startTime');
            $table->dateTime('endTime');
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
        Schema::drop('emergencies');
	}

}
