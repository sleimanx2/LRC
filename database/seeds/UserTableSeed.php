<?php
use Illuminate\Database\Seeder;
use LRC\Data\Users\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('users')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            for ($i = 0; $i < 40; $i ++)
            {
                User::create(array(
                    'first_name'      => $faker->firstName,
                    'last_name'       => $faker->lastName,
                    'email'           => $faker->email,
                    'password'        => Hash::make(123456),
                    'phone_primary'   => $faker->phoneNumber,
                    'phone_secondary' => $faker->phoneNumber,
                    'location'        => $faker->address,
                    'latitude'        => $faker->latitude,
                    'longitude'       => $faker->longitude,
                ));
            }
        }

    }

}