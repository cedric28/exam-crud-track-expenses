<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [ 
                'name' => 'Administrator', 
                'email' => 'admin@admin.com', 
                'pw' => 'passw0rd',
                'role_id' => 1
            ]
        ];


        /*
        | @Begin Transaction
        |---------------------------------------------*/
        \DB::beginTransaction();


        foreach($users as $key => $user) {

            try {
             
                // Create Users
                $userObj = User::create([

                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt($user['pw']),
                    'role_id' => $user['role_id']
                ]);

                echo $user['email'] . ' | ';

            } catch (Exception $e) {
                echo 'Duplicate email address ' . $user['email'] . ' | ';
            }   
        }

        echo "\n";


        /*
        | @End Transaction
        |---------------------------------------------*/
        \DB::commit();
    }
}
