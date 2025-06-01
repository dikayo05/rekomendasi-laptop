{{-- Halaman form tambah laptop --}}
@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Laptop</h2>
    <form method="POST" action="{{ route('laptop.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Brand</label>
            <input type="text" name="brand" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        {{-- Tambahkan input field lain sesuai kebutuhan --}}
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection