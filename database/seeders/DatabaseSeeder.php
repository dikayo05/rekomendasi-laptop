<?php

namespace Database\Seeders;

use App\Models\Laptop;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'atmin here',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'name' => 'alok here',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => bcrypt('user123'),
        ]);
        
        $this->call(LaptopSeeder::class);
    }
}
