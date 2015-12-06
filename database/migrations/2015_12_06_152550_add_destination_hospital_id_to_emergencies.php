<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDestinationHospitalIdToEmergencies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('emergencies', function($table){
	        $table->integer('destination_hospital_id')->default(0)->after('destination_longitude');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('emergencies', function($table){
	        $table->dropColumn('destination_hospital_id');
		});
	}

}
