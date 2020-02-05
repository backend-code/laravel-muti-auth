<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    
        /**
        * Run the database seeds.
        *
        * @return void
        */
    
        public function run()
     {
            // Let's clear the users table first
            User::truncate();
    
            $faker = \Faker\Factory::create();
    
            // Let's make sure everyone has the same password and
            // let's hash it before the loop, or else our seeder
            // will be too slow.
            $password = Hash::make('toptal');
    
            Admin::create([
                'first_name' =>  $faker->first_name,
                'last_name' =>  $faker->last_name,
                'token_type' =>  $faker->token_type,
                'email' => $faker->email,
                'password' => $password,
                'password_confirmation' => $faker->password_confirmation,
            ]);
    
            // And now let's generate a few dozen Admins for our app:
            for ( $i = 0; $i < 10; $i++ ) {
                Admin::create( [
                    'first_name' =>  $faker->first_name,
                    'last_name' =>  $faker->last_name,
                    'token_type' =>  $faker->token_type,
                    'email' => $faker->email,
                    'password' => $password,
                    'password_confirmation' => $faker->password_confirmation,
                ] );
            }
        }
    
}
