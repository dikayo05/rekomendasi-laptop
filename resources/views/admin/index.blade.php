@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Siderbar --}}
    @include('layouts.sidebar')

    <div class="flex-1">
        <div class="max-w-md mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
            <p>Selamat datang, {{ Auth::user()->name }}</p>
        </div>

        {{-- Daftar Laptop dalam bentuk tabel --}}
        <div class="max-w-6xl mx-auto mt-10">
            <h3 class="text-xl font-semibold mb-4">Daftar Laptop</h3>

            {{-- Tombol tambah laptop --}}
            <div class="mb-4">
                <a href="{{ route('laptop.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Laptop</a>
            </div>

            {{-- Tampilkan pesan jika filter terlalu ketat --}}
            @if(request()->has('q') || request()->filled('min_price') || request()->filled('max_price'))
                <div class="mb-4 text-sm text-gray-500">
                    Menampilkan hasil pencarian/filter.
                    <a href="{{ route('user') }}" class="text-blue-500 underline ml-2">Reset filter</a>
                </div>
            @endif

            {{-- Form Pencarian --}}
            <form method="GET" action="{{ route('user') }}" class="mb-6 flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau brand laptop..." class="border rounded px-3 py-2 w-full" />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">No</th>
                            <th class="px-4 py-2 border-b">Nama</th>
                            <th class="px-4 py-2 border-b">Brand</th>
                            <th class="px-4 py-2 border-b">Harga</th>
                            <th class="px-4 py-2 border-b">Tipe</th>
                            <th class="px-4 py-2 border-b">RAM</th>
                            <th class="px-4 py-2 border-b">Penyimpanan</th>
                            <th class="px-4 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($laptops->currentPage() - 1) * $laptops->perPage() + 1;
                        @endphp
                        @forelse($laptops as $laptop)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $no++ }}</td>
                            <td class="px-4 py-2 border-b">{{ $laptop->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $laptop->brand }}</td>
                            <td class="px-4 py-2 border-b">Rp{{ number_format($laptop->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b">{{ $laptop->type }}</td>
                            <td class="px-4 py-2 border-b">{{ $laptop->ram }}</td>
                            <td class="px-4 py-2 border-b">{{ $laptop->internal_storage }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('laptop.show', ['laptop' => $laptop->id]) }}" class="text-blue-500 hover:underline">Detail</a>
                                <a href="{{ route('laptop.edit', $laptop->id) }}" class="text-yellow-500 hover:underline ml-2">Edit</a>
                                <form action="{{ route('laptop.destroy', $laptop->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-4">Tidak ada data laptop.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $laptops->links() }}
        </div>
    </div>
</div>
@endsection