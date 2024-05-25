<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'author-all',
            'author-create',
            'author-edit',
            'author-delete',

            'book-all',
            'book-create',
            'book-edit',
            'book-delete',

            'member-all',
            'member-create',
            'member-edit',
            'member-delete',

            'borrowd-book-all',
            'borrowd-book-create',
            'borrowd-book-edit',
            'borrowd-book-delete',

            'user-all',
            'user-create',
            'user-edit',
            'user-delete',

            'role-all',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        $permissions = array_map(function ($name) {
            return [
                'name' => $name,
                'created_at' => now(),
            ];
        }, $permissions);

        DB::table('permissions')->insert($permissions);
    }
}
