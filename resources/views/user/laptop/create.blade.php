@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Laptop</h2>
    <form method="POST" action="{{ route('laptop.store') }}">
        @csrf
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium mb-1">Gambar</label>
            <input type="text" name="image" id="image" value="{{ old('image') }}"
                class="border rounded px-3 py-2 w-full @error('image') border-red-500 @enderror"
                placeholder="URL Gambar">
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-1">Nama Laptop</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="border rounded px-3 py-2 w-full @error('name') border-red-500 @enderror"
                placeholder="Nama Laptop">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium mb-1">Brand</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                class="border rounded px-3 py-2 w-full @error('brand') border-red-500 @enderror"
                placeholder="Brand Laptop">
            @error('brand')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium mb-1">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                class="border rounded px-3 py-2 w-full @error('price') border-red-500 @enderror"
                placeholder="Harga Laptop" min="0">
            @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Desain --}}
        <fieldset class="mb-4">
            <legend class="text-sm font-medium mb-2">Desain</legend>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="type" class="block text-sm font-medium mb-1">Tipe</label>
                    <input type="text" name="type" id="type" value="{{ old('type') }}"
                        class="border rounded px-3 py-2 w-full @error('type') border-red-500 @enderror"
                        placeholder="Tipe Laptop">
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="weight" class="block text-sm font-medium mb-1">Berat (gram)</label>
                    <input type="number" name="weight" id="weight" value="{{ old('weight') }}"
                        class="border rounded px-3 py-2 w-full @error('weight') border-red-500 @enderror"
                        placeholder="Berat Laptop" min="0">
                    @error('weight')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="thickness" class="block text-sm font-medium mb-1">Ketebalan (mm)</label>
                    <input type="number" name="thickness" id="thickness" value="{{ old('thickness') }}"
                        class="border rounded px-3 py-2 w-full @error('thickness') border-red-500 @enderror"
                        placeholder="Ketebalan Laptop" min="0">
                    @error('thickness')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        {{-- Display --}}
        <fieldset class="mb-4">
            <legend class="text-sm font-medium mb-2">Display</legend>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="screen_size" class="block text-sm font-medium mb-1">Ukuran Layar (inchi)</label>
                    <input type="number" name="screen_size" id="screen_size" value="{{ old('screen_size') }}"
                        class="border rounded px-3 py-2 w-full @error('screen_size') border-red-500 @enderror"
                        placeholder="Ukuran Layar">
                    @error('screen_size')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="screen_width" class="block text-sm font-medium mb-1">Lebar Layar (mm)</label>
                    <input type="number" name="screen_width" id="screen_width" value="{{ old('screen_width') }}"
                        class="border rounded px-3 py-2 w-full @error('screen_width') border-red-500 @enderror"
                        placeholder="Lebar Layar">
                    @error('screen_width')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="screen_height" class="block text-sm font-medium mb-1">Tinggi Layar (mm)</label>
                    <input type="number" name="screen_height" id="screen_height" value="{{ old('screen_height') }}"
                        class="border rounded px-3 py-2 w-full @error('screen_height') border-red-500 @enderror"
                        placeholder="Tinggi Layar">
                    @error('screen_height')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="resolution" class="block text-sm font-medium mb-1">Resolusi</label>
                    <input type="text" name="resolution" id="resolution" value="{{ old('resolution') }}"
                        class="border rounded px-3 py-2 w-full @error('resolution') border-red-500 @enderror"
                        placeholder="Resolusi Layar">
                    @error('resolution')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="pixel_density" class="block text-sm font-medium mb-1">Kerapatan Piksel (PPI)</label>
                    <input type="number" name="pixel_density" id="pixel_density" value="{{ old('pixel_density') }}"
                        class="border rounded px-3 py-2 w-full @error('pixel_density') border-red-500 @enderror"
                        placeholder="Kerapatan Piksel">
                    @error('pixel_density')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="display_type" class="block text-sm font-medium mb-1">Tipe Layar</label>
                    <input type="text" name="display_type" id="display_type" value="{{ old('display_type') }}"
                        class="border rounded px-3 py-2 w-full @error('display_type') border-red-500 @enderror"
                        placeholder="Tipe Layar">
                    @error('display_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="brightness" class="block text-sm font-medium mb-1">Kecerahan (nits)</label>
                    <input type="number" name="brightness" id="brightness" value="{{ old('brightness') }}"
                        class="border rounded px-3 py-2 w-full @error('brightness') border-red-500 @enderror"
                        placeholder="Kecerahan Layar" min="0">
                    @error('brightness')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="refresh_rate" class="block text-sm font-medium mb-1">Refresh Rate (Hz)</label>
                    <input type="number" name="refresh_rate" id="refresh_rate" value="{{ old('refresh_rate') }}"
                        class="border rounded px-3 py-2 w-full @error('refresh_rate') border-red-500 @enderror"
                        placeholder="Refresh Rate" min="0">
                    @error('refresh_rate')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        {{-- Performa --}}
        <fieldset class="mb-4">
            <legend class="text-sm font-medium mb-2">Performa</legend>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="cpu" class="block text-sm font-medium mb-1">CPU</label>
                    <input type="text" name="cpu" id="cpu" value="{{ old('cpu') }}"
                        class="border rounded px-3 py-2 w-full @error('cpu') border-red-500 @enderror"
                        placeholder="Nama CPU">
                    @error('cpu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="cpu_speed" class="block text-sm font-medium mb-1">Kecepatan CPU (GHz)</label>
                    <input type="number" name="cpu_speed" id="cpu_speed" value="{{ old('cpu_speed') }}"
                        class="border rounded px-3 py-2 w-full @error('cpu_speed') border-red-500 @enderror"
                        placeholder="Kecepatan CPU" step="0.1" min="0">
                    @error('cpu_speed')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="cpu_thread" class="block text-sm font-medium mb-1">Thread CPU</label>
                    <input type="number" name="cpu_thread" id="cpu_thread" value="{{ old('cpu_thread') }}"
                        class="border rounded px-3 py-2 w-full @error('cpu_thread') border-red-500 @enderror"
                        placeholder="Jumlah Thread CPU" min="0">
                    @error('cpu_thread')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gpu" class="block text-sm font-medium mb-1">GPU</label>
                    <input type="text" name="gpu" id="gpu" value="{{ old('gpu') }}"
                        class="border rounded px-3 py-2 w-full @error('gpu') border-red-500 @enderror"
                        placeholder="Nama GPU">
                    @error('gpu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ram" class="block text-sm font-medium mb-1">RAM (GB)</label>
                    <input type="number" name="ram" id="ram" value="{{ old('ram') }}"
                        class="border rounded px-3 py-2 w-full @error('ram') border-red-500 @enderror"
                        placeholder="Kapasitas RAM" min="0">
                    @error('ram')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ram_speed" class="block text-sm font-medium mb-1">Kecepatan RAM (MHz)</label>
                    <input type="number" name="ram_speed" id="ram_speed" value="{{ old('ram_speed') }}"
                        class="border rounded px-3 py-2 w-full @error('ram_speed') border-red-500 @enderror"
                        placeholder="Kecepatan RAM" min="0">
                    @error('ram_speed')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="vram" class="block text-sm font-medium mb-1">VRAM (GB)</label>
                    <input type="number" name="vram" id="vram" value="{{ old('vram') }}"
                        class="border rounded px-3 py-2 w-full @error('vram') border-red-500 @enderror"
                        placeholder="Kapasitas VRAM" min="0">
                    @error('vram')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="storage_type" class="block text-sm font-medium mb-1">Tipe Penyimpanan</label>
                    <input type="text" name="storage_type" id="storage_type" value="{{ old('storage_type') }}"
                        class="border rounded px-3 py-2 w-full @error('storage_type') border-red-500 @enderror"
                        placeholder="Tipe Penyimpanan">
                    @error('storage_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="internal_storage" class="block text-sm font-medium mb-1">Penyimpanan Internal (GB)</label>
                    <input type="number" name="internal_storage" id="internal_storage" value="{{ old('internal_storage') }}"
                        class="border rounded px-3 py-2 w-full @error('internal_storage') border-red-500 @enderror"
                        placeholder="Penyimpanan Internal" min="0">
                    @error('internal_storage')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        {{-- Benchmark --}}
        <fieldset class="mb-4">
            <legend class="text-sm font-medium mb-2">Benchmark</legend>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="cpu_benchmark" class="block text-sm font-medium mb-1">Benchmark CPU</label>
                    <input type="number" name="cpu_benchmark" id="cpu_benchmark" value="{{ old('cpu_benchmark') }}"
                        class="border rounded px-3 py-2 w-full @error('cpu_benchmark') border-red-500 @enderror"
                        placeholder="Benchmark CPU" min="0">
                    @error('cpu_benchmark')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="cpu_benchmark_multithread" class="block text-sm font-medium mb-1">Benchmark CPU Multithread</label>
                    <input type="number" name="cpu_benchmark_multithread" id="cpu_benchmark_multithread" value="{{ old('cpu_benchmark_multithread') }}"
                        class="border rounded px-3 py-2 w-full @error('cpu_benchmark_multithread') border-red-500 @enderror"
                        placeholder="Benchmark CPU Multithread" min="0">
                    @error('cpu_benchmark_multithread')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gpu_benchmark" class="block text-sm font-medium mb-1">Benchmark GPU</label>
                    <input type="number" name="gpu_benchmark" id="gpu_benchmark" value="{{ old('gpu_benchmark') }}"
                        class="border rounded px-3 py-2 w-full @error('gpu_benchmark') border-red-500 @enderror"
                        placeholder="Benchmark GPU" min="0">
                    @error('gpu_benchmark')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>

        {{-- Baterai --}}
        <div class="mb-4">
            <label for="battery_size" class="block text-sm font-medium mb-1">Kapasitas Baterai (mAh)</label>
            <input type="number" name="battery_size" id="battery_size" value="{{ old('battery_size') }}"
                class="border rounded px-3 py-2 w-full @error('battery_size') border-red-500 @enderror"
                placeholder="Kapasitas Baterai" min="0">
            @error('battery_size')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('user') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection