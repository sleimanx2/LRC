<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        // Delete Table
        DB::table('role_user')->delete();

        // Administrator Role for super user
        $super_user_roles = array(
        	array('user_id' => 1, 'role_id' => 9)
        );

        // Ex Member Roles
        // Count = 230, so insert ex_member roles for 1st 230 users after super user
        // ie: IDs starting 2 until 231
        $ex_member_roles = array();
    	for($i = 2; $i <= 231; $i++)
        	array_push($ex_member_roles, array('user_id' => $i, 'role_id' => 7));

        // Regional Manager Roles
        $regional_manager_roles = array(
        	array('user_id' => 35, 'role_id' => 1), // Rita Asmar
        	array('user_id' => 36, 'role_id' => 1), // Samer Asmar
        	array('user_id' => 45, 'role_id' => 1), // Edwardo Bader
        	array('user_id' => 59, 'role_id' => 1), // Daniel Boudjok
        	array('user_id' => 129, 'role_id' => 1), // Hadi Khalaf
        	array('user_id' => 130, 'role_id' => 1), // Antoine Khater
        	array('user_id' => 179, 'role_id' => 1), // Junior Raad
        	array('user_id' => 187, 'role_id' => 1), // Chirine Rizkallah
        	array('user_id' => 199, 'role_id' => 1), // Houssam Shaiban
        	array('user_id' => 231, 'role_id' => 1), // Jacques Abi Nakhoul
        	array('user_id' => 232, 'role_id' => 1), // Elias Bkaakafri
        );

        // Ambulance Driver Roles
        $ambulance_driver_roles = array(
        	array('user_id' => 232, 'role_id' => 3), // Elias Bkaakafri
        	array('user_id' => 233, 'role_id' => 3), // Emile Neaimeh
        	array('user_id' => 234, 'role_id' => 3), // Maria-Pia Ibrahim
        	array('user_id' => 235, 'role_id' => 3), // Emile Atallah
        	array('user_id' => 236, 'role_id' => 3), // Leonard Labaki
        );

        DB::table('role_user')->insert($super_user_roles);
        DB::table('role_user')->insert($ex_member_roles);
        DB::table('role_user')->insert($regional_manager_roles);
        DB::table('role_user')->insert($ambulance_driver_roles);
    }
}