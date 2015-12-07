<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientAgeToBloodRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('blood_requests', function($table)
        {
            $table->integer('patient_age')->after('patient_name')->default(0);
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blood_requests', function($table)
        {
            $table->dropColumn('patient_age');
        });
	}

}
