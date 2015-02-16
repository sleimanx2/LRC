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
            $table->string('patient_name');
            $table->string('parent_name');
            $table->string('report_category_id');
            $table->string('phone_primary');
            $table->string('phone_secondary');

            // Location info start - end
            $table->string('location');
            $table->decimal('location_latitude', 18, 14);
            $table->decimal('location_longitude', 18, 14);

            $table->string('destination');
            $table->decimal('destination_latitude', 18, 14);
            $table->decimal('destination_longitude', 18, 14);


            // Misc
            $table->text('note');


            // Team info
            $table->integer('ambulance_id');
            $table->integer('driver_id');
            $table->integer('scout_id');
            $table->integer('patient_aider_id');
            $table->integer('assistant_id');


            // Timing
            $table->dateTime('start_time');
            $table->dateTime('end_time');
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
