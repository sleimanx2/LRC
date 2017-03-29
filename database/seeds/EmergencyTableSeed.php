<?php
use Illuminate\Database\Seeder;
use LRC\Data\Emergencies\ReportCategory;
use LRC\Data\Users\User;
use LRC\Data\Emergencies\Emergency;
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
            $report_categories = ReportCategory::pluck('id');
            $users             = User::pluck('id');
            $ambulances        = Ambulance::pluck('id');


            for ($i = 0; $i < 40; $i ++)
            {
                $randomReportCategoryId = array_rand($report_categories->toArray(), 1);
                $randomAmbulanceId      = array_rand($ambulances->toArray(), 1);
                $randomUserIds          = array_rand($users->toArray(), 4);

                Emergency::create(array(
                    'contact_name'          => $faker->name,
                    'report_category_id'    => $report_categories[$randomReportCategoryId],
                    'phone_primary'         => $faker->phoneNumber,
                    'phone_secondary'       => $faker->phoneNumber,

                    'location'              => $faker->address,
                    'location_latitude'     => $faker->latitude,
                    'location_longitude'    => $faker->longitude,

                    'destination'           => $faker->address,
                    'destination_latitude'  => $faker->latitude,
                    'destination_longitude' => $faker->longitude,

                    'note'                  => $faker->sentence(5),

                    'ambulance_id'          => $ambulances[$randomAmbulanceId],

                    'driver_id'             => $users[$randomUserIds[0]],
                    'scout_id'              => $users[$randomUserIds[1]],
                    'patient_aider_id'      => $users[$randomUserIds[2]],
                    'assistant_id'          => $users[$randomUserIds[3]],

                ));
            }
        }

    }

}