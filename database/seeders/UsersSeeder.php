<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'User1', 'email' => 'user1@test.com', 'password' => '$2y$10$7Dx2KyWrHAa9GtHHwOZXfu8/XjnpUiEc.LKzAEv8DeGaXmaq2c0oC', 'is_admin' => 1, 'updated_at' => now()],
            ['name' => 'User2', 'email' => 'user2@test.com', 'password' => '$2y$10$7Dx2KyWrHAa9GtHHwOZXfu8/XjnpUiEc.LKzAEv8DeGaXmaq2c0oC', 'is_admin' => 0, 'updated_at' => now()],
            ['name' => 'User3', 'email' => 'user3@test.com', 'password' => '$2y$10$7Dx2KyWrHAa9GtHHwOZXfu8/XjnpUiEc.LKzAEv8DeGaXmaq2c0oC', 'is_admin' => 0, 'updated_at' => now()]
        ]);
    }
}
