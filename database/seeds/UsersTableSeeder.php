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
            'name' => 'root',
            'username' => 'root',
            'emails' => Str::random(10).'@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
