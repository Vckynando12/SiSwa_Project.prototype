<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'permissions' => ''
        ]);
        Role::create([
            'name' => 'sdm',
            'permissions' => ''
        ]);
        Role::create([
            'name' => 'digitalmarketing',
            'permissions' => ''
        ]);
    }
}
