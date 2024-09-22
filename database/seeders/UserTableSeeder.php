<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create multiplos usuarios
        DB::table(('users'))->insert([
            [
            'username' => 'user1@mail.com',
            'password' => bcrypt('abc123456'),
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'username' => 'user2@mail.com',
            'password' => bcrypt('abc123456'),
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'username' => 'user3@mail.com',
            'password' => bcrypt('abc123456'),
            'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
