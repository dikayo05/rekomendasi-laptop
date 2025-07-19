@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="flex-1 px-4 py-8">
            {{-- teks dashboard --}}
            <div class="max-w-md mx-auto mb-10">
                <h2 class="text-2xl font-bold mb-2">Dashboard</h2>
                <p class="text-gray-600 ">Selamat datang, {{ Auth::user()->name }}</p>
            </div>

            {{-- Card statistik --}}
            <div class="max-w-6xl mx-auto mb-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-blue-100 border border-blue-300 rounded-lg p-6 flex items-center shadow">
                    <div
                        class="flex-shrink-0 bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-1-4H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-blue-700">
                            {{ \App\Models\Laptop::count() }}
                        </div>
                        <div class="text-gray-700">Jumlah Laptop</div>
                    </div>
                </div>
                <div class="bg-green-100 border border-green-300 rounded-lg p-6 flex items-center shadow">
                    <div
                        class="flex-shrink-0 bg-green-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-green-700">
                            {{ \App\Models\User::count() }}
                        </div>
                        <div class="text-gray-700">Jumlah Akun</div>
                    </div>
                </div>
            </div>



            {{-- Tombol tambah laptop --}}
            <div class="max-w-6xl mx-auto mb-4">
                <a href="{{ route('laptop.create') }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow">
                    + Tambah Laptop
                </a>
            </div>

            {{-- Pesan filter --}}
            @if (request()->has('q') || request()->filled('min_price') || request()->filled('max_price'))
                <div class="max-w-6xl mx-auto mb-4 text-sm text-gray-500">
                    Menampilkan hasil pencarian/filter.
                    <a href="{{ route('user') }}" class="text-blue-500 underline ml-2">Reset filter</a>
                </div>
            @endif

            {{-- Form pencarian --}}
            <div class="max-w-6xl mx-auto mb-6">
                <form method="GET" action="{{ route('user') }}" class="flex flex-col sm:flex-row gap-2">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Cari nama atau brand laptop..."
                        class="w-full sm:w-1/2 px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200" />
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow text-sm">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Tabel laptop --}}
            <div class="max-w-6xl mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Brand</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3">RAM</th>
                            <th class="px-6 py-3">Penyimpanan</th>
                            <th class="px-6 py-3">Gambar</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($laptops->currentPage() - 1) * $laptops->perPage() + 1;
                        @endphp
                        @forelse($laptops as $laptop)
                            <tr class="bg-white border-b hover:bg-gray-200 ">
                                <td class="px-6 py-4">{{ $no++ }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $laptop->name }}</td>
                                <td class="px-6 py-4">{{ $laptop->brand }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($laptop->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $laptop->ram }} GB</td>
                                <td class="px-6 py-4">{{ $laptop->internal_storage }} GB</td>
                                <td class="px-6 py-4">
                                    @if ($laptop->image)
                                        <img src="{{ asset($laptop->image) }}" alt="{{ $laptop->name }}"
                                            class="w-14 h-14 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('laptop.show', ['laptop' => $laptop->id]) }}"
                                        class="text-blue-600 hover:underline mr-2">Detail</a>
                                    <a href="{{ route('laptop.edit', $laptop->id) }}"
                                        class="text-yellow-500 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('laptop.destroy', $laptop->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white ">
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 ">Tidak ada data laptop.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-center">
                {{ $laptops->links() }}
            </div>
        </div>
    </div>
@endsection
