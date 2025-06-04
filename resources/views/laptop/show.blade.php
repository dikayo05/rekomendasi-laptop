@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow rounded-lg p-6">
    <a href="{{ route('user', ['page' => request('page', 1)]) }}" class="text-blue-500 hover:underline mb-4 inline-block">&larr; Kembali ke daftar laptop</a>
    <div class="flex flex-col md:flex-row gap-6">
        @if(!empty($laptop->image))
            <img src="{{ asset($laptop->image) }}" alt="Gambar Laptop" class="w-full md:w-64 h-48 object-cover rounded mb-4 md:mb-0">
        @endif
        <div class="flex-1">
            <h2 class="text-2xl font-bold mb-2">{{ $laptop->name }}</h2>
            <p class="text-gray-600 mb-2">{{ $laptop->brand }}</p>
            <ul class="mb-4 text-gray-700 space-y-1">
                <li><b>Harga:</b> Rp{{ number_format($laptop->price, 0, ',', '.') }}</li>
                <li><b>Tipe:</b> {{ $laptop->type }}</li>
                <li><b>Berat:</b> {{ $laptop->weight }} g</li>
                <li><b>Ketebalan:</b> {{ $laptop->thickness }} mm</li>
                <li><b>Ukuran Layar:</b> {{ $laptop->screen_size }}</li>
                <li><b>Lebar Layar:</b> {{ $laptop->screen_width }}</li>
                <li><b>Tinggi Layar:</b> {{ $laptop->screen_height }}</li>
                <li><b>Resolusi:</b> {{ $laptop->resolution }}</li>
                <li><b>Kerapatan Piksel:</b> {{ $laptop->pixel_density }} ppi</li>
                <li><b>Tipe Layar:</b> {{ $laptop->display_type }}</li>
                <li><b>Kecerahan:</b> {{ $laptop->brightness }} nits</li>
                <li><b>Refresh Rate:</b> {{ $laptop->refresh_rate }} Hz</li>
                <li><b>CPU:</b> {{ $laptop->cpu }}</li>
                <li><b>Kecepatan CPU:</b> {{ $laptop->cpu_speed }} GHz</li>
                <li><b>Thread CPU:</b> {{ $laptop->cpu_thread }}</li>
                <li><b>GPU:</b> {{ $laptop->gpu }}</li>
                <li><b>RAM:</b> {{ $laptop->ram }} GB</li>
                <li><b>Kecepatan RAM:</b> {{ $laptop->ram_speed }} MHz</li>
                <li><b>VRAM:</b> {{ $laptop->vram }} GB</li>
                <li><b>Tipe Penyimpanan:</b> {{ $laptop->storage_type }}</li>
                <li><b>Penyimpanan Internal:</b> {{ $laptop->internal_storage }} GB</li>
                <li><b>Benchmark CPU:</b> {{ $laptop->cpu_benchmark }}</li>
                <li><b>Benchmark CPU Multithread:</b> {{ $laptop->cpu_benchmark_multithread }}</li>
                <li><b>Benchmark GPU:</b> {{ $laptop->gpu_benchmark }}</li>
                <li><b>Kapasitas Baterai:</b> {{ $laptop->battery_size }} Wh</li>
            </ul>
        </div>
    </div>
</div>
@endsection
