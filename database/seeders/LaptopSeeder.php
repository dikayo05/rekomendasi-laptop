<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaptopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Asus', 'Acer', 'Lenovo', 'HP', 'Dell', 'MSI', 'Apple'];
        $displayTypes = ['IPS', 'OLED', 'TN', 'VA'];
        $storageTypes = ['SSD', 'HDD', 'SSD+HDD'];
        $cpus = ['Intel i5', 'Intel i7', 'AMD Ryzen 5', 'AMD Ryzen 7', 'Apple M1'];
        $gpus = ['Intel Iris Xe', 'NVIDIA RTX 3050', 'AMD Radeon Vega', 'Apple GPU', 'NVIDIA GTX 1650'];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('laptops')->insert([
                'image' => 'images/laptops/default.png',
                'name' => 'Laptop ' . Str::random(5) . " $i",
                'brand' => $brands[array_rand($brands)],
                'price' => rand(5000000, 35000000),

                // desain
                'weight' => rand(1000, 2500),
                'thickness' => rand(12, 30),

                // display
                'screen_size' => rand(13, 17),
                'screen_width' => rand(1920, 2560),
                'screen_height' => rand(1080, 1600),
                'resolution' => rand(1920, 2560) . 'x' . rand(1080, 1600),
                'pixel_density' => rand(140, 220),
                'display_type' => $displayTypes[array_rand($displayTypes)],
                'brightness' => rand(200, 500),
                'refresh_rate' => rand(60, 165),

                // performance
                'cpu' => $cpus[array_rand($cpus)],
                'cpu_speed' => rand(2000, 5000),
                'cpu_thread' => rand(4, 16),
                'gpu' => $gpus[array_rand($gpus)],
                'ram' => rand(4, 32),
                'ram_speed' => rand(2133, 4266),
                'vram' => rand(2, 8),
                'storage_type' => $storageTypes[array_rand($storageTypes)],
                'internal_storage' => rand(128, 2048),

                // benchmark
                'cpu_benchmark' => rand(5000, 25000),
                'cpu_benchmark_multithread' => rand(10000, 50000),
                'gpu_benchmark' => rand(2000, 20000),

                // battery
                'battery_size' => rand(3000, 9000),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
