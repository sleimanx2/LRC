<?php
use Illuminate\Database\Seeder;
use LRC\Data\Blood\BloodType;
use LRC\Data\Blood\BloodDonor;

use Faker\Factory as Faker;

class BloodDonorTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('blood_donors')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            $bloodTypes = BloodType::lists('id');

            $genders = ['male', 'female'];

            for ($i = 0; $i < 200; $i ++)
            {
                $bloodTypeId = array_rand($bloodTypes, 1);

                $genderKey   = array_rand($genders);
                $genderValue = $genders[$genderKey];

                BloodDonor::create(array(

                    'first_name'         => $faker->firstName,
                    'last_name'          => $faker->lastName,
                    'blood_type_id'      => $bloodTypes[$bloodTypeId],
                    'gender'             => $genderValue,
                    'birthday'           => $faker->date(),
                    'phone_primary'      => $faker->phoneNumber,
                    'phone_secondary'    => $faker->phoneNumber,

                    'email'              => $faker->email,

                    'location'           => $faker->address,
                    'latitude'           => $faker->latitude,
                    'longitude'          => $faker->longitude,

                    'donation_requested' => $faker->numberBetween(0, 10),
                    'donation_completed' => $faker->numberBetween(0, 10),
                    'golden_donor'       => $faker->boolean(),
                    'incapable_till'     => $faker->date(),

                ));
            }
        }

    }

}