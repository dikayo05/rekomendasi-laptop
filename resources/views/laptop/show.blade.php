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

            {{-- Chart --}}
            <div class="mb-6">
                <canvas id="laptopChart" width="400" height="250"></canvas>
            </div>

            <ul class="mb-4 text-gray-700 space-y-1">
                <li><b>Harga:</b> Rp{{ number_format($laptop->price, 0, ',', '.') }}</li>
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

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var chartCanvas = document.getElementById('laptopChart');
    if (!chartCanvas) return;
    var ctx = chartCanvas.getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['CPU Benchmark', 'GPU Benchmark', 'Battery Size', 'Ram', 'Refresh Rate', 'Internal Storage', 'Weight', 'Brightness'],
            datasets: [{
                label: @json($laptop->name),
                backgroundColor: 'rgba(59,130,246,0.2)',
                borderColor: '#3b82f6',
                pointBackgroundColor: '#3b82f6',
                data: [
                    Number({{ $laptop->chart_scores['cpu_benchmark'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['gpu_benchmark'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['battery_size'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['ram'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['refresh_rate'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['internal_storage'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['weight'] ?? 0 }}),
                    Number({{ $laptop->chart_scores['brightness'] ?? 0 }})
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    pointLabels: {
                        font: { size: 14 }
                    },
                    max: 100
                }
            }
        }
    });
});
</script>

@endsection
