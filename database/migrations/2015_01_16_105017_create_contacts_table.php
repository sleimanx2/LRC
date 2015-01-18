<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('phone_primary');
            $table->string('phone_secondary');
            $table->string('location');
            $table->decimal('latitude', 18, 14);
            $table->decimal('longitude', 18, 14);
            $table->integer('category_id');
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
        Schema::drop('contacts');
    }

}
