<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequests extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table)
        {
            $table->increments('id');

            // Patient info
            $table->string('patient_name');
            $table->integer('blood_type_id');
            $table->integer('quantity');
            $table->integer('quantity_confirmed');
            $table->string('case');

            // Parents info
            $table->integer('contact_name');
            $table->string('phone_primary');
            $table->string('phone_secondary');

            // Hospital or blood bank id;
            $table->integer('blood_bank_id');

            // Request info - importance of the request (High - Medium - Low)
            $table->integer('urgent_level');
            $table->dateTime('due_date');
            $table->text('note');

            // Who created the request
            $table->integer('user_id');

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
        Schema::drop('blood_requests');
    }

}
