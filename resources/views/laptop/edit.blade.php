@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Laptop</h2>
        <form method="POST" action="{{ route('laptop.update', $laptop->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1">Gambar Saat Ini</label>
                @if ($laptop->image)
                    <img src="{{ asset($laptop->image) }}" alt="Gambar Laptop" class="mb-2 w-32 h-24 object-cover rounded"
                        style="max-width:60px;max-height:60px;">
                @else
                    <span class="text-gray-400 italic">Belum ada gambar</span>
                @endif
            </div>
            <div class="mb-4">
                <label class="block mb-1">Ubah Gambar</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2" accept="image/*">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</small>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ $laptop->name }}"
                    required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Brand</label>
                <input type="text" name="brand" class="w-full border rounded px-3 py-2" value="{{ $laptop->brand }}"
                    required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Harga</label>
                <input type="number" name="price" class="w-full border rounded px-3 py-2" value="{{ $laptop->price }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tipe</label>
                <input type="text" name="type" class="w-full border rounded px-3 py-2" value="{{ $laptop->type }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Berat</label>
                <input type="number" name="weight" class="w-full border rounded px-3 py-2" value="{{ $laptop->weight }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Ketebalan</label>
                <input type="number" name="thickness" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->thickness }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Ukuran Layar</label>
                <input type="number" name="screen_size" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->screen_size }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Lebar Layar</label>
                <input type="number" name="screen_width" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->screen_width }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tinggi Layar</label>
                <input type="number" name="screen_height" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->screen_height }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Resolusi</label>
                <input type="text" name="resolution" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->resolution }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kerapatan Piksel</label>
                <input type="number" name="pixel_density" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->pixel_density }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tipe Layar</label>
                <input type="text" name="display_type" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->display_type }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kecerahan</label>
                <input type="number" name="brightness" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->brightness }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Refresh Rate</label>
                <input type="number" name="refresh_rate" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->refresh_rate }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">CPU</label>
                <input type="text" name="cpu" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->cpu }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kecepatan CPU</label>
                <input type="number" name="cpu_speed" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->cpu_speed }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Thread CPU</label>
                <input type="number" name="cpu_thread" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->cpu_thread }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">GPU</label>
                <input type="text" name="gpu" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->gpu }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">RAM</label>
                <input type="number" name="ram" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->ram }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kecepatan RAM</label>
                <input type="number" name="ram_speed" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->ram_speed }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">VRAM</label>
                <input type="number" name="vram" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->vram }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tipe Penyimpanan</label>
                <input type="text" name="storage_type" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->storage_type }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Penyimpanan Internal</label>
                <input type="number" name="internal_storage" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->internal_storage }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Benchmark CPU</label>
                <input type="number" name="cpu_benchmark" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->cpu_benchmark }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Benchmark CPU Multithread</label>
                <input type="number" name="cpu_benchmark_multithread" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->cpu_benchmark_multithread }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Benchmark GPU</label>
                <input type="number" name="gpu_benchmark" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->gpu_benchmark }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Kapasitas Baterai</label>
                <input type="number" name="battery_size" class="w-full border rounded px-3 py-2"
                    value="{{ $laptop->battery_size }}">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('user') }}" class="ml-2 text-gray-600">Batal</a>
        </form>
    </div>
@endsection
