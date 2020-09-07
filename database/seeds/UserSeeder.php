<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'name' => 'terraadmin',
            'password' => bcrypt('Terra0755'),
            'role' => 'admin',
        ]);
    }
}
