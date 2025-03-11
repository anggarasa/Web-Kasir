<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SpatieSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProductSeeder::class);

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        $superAdmin->assignRole('superAdmin');
    }
}
