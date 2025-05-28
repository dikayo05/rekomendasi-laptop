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

        // Ambil semua data untuk proses SAW
        $allLaptops = $query->get();

        // Kriteria dan bobot (bisa Anda sesuaikan)
        $weights = [
            'price' => 0.3,           // cost
            'ram' => 0.2,             // benefit
            'cpu_benchmark' => 0.3,   // benefit
            'battery_size' => 0.2,    // benefit
        ];
        $criteria = [
            'price' => 'cost',
            'ram' => 'benefit',
            'cpu_benchmark' => 'benefit',
            'battery_size' => 'benefit',
        ];

        // Normalisasi
        $max = [];
        $min = [];
        foreach ($weights as $key => $w) {
            $max[$key] = $allLaptops->max($key);
            $min[$key] = $allLaptops->min($key);
        }

        // Hitung skor SAW
        foreach ($allLaptops as $laptop) {
            $score = 0;
            foreach ($weights as $key => $w) {
                $value = $laptop->$key ?? 0;
                if ($criteria[$key] == 'benefit') {
                    $norm = $max[$key] > 0 ? $value / $max[$key] : 0;
                } else { // cost
                    $norm = $value > 0 ? $min[$key] / $value : 0;
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

        return view('user.index', compact('laptops'));
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
