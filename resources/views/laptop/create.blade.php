{{-- Halaman form tambah laptop --}}
@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Laptop</h2>
    <form method="POST" action="{{ route('laptop.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Brand</label>
            <input type="text" name="brand" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2" accept="image/*">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tipe</label>
            <input type="text" name="type" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Berat (gram)</label>
            <input type="number" name="weight" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Ketebalan (mm)</label>
            <input type="number" name="thickness" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Ukuran Layar (inch)</label>
            <input type="number" name="screen_size" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Lebar Layar</label>
            <input type="number" name="screen_width" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tinggi Layar</label>
            <input type="number" name="screen_height" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Resolusi</label>
            <input type="text" name="resolution" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Pixel Density</label>
            <input type="number" name="pixel_density" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tipe Layar</label>
            <input type="text" name="display_type" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Brightness</label>
            <input type="number" name="brightness" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Refresh Rate</label>
            <input type="number" name="refresh_rate" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">CPU</label>
            <input type="text" name="cpu" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">CPU Speed</label>
            <input type="number" name="cpu_speed" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">CPU Thread</label>
            <input type="number" name="cpu_thread" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">GPU</label>
            <input type="text" name="gpu" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">RAM (GB)</label>
            <input type="number" name="ram" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">RAM Speed</label>
            <input type="number" name="ram_speed" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">VRAM</label>
            <input type="number" name="vram" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Tipe Penyimpanan</label>
            <input type="text" name="storage_type" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Penyimpanan Internal (GB)</label>
            <input type="number" name="internal_storage" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">CPU Benchmark</label>
            <input type="number" name="cpu_benchmark" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">CPU Benchmark Multithread</label>
            <input type="number" name="cpu_benchmark_multithread" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">GPU Benchmark</label>
            <input type="number" name="gpu_benchmark" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kapasitas Baterai</label>
            <input type="number" name="battery_size" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('user') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection