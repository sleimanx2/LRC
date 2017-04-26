<?php
use Illuminate\Database\Seeder;
use LRC\Data\Users\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Delete Table
        DB::table('users')->delete();

        $faker = Faker::create();

        User::create([
            'first_name'    => 'Super',
            'last_name'     => 'User',
            'email'         => 'admin@lrc.com',
            'nickname'      => 'super',
            'username'      => 'super.user',
            'promo'         => '2009',
            'password'      => Hash::make(123456),
            'phone_numbers' => [$faker->phoneNumber, $faker->phoneNumber],
            'location'      => $faker->address,
            'latitude'      => $faker->latitude,
            'longitude'     => $faker->longitude,
            'is_active'     => 1
        ]);

        if (app()->environment() == 'local') {
            for ($i = 0; $i < 40; $i++) {
                User::create([
                    'first_name'    => $faker->firstName,
                    'last_name'     => $faker->lastName,
                    'email'         => $faker->email,
                    'nickname'      => $faker->firstName,
                    'username'      => $faker->firstName . "." . $faker->lastName,
                    'promo'         => $faker->year,
                    'password'      => Hash::make(123456),
                    'phone_numbers' => [$faker->phoneNumber, $faker->phoneNumber],
                    'location'      => $faker->address,
                    'latitude'      => $faker->latitude,
                    'longitude'     => $faker->longitude,
                    'is_active'     => 1
                ]);
            }
        }

    }

}