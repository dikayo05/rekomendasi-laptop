@extends('layouts.app')

@section('content')
<div class="flex">

    {{-- Siderbar --}}
    @include('layouts.sidebar')

    <div class="flex-1">
        <div class="max-w-md mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-4">Homepage</h2>
            <p>Selamat datang, {{ Auth::check() ? Auth::user()->name : 'Pengunjung' }}!</p>
        </div>

        {{-- Pilih Kategori --}}
        <div class="max-w-4xl mx-auto mt-6 mb-6">
            <form method="GET" action="{{ route('user') }}" class="flex flex-wrap gap-2 items-center">
                {{-- Pertahankan filter pencarian dan harga --}}
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <label class="font-semibold mr-2">Kategori:</label>

                <select name="category" onchange="this.form.submit()" class="border rounded px-3 py-2">
                    <option value="gaming" {{ (request('category', $category ?? 'gaming') == 'gaming') ? 'selected' : '' }}>Gaming</option>
                    <option value="desain" {{ (request('category', $category ?? '') == 'desain') ? 'selected' : '' }}>Desain</option>
                    <option value="school" {{ (request('category', $category ?? '') == 'school') ? 'selected' : '' }}>School</option>
                    <option value="office" {{ (request('category', $category ?? '') == 'office') ? 'selected' : '' }}>Office</option>
                </select>
            </form>
        </div>

        {{-- Daftar Laptop --}}
        <div class="max-w-4xl mx-auto mt-10">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Daftar Laptop</h3>
                @auth
                <a href="{{ route('wishlist.index') }}" class="bg-pink-500 text-black px-4 py-2 rounded hover:bg-pink-600">
                    Lihat Wishlist
                </a>
                @endauth
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Card Laptop --}}
                @forelse($laptops as $laptop)
                    <a href="{{ route('laptop.show', ['laptop' => $laptop->id, 'page' => request('page', 1)]) }}" class="block hover:shadow-lg transition-shadow duration-200">
                        <div class="bg-white shadow rounded-lg p-4 flex flex-col h-full">
                            {{-- Gambar --}}
                            @if(!empty($laptop->image))
                                <img src="{{ asset($laptop->image) }}" alt="Gambar Laptop" class="w-full h-32 object-cover rounded mb-2">
                            @endif
                            <div class="mb-2">
                                <h4 class="font-bold text-lg">{{ $laptop->name }}</h4>
                                <p class="text-gray-600 text-sm">{{ $laptop->brand }}</p>
                            </div>
                            <div class="flex-1">
                                <ul class="text-sm text-gray-700 mb-2">
                                    <li>Rp{{ number_format($laptop->price, 0, ',', '.') }}</li>
                                    <li>
                                        <span class="text-xs text-gray-500">Skor SAW: {{ number_format($laptop->saw_score ?? 0, 4) }}</span>
                                    </li>
                                </ul>
                            </div>
                            {{-- Tombol Wishlist --}}
                            @auth
                            <form method="POST" action="{{ route('wishlist.add', $laptop->id) }}" class="mt-2">
                                @csrf
                                <button type="submit" class="bg-pink-500 text-black px-3 py-1 rounded hover:bg-pink-600 w-full text-center font-semibold">
                                    <span class="block">Tambah ke Wishlist</span>
                                </button>
                            </form>
                            @else
                            <button class="bg-gray-300 text-gray-500 px-3 py-1 rounded w-full mt-2 cursor-not-allowed" disabled>
                                <span class="block">Login untuk Wishlist</span>
                            </button>
                            @endauth
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-gray-500">Tidak ada data laptop.</div>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $laptops->links() }}
        </div>
    </div>
</div>
@endsection