<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $query = \App\Models\Laptop::query();

        if (request()->has('q') && request('q') !== null) {
            $q = request('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('brand', 'like', "%$q%");
            });
        }

        // Filter rentang harga
        if (request()->filled('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }
        if (request()->filled('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        // Sorting (tanpa price)
        $sort = request('sort');
        if ($sort == 'brand_asc') {
            $query->orderBy('brand', 'asc');
        } elseif ($sort == 'brand_desc') {
            $query->orderBy('brand', 'desc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        }

        // Ambil kategori dari request, default 'gaming'
        $category = request('category', 'gaming');

        // Definisikan bobot dan cost/benefit untuk tiap kategori
        $sawConfig = [
            'gaming' => [
                'weights' => [
                    'price' => 0.15,           // cost
                    'ram' => 0.15,             // benefit
                    'cpu_benchmark' => 0.2,    // benefit
                    'gpu_benchmark' => 0.2,    // benefit
                    'battery_size' => 0.1,     // benefit
                    'screen_size' => 0.05,     // benefit
                    'refresh_rate' => 0.05,    // benefit
                    'internal_storage' => 0.05,// benefit
                    'weight' => 0.05,          // cost
                ],
                'criteria' => [
                    'price' => 'cost',
                    'ram' => 'benefit',
                    'cpu_benchmark' => 'benefit',
                    'gpu_benchmark' => 'benefit',
                    'battery_size' => 'benefit',
                    'screen_size' => 'benefit',
                    'refresh_rate' => 'benefit',
                    'internal_storage' => 'benefit',
                    'weight' => 'cost',
                ]
            ],
            'desain' => [
                'weights' => [
                    'price' => 0.15,           // cost
                    'ram' => 0.15,             // benefit
                    'cpu_benchmark' => 0.15,   // benefit
                    'gpu_benchmark' => 0.1,    // benefit
                    'screen_size' => 0.1,      // benefit
                    'display_type' => 0.1,     // benefit (IPS/OLED lebih baik)
                    'resolution' => 0.1,       // benefit
                    'brightness' => 0.05,      // benefit
                    'weight' => 0.1,           // cost
                ],
                'criteria' => [
                    'price' => 'cost',
                    'ram' => 'benefit',
                    'cpu_benchmark' => 'benefit',
                    'gpu_benchmark' => 'benefit',
                    'screen_size' => 'benefit',
                    'display_type' => 'benefit',
                    'resolution' => 'benefit',
                    'brightness' => 'benefit',
                    'weight' => 'cost',
                ]
            ],
            'school' => [
                'weights' => [
                    'price' => 0.25,           // cost
                    'ram' => 0.15,             // benefit
                    'battery_size' => 0.15,    // benefit
                    'weight' => 0.15,          // cost (lebih ringan lebih baik)
                    'screen_size' => 0.1,      // benefit
                    'cpu_benchmark' => 0.1,    // benefit
                    'internal_storage' => 0.1, // benefit
                ],
                'criteria' => [
                    'price' => 'cost',
                    'ram' => 'benefit',
                    'battery_size' => 'benefit',
                    'weight' => 'cost',
                    'screen_size' => 'benefit',
                    'cpu_benchmark' => 'benefit',
                    'internal_storage' => 'benefit',
                ]
            ],
            'office' => [
                'weights' => [
                    'price' => 0.2,            // cost
                    'ram' => 0.15,             // benefit
                    'cpu_benchmark' => 0.15,   // benefit
                    'battery_size' => 0.15,    // benefit
                    'weight' => 0.1,           // cost
                    'screen_size' => 0.1,      // benefit
                    'internal_storage' => 0.15,// benefit
                    'thickness' => 0.05,       // cost
                ],
                'criteria' => [
                    'price' => 'cost',
                    'ram' => 'benefit',
                    'cpu_benchmark' => 'benefit',
                    'battery_size' => 'benefit',
                    'weight' => 'cost',
                    'screen_size' => 'benefit',
                    'internal_storage' => 'benefit',
                    'thickness' => 'cost',
                ]
            ],
        ];

        // Pilih config sesuai kategori, default ke gaming jika tidak ada
        $weights = $sawConfig[$category]['weights'] ?? $sawConfig['gaming']['weights'];
        $criteria = $sawConfig[$category]['criteria'] ?? $sawConfig['gaming']['criteria'];

        // Ambil semua data untuk proses SAW
        $allLaptops = $query->get();

        // Normalisasi
        $max = [];
        $min = [];
        foreach ($weights as $key => $w) {
            // Untuk display_type, konversi ke angka (IPS/OLED = 2, lain = 1)
            if ($key === 'display_type') {
                $max[$key] = $allLaptops->map(function($l) {
                    return (strtolower($l->display_type) == 'ips' || strtolower($l->display_type) == 'oled') ? 2 : 1;
                })->max();
                $min[$key] = $allLaptops->map(function($l) {
                    return (strtolower($l->display_type) == 'ips' || strtolower($l->display_type) == 'oled') ? 2 : 1;
                })->min();
            } else {
                $max[$key] = $allLaptops->max($key);
                $min[$key] = $allLaptops->min($key);
            }
        }

        // Hitung skor SAW
        foreach ($allLaptops as $laptop) {
            $score = 0;
            foreach ($weights as $key => $w) {
                // Untuk display_type, konversi ke angka
                if ($key === 'display_type') {
                    $value = (strtolower($laptop->display_type) == 'ips' || strtolower($laptop->display_type) == 'oled') ? 2 : 1;
                } elseif ($key === 'resolution') {
                    // Ambil angka terbesar dari resolusi, misal "1920x1080" -> 1920
                    $value = 0;
                    if (!empty($laptop->resolution) && preg_match('/(\d+)/', $laptop->resolution, $matches)) {
                        $value = (int)$matches[1];
                    }
                } else {
                    $value = is_numeric($laptop->$key) ? $laptop->$key : 0;
                }
                $w = is_numeric($w) ? $w : 0; // Pastikan bobot numerik
                if ($criteria[$key] == 'benefit') {
                    $norm = (is_numeric($max[$key]) && $max[$key] > 0) ? $value / $max[$key] : 0;
                } else { // cost
                    $norm = ($value > 0 && is_numeric($min[$key]) && $min[$key] > 0) ? $min[$key] / $value : 0;
                }
                $score += $w * $norm;
            }
            $laptop->saw_score = $score;
        }

        // Urutkan berdasarkan skor SAW tertinggi
        $sorted = $allLaptops->sortByDesc('saw_score')->values();

        // Pagination manual (karena sudah diurutkan)
        $perPage = 10;
        $page = request('page', 1);
        $laptops = $sorted->slice(($page - 1) * $perPage, $perPage)->all();
        $laptops = new \Illuminate\Pagination\LengthAwarePaginator(
            $laptops,
            $sorted->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // Jika user adalah admin, tampilkan halaman admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.index', compact('laptops'));
        }

        return view('user.index', compact('laptops', 'category'));
    }

    public function show($id)
    {
        $laptop = \App\Models\Laptop::findOrFail($id);
        return view('laptop.show', compact('laptop'));
    }

    public function addWishlist($laptopId)
    {
        $user = Auth::user();
        $user->wishlists()->syncWithoutDetaching([$laptopId]);
        return back()->with('success', 'Laptop ditambahkan ke wishlist!');
    }

    public function removeWishlist($laptopId)
    {
        $user = Auth::user();
        $user->wishlists()->detach($laptopId);
        return back()->with('success', 'Laptop dihapus dari wishlist!');
    }

    public function wishlist()
    {
        $user = Auth::user();
        $laptops = $user->wishlists()->paginate(10);
        return view('user.wishlist', compact('laptops'));
    }
}
