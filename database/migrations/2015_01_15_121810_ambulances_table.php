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
            $table->string('name');
            $table->string('brand');
            $table->integer('year');
            $table->integer('plateNumber')->unique();
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
