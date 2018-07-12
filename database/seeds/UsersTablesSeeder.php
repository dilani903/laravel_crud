<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'name' => 'Supipi Weerawardene',
			'email' => 'user',
			'password' => Hash::make('1123dil'),
			'admin_status' => 0,
			'remember_token' => str_random(10),
		]);
    }
}
