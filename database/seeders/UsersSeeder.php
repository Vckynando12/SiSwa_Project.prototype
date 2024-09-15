<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1, //admin
        ]);
        User::create([
            'name' => 'SDM',
            'email' => 'sdm@gmail.com',
            'password' => Hash::make('sdm123'),
            'role_id' => 2, //admin
        ]);
        User::create([
            'name' => 'digital marketing',
            'email' => 'digitalmarketing@gmail.com',
            'password' => Hash::make('digitalmarketing123'),
            'role_id' => 3, //admin
        ]);
    }
}
