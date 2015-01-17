<?php
use Illuminate\Database\Seeder;
use LRC\Data\Users\User;
use LRC\Data\Emergencies\Emergency;
use LRC\Data\Emergencies\EmergencyCase;
use LRC\Data\Emergencies\Ambulance;

use Faker\Factory as Faker;

class EmergencyTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('emergencies')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            $cases      = EmergencyCase::lists('id');
            $users      = User::lists('id');
            $ambulances = Ambulance::lists('id');


            for ($i = 0; $i < 40; $i ++)
            {
                $randomCaseId      = array_rand($cases, 1);
                $randomAmbulanceId = array_rand($ambulances, 1);
                $randomUserIds     = array_rand($users, 4);

                Emergency::create(array(
                    'patientName'     => $faker->name,
                    'parentName'      => $faker->name,
                    'survived'        => $faker->boolean(),
                    'case_id'         => $cases[$randomCaseId],
                    'phonePrimary'    => $faker->phoneNumber,
                    'phoneSecondary'  => $faker->phoneNumber,

                    'location'        => $faker->address,
                    'locationLat'     => $faker->latitude,
                    'locationLong'    => $faker->longitude,

                    'destination'     => $faker->address,
                    'destinationLat'  => $faker->latitude,
                    'destinationLong' => $faker->longitude,

                    'note'            => $faker->sentence(5),

                    'ambulance_id'    => $ambulances[$randomAmbulanceId],

                    'driver_id'       => $users[$randomUserIds[0]],
                    'aiderOne_id'     => $users[$randomUserIds[1]],
                    'aiderTwo_id'     => $users[$randomUserIds[2]],
                    'aiderThree_id'   => $users[$randomUserIds[3]],
                    
                ));
            }
        }

    }

}