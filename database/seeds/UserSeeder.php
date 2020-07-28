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
            'name' => 'admin@qq.com',
            'email' => 'admin@qq.com',
            'password' => bcrypt('admin@qq.com'),
        ]);
    }
}
