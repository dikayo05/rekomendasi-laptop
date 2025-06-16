@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Bandingkan Laptop</h2>
    <form method="POST" action="{{ route('laptop.compare.show') }}" class="mb-6">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold">
            Bandingkan Laptop ({{ count($compareIds ?? []) }})
        </button>
        @if($compareIds)
            <span class="ml-2 text-sm text-gray-500">
                @foreach($compareIds as $id)
                    #{{ $id }}
                @endforeach
            </span>
        @endif
    </form>

    @if(count($compareLaptops) > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Atribut</th>
                    @foreach($compareLaptops as $laptop)
                        <th class="px-4 py-2 border-b">
                            {{ $laptop->name }}<br>
                            <span class="text-xs text-gray-500">{{ $laptop->brand }}</span>
                            <form method="POST" action="{{ route('laptop.compare.remove') }}" class="mt-1">
                                @csrf
                                <input type="hidden" name="laptop_id" value="{{ $laptop->id }}">
                                <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                            </form>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $fields = [
                        'image' => 'Gambar',
                        'price' => 'Harga',
                        'weight' => 'Berat',
                        'thickness' => 'Ketebalan',
                        'screen_size' => 'Ukuran Layar',
                        'screen_width' => 'Lebar Layar',
                        'screen_height' => 'Tinggi Layar',
                        'resolution' => 'Resolusi',
                        'pixel_density' => 'Kerapatan Piksel',
                        'display_type' => 'Tipe Layar',
                        'brightness' => 'Kecerahan',
                        'refresh_rate' => 'Refresh Rate',
                        'cpu' => 'CPU',
                        'cpu_speed' => 'Kecepatan CPU',
                        'cpu_thread' => 'Thread CPU',
                        'gpu' => 'GPU',
                        'ram' => 'RAM',
                        'ram_speed' => 'Kecepatan RAM',
                        'vram' => 'VRAM',
                        'storage_type' => 'Tipe Penyimpanan',
                        'internal_storage' => 'Penyimpanan Internal',
                        'cpu_benchmark' => 'Benchmark CPU',
                        'cpu_benchmark_multithread' => 'Benchmark CPU Multithread',
                        'gpu_benchmark' => 'Benchmark GPU',
                        'battery_size' => 'Kapasitas Baterai',
                    ];
                @endphp
                @foreach($fields as $key => $label)
                <tr>
                    <td class="px-4 py-2 border-b font-semibold">{{ $label }}</td>
                    @foreach($compareLaptops as $laptop)
                        <td class="px-4 py-2 border-b">
                            @if($key === 'image' && $laptop->image)
                                <img src="{{ asset($laptop->image) }}" alt="Gambar" class="w-20 h-14 object-cover rounded">
                            @elseif($key === 'price')
                                Rp{{ number_format($laptop->price, 0, ',', '.') }}
                            @else
                                {{ $laptop->$key }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="text-gray-500">Belum ada laptop yang dipilih untuk dibandingkan.</div>
    @endif
</div>
@endsection
