{{-- Halaman form tambah laptop --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-900">Tambah Laptop</h2>
    <form method="POST" action="{{ route('laptop.store') }}" enctype="multipart/form-data" class="max-w-7xl mx-auto mt-10 bg-white p-6 rounded shadow">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input type="text" name="name" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
            <input type="text" name="brand" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
            <input type="number" name="price" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Berat (gram)</label>
            <input type="number" name="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Ketebalan (mm)</label>
            <input type="number" name="thickness" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Ukuran Layar (inch)</label>
            <input type="number" name="screen_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Lebar Layar</label>
            <input type="number" name="screen_width" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Tinggi Layar</label>
            <input type="number" name="screen_height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Resolusi</label>
            <input type="text" name="resolution" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Pixel Density</label>
            <input type="number" name="pixel_density" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Tipe Layar</label>
            <input type="text" name="display_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Brightness</label>
            <input type="number" name="brightness" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Refresh Rate</label>
            <input type="number" name="refresh_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">CPU</label>
            <input type="text" name="cpu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">CPU Speed</label>
            <input type="number" name="cpu_speed" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">CPU Thread</label>
            <input type="number" name="cpu_thread" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">GPU</label>
            <input type="text" name="gpu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">RAM (GB)</label>
            <input type="number" name="ram" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">RAM Speed</label>
            <input type="number" name="ram_speed" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">VRAM</label>
            <input type="number" name="vram" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Tipe Penyimpanan</label>
            <input type="text" name="storage_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Penyimpanan Internal (GB)</label>
            <input type="number" name="internal_storage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">CPU Benchmark</label>
            <input type="number" name="cpu_benchmark" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">CPU Benchmark Multithread</label>
            <input type="number" name="cpu_benchmark_multithread" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">GPU Benchmark</label>
            <input type="number" name="gpu_benchmark" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Kapasitas Baterai</label>
            <input type="number" name="battery_size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
        <a href="{{ route('user') }}" class="text-gray-600 text-sm">Batal</a>
    </div>
</form>
</div>

@endsection
