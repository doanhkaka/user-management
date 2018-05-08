<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' 	=> 'User '.str_random(10),
            'age' 	=> rand(1, 100),
            'email' => strtolower(str_random(10).'@email.com'),
            'password' => bcrypt('12345678'), //TODO: Need to change after test
            'address' => str_random(15),
            'tel'   => '+84'.rand(10000000, 999999999),
        ]);
    }
}
