<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmbulancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ambulances', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('plate_number')->unique();
            $table->string('brand');
            $table->integer('year');
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
		Schema::drop('ambulances');
	}

}
