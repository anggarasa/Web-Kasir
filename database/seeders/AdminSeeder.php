<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            User::create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@gmail.com',
                'password' => Hash::make('admin123'),
            ])->assignRole('admin');
        }
    }
}
