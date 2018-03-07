<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Leopaz',
            'email' => 'demo@demo.com',
            'password' => app('hash')->make('demo'),
            'remember_token' => str_random(10),
        ]);
    }
}
