<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
            $table->string('last_name');
			$table->string('nickname')->nullable();
			$table->string('username')->unique();
			$table->integer('promo');
			$table->string('email')->unique();
			$table->string('password', 60);
            $table->json('phone_numbers');
            $table->string('location');
            $table->decimal('latitude', 18, 14);
            $table->decimal('longitude', 18, 14);
			$table->text('note');
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
