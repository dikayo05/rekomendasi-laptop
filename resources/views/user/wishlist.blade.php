@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold">Wishlist Laptop</h3>
        <a href="{{ route('user') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
            Kembali ke Daftar Laptop
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($laptops as $laptop)
            <div class="relative">
                <a href="{{ route('laptop.show', ['laptop' => $laptop->id, 'from' => 'wishlist']) }}" class="block hover:shadow-lg transition-shadow duration-200">
                    <div class="bg-white shadow rounded-lg p-4 flex flex-col h-full">
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
                            </ul>
                        </div>
                    </div>
                </a>
                <form method="POST" action="{{ route('wishlist.remove', $laptop->id) }}" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600" title="Hapus dari Wishlist">
                        Hapus
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">Wishlist kosong.</div>
        @endforelse
    </div>
    <div class="mt-6 flex justify-center">
        {{ $laptops->links() }}
    </div>
</div>
@endsection
