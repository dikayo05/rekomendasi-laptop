@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow ">
    <a href="{{ route('user', ['page' => request('page', 1)]) }}" 
       class="inline-flex items-center text-blue-600 hover:underline mb-6">
        ← Kembali ke daftar laptop
    </a>

    <div class="flex flex-col md:flex-row gap-6">
        @if(!empty($laptop->image))
            <div class="md:w-64 w-full h-48">
                <img src="{{ asset($laptop->image) }}" alt="Gambar Laptop" 
                     class="w-full h-full object-cover rounded-lg shadow">
            </div>
        @endif

        <div class="flex-1">
            <h2 class="text-2xl font-bold mb-2 text-gray-900 ">{{ $laptop->name }}</h2>
            <p class="text-gray-500 ">{{ $laptop->brand }}</p>

            {{-- Chart --}}
            <div class="mb-6">
                <canvas id="laptopChart" width="400" height="250"></canvas>
            </div>

            <div class="overflow-auto">
                <ul class="space-y-2 text-sm text-gray-700 ">
                    <li><strong>Harga:</strong> Rp{{ number_format($laptop->price, 0, ',', '.') }}</li>
                    <li><strong>Berat:</strong> {{ $laptop->weight }} g</li>
                    <li><strong>Ketebalan:</strong> {{ $laptop->thickness }} mm</li>
                    <li><strong>Ukuran Layar:</strong> {{ $laptop->screen_size }}</li>
                    <li><strong>Lebar Layar:</strong> {{ $laptop->screen_width }}</li>
                    <li><strong>Tinggi Layar:</strong> {{ $laptop->screen_height }}</li>
                    <li><strong>Resolusi:</strong> {{ $laptop->resolution }}</li>
                    <li><strong>Kerapatan Piksel:</strong> {{ $laptop->pixel_density }} ppi</li>
                    <li><strong>Tipe Layar:</strong> {{ $laptop->display_type }}</li>
                    <li><strong>Kecerahan:</strong> {{ $laptop->brightness }} nits</li>
                    <li><strong>Refresh Rate:</strong> {{ $laptop->refresh_rate }} Hz</li>
                    <li><strong>CPU:</strong> {{ $laptop->cpu }}</li>
                    <li><strong>Kecepatan CPU:</strong> {{ $laptop->cpu_speed }} GHz</li>
                    <li><strong>Thread CPU:</strong> {{ $laptop->cpu_thread }}</li>
                    <li><strong>GPU:</strong> {{ $laptop->gpu }}</li>
                    <li><strong>RAM:</strong> {{ $laptop->ram }} GB</li>
                    <li><strong>Kecepatan RAM:</strong> {{ $laptop->ram_speed }} MHz</li>
                    <li><strong>VRAM:</strong> {{ $laptop->vram }} GB</li>
                    <li><strong>Tipe Penyimpanan:</strong> {{ $laptop->storage_type }}</li>
                    <li><strong>Penyimpanan Internal:</strong> {{ $laptop->internal_storage }} GB</li>
                    <li><strong>Benchmark CPU:</strong> {{ $laptop->cpu_benchmark }}</li>
                    <li><strong>Benchmark CPU Multithread:</strong> {{ $laptop->cpu_benchmark_multithread }}</li>
                    <li><strong>Benchmark GPU:</strong> {{ $laptop->gpu_benchmark }}</li>
                    <li><strong>Kapasitas Baterai:</strong> {{ $laptop->battery_size }} Wh</li>
                </ul>
            </div>
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
