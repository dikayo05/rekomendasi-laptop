@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Laptop</h2>
    <form method="POST" action="{{ route('laptop.update', $laptop->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-1">Nama Laptop</label>
            <input type="text" name="name" id="name" value="{{ old('name', $laptop->name) }}"
                class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="brand" class="block text-sm font-medium mb-1">Brand</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand', $laptop->brand) }}"
                class="w-full border rounded px-3 py-2 @error('brand') border-red-500 @enderror">
            @error('brand')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium mb-1">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price', $laptop->price) }}"
                class="w-full border rounded px-3 py-2 @error('price') border-red-500 @enderror">
            @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tambahkan field lainnya sesuai kebutuhan --}}

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('user') }}" class="ml-2 text-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection