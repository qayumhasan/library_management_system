<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            [
                'name' => 'Mr. Super Admin',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'created_at' => now(),
            ],
            [
                'name' => 'Mr. Admin',
                'email' => 'admin@admin.com',
                'password' => $password,
                'created_at' => now(),
            ],
            [
                'name' => 'Mr. Author',
                'email' => 'author@author.com',
                'password' => $password,
                'created_at' => now(),
            ],
            [
                'name' => 'Mr. Librarian',
                'email' => 'librarian@librarian.com',
                'password' => $password,
                'created_at' => now(),
            ],
            [
                'name' => 'Mr. User',
                'email' => 'user@user.com',
                'password' => $password,
                'created_at' => now(),
            ],

        ];

        DB::table('users')->insert($users);
    }
}
