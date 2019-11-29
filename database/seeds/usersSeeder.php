<?php

use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>'$2y$10$UJ29wImc9ZA6B9bulXMSbO05TFoJz4odWSKK2nsX4oQbiCaPEl15y',
            'type'  => 'admin',
            'photo' => '1568152028.jpeg'
        ]);

        DB::table('users')->insert([
            'name' => 'Sajjad Hossain',
            'email' => 'sajjad@gmail.com',
            'password' =>'$2y$10$WvayfDCXUlFJX0GAKin1uOX3z1KLX1mqDcQyVi9Kt1YtooQdyroZG',
            'type' => 'author'
        ]);

        DB::table('users')->insert([
            'name' => 'ratan',
            'email' => 'ratan@gmail.com',
            'password' =>'$2y$10$vTrsTzAW9oSPOcFhMGRMVerG05noSazcuFn5KPf5t8cZb0kushF1C',
            'type' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'mostafiz',
            'email' => 'mostafiz@me.com',
            'password' =>'$2y$10$cQrnR50xocrX0oDgvzDaKeztth2y2svfxx5XeJtRtadSixoH2PpcC',
            'type' => 'user'
        ]);
    }
}
