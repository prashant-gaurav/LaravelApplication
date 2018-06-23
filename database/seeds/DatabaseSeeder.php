<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {
            DB::table('users')->insert([
                'first_name' => str_random(6),
                'last_name' => str_random(5),
                'email' => str_random(12).'@mail.com',
                'password' => bcrypt('password'),
                'phone' => rand(9098987898, 9999999999),
                'profile_picture' =>str_random(5).'.png',
                'remember_token' =>str_random(40)
            ]);
        }
    }
}
