<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'brand',
        'price',
        'type',
        'weight',
        'thickness',
        'screen_size',
        'screen_width',
        'screen_height',
        'resolution',
        'pixel_density',
        'display_type',
        'brightness',
        'refresh_rate',
        'cpu',
        'cpu_speed',
        'cpu_thread',
        'gpu',
        'ram',
        'ram_speed',
        'vram',
        'storage_type',
        'internal_storage',
        'cpu_benchmark',
        'cpu_benchmark_multithread',
        'gpu_benchmark',
        'battery_size',
    ];
}
