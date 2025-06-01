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
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            // ...tambahkan validasi field lain sesuai kebutuhan...
        ]);
        Laptop::create($data);
        return redirect()->route('admin')->with('success', 'Laptop berhasil ditambahkan');
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
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            // ...tambahkan validasi field lain sesuai kebutuhan...
        ]);
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