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
                    'internal_storage' => 0.05, // benefit
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
                    'internal_storage' => 0.15, // benefit
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
                $max[$key] = $allLaptops->map(function ($l) {
                    return (strtolower($l->display_type) == 'ips' || strtolower($l->display_type) == 'oled') ? 2 : 1;
                })->max();
                $min[$key] = $allLaptops->map(function ($l) {
                    return (strtolower($l->display_type) == 'ips' || strtolower($l->display_type) == 'oled') ? 2 : 1;
                })->min();
            } else {
                $max[$key] = $allLaptops->max($key);
                $min[$key] = $allLaptops->min($key);
            }
        }

        // Hitung skor SAW dan score 1-100 untuk chart
        foreach ($allLaptops as $laptop) {
            $score = 0;
            // Score 1-100 untuk chart
            $chart_scores = [];
            // List kriteria yang ingin ditampilkan di chart
            $chart_keys = [
                'cpu_benchmark', 'gpu_benchmark', 'battery_size', 'ram',
                'refresh_rate', 'internal_storage', 'weight', 'brightness'
            ];
            foreach ($weights as $key => $w) {
                // Untuk display_type, konversi ke angka
                if ($key === 'display_type') {
                    $value = (strtolower($laptop->display_type) == 'ips' || strtolower($laptop->display_type) == 'oled') ? 2 : 1;
                } elseif ($key === 'resolution') {
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

                // Hitung score 1-100 untuk chart (hanya untuk kriteria chart_keys)
                if (in_array($key, $chart_keys)) {
                    if ($criteria[$key] == 'benefit') {
                        $chart_scores[$key] = (is_numeric($max[$key]) && $max[$key] > 0) ? round($value / $max[$key] * 100) : 0;
                    } else { // cost (semakin kecil semakin baik)
                        $chart_scores[$key] = ($value > 0 && is_numeric($min[$key]) && $min[$key] > 0) ? round($min[$key] / $value * 100) : 0;
                    }
                }
            }
            $laptop->saw_score = $score;
            $laptop->chart_scores = $chart_scores; // array: key => score 1-100
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

        if (Auth::check() && Auth::user()->role === 'admin') {
            $laptops = \App\Models\Laptop::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.index', compact('laptops', 'category'));
        }
        return view('user.index', compact('laptops', 'category'));
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

    public function show($id)
    {
        $laptop = \App\Models\Laptop::findOrFail($id);

        // Hitung chart_scores untuk 1 laptop (agar chart tidak 0)
        $allLaptops = \App\Models\Laptop::all();
        $chart_keys = [
            'cpu_benchmark', 'gpu_benchmark', 'battery_size', 'ram',
            'refresh_rate', 'internal_storage', 'weight', 'brightness'
        ];
        $max = [];
        $min = [];
        foreach ($chart_keys as $key) {
            $max[$key] = $allLaptops->max($key);
            $min[$key] = $allLaptops->min($key);
        }
        $criteria = [
            'cpu_benchmark' => 'benefit',
            'gpu_benchmark' => 'benefit',
            'battery_size' => 'benefit',
            'ram' => 'benefit',
            'refresh_rate' => 'benefit',
            'internal_storage' => 'benefit',
            'weight' => 'cost',
            'brightness' => 'benefit',
        ];
        $chart_scores = [];
        foreach ($chart_keys as $key) {
            $value = is_numeric($laptop->$key) ? $laptop->$key : 0;
            if ($criteria[$key] == 'benefit') {
                $chart_scores[$key] = (is_numeric($max[$key]) && $max[$key] > 0) ? round($value / $max[$key] * 100) : 0;
            } else { // cost
                $chart_scores[$key] = ($value > 0 && is_numeric($min[$key]) && $min[$key] > 0) ? round($min[$key] / $value * 100) : 0;
            }
        }
        $laptop->chart_scores = $chart_scores;

        return view('laptop.show', compact('laptop'));
    }

    public function addToCompare(Request $request)
    {
        $id = $request->input('laptop_id');
        $compare = session('compare_laptops', []);
        if (!in_array($id, $compare)) {
            $compare[] = $id;
        }
        session(['compare_laptops' => $compare]);
        return back()->with('success', 'Laptop ditambahkan ke daftar banding.');
    }

    public function removeFromCompare(Request $request)
    {
        $id = $request->input('laptop_id');
        $compare = session('compare_laptops', []);
        $compare = array_diff($compare, [$id]);
        session(['compare_laptops' => $compare]);
        return back()->with('success', 'Laptop dihapus dari daftar banding.');
    }

    public function compare()
    {
        $laptops = Laptop::orderBy('name')->get();
        $compareIds = session('compare_laptops', []);
        $compareLaptops = Laptop::whereIn('id', $compareIds)->get();
        return view('laptop.compare', compact('laptops', 'compareLaptops', 'compareIds'));
    }

    public function compareShow(Request $request)
    {
        // Hanya tampilkan bandingkan, tidak perlu update session
        $compareIds = session('compare_laptops', []);
        $compareLaptops = Laptop::whereIn('id', $compareIds)->get();
        $laptops = Laptop::orderBy('name')->get();
        return view('laptop.compare', compact('laptops', 'compareLaptops', 'compareIds'));
    }

    public function comparePost(Request $request)
    {
        $ids = $request->input('laptops', []);
        return redirect()->route('laptop.compare', ['laptops' => $ids]);
    }

    public function resetCompare()
    {
        session()->forget('compare_laptops');
        return back()->with('success', 'Daftar bandingkan telah direset.');
    }
}
