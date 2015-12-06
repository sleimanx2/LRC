<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReachTimeTransferTimeToEmergencies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('emergencies', function($table){
	        $table->dateTime('reach_time')->after('start_time');
	        $table->dateTime('transfer_time')->after('reach_time');
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
	        $table->dropColumn('reach_time');
	        $table->dropColumn('transfer_time');
		});
	}

}
