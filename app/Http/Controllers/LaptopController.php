<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::paginate(10);
        return view('laptop.index', compact('laptops'));
    }

    public function create()
    {
        return view('laptop.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'nullable|string',
            'weight' => 'nullable|integer',
            'thickness' => 'nullable|integer',
            'screen_size' => 'nullable|integer',
            'screen_width' => 'nullable|integer',
            'screen_height' => 'nullable|integer',
            'resolution' => 'nullable|string',
            'pixel_density' => 'nullable|integer',
            'display_type' => 'nullable|string',
            'brightness' => 'nullable|integer',
            'refresh_rate' => 'nullable|integer',
            'cpu' => 'nullable|string',
            'cpu_speed' => 'nullable|integer',
            'cpu_thread' => 'nullable|integer',
            'gpu' => 'nullable|string',
            'ram' => 'nullable|integer',
            'ram_speed' => 'nullable|integer',
            'vram' => 'nullable|integer',
            'storage_type' => 'nullable|string',
            'internal_storage' => 'nullable|integer',
            'cpu_benchmark' => 'nullable|integer',
            'cpu_benchmark_multithread' => 'nullable|integer',
            'gpu_benchmark' => 'nullable|integer',
            'battery_size' => 'nullable|integer',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = 'images/' . $request->file('image')->store('laptops', 'public');
        }

        Laptop::create($data);
        return redirect()->route('user')->with('success', 'Laptop berhasil ditambahkan');
    }

    public function edit($id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('laptop.edit', compact('laptop'));
    }

    public function update(Request $request, $id)
    {
        $laptop = Laptop::findOrFail($id);
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'type' => 'nullable|string',
            'weight' => 'nullable|integer',
            'thickness' => 'nullable|integer',
            'screen_size' => 'nullable|integer',
            'screen_width' => 'nullable|integer',
            'screen_height' => 'nullable|integer',
            'resolution' => 'nullable|string',
            'pixel_density' => 'nullable|integer',
            'display_type' => 'nullable|string',
            'brightness' => 'nullable|integer',
            'refresh_rate' => 'nullable|integer',
            'cpu' => 'nullable|string',
            'cpu_speed' => 'nullable|integer',
            'cpu_thread' => 'nullable|integer',
            'gpu' => 'nullable|string',
            'ram' => 'nullable|integer',
            'ram_speed' => 'nullable|integer',
            'vram' => 'nullable|integer',
            'storage_type' => 'nullable|string',
            'internal_storage' => 'nullable|integer',
            'cpu_benchmark' => 'nullable|integer',
            'cpu_benchmark_multithread' => 'nullable|integer',
            'gpu_benchmark' => 'nullable|integer',
            'battery_size' => 'nullable|integer',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = 'images/' . $request->file('image')->store('laptops', 'public');
        } else {
            unset($data['image']);
        }

        $laptop->update($data);
        return redirect()->route('user')->with('success', 'Laptop berhasil diupdate');
    }

    public function destroy($id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->delete();
        return redirect()->route('user')->with('success', 'Laptop berhasil dihapus');
    }

    public function show($id)
    {
        $laptop = \App\Models\Laptop::findOrFail($id);
        return view('laptop.show', compact('laptop'));
    }
}
