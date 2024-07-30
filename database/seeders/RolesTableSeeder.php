<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['role_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'manager', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'guest', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
