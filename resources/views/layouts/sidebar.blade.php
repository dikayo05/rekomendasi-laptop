<aside class="w-64 bg-white shadow rounded-lg p-6 mr-8 hidden md:block h-fit">
    <h4 class="font-bold text-lg mb-4">Filter</h4>
    {{-- Form Sortir --}}
    <form method="GET" action="{{ route('user') }}">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Rentang Harga</label>
            <div class="flex gap-2">
                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                    class="w-1/2 border rounded px-2 py-1" min="0">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                    class="w-1/2 border rounded px-2 py-1" min="0">
            </div>
        </div>

        {{-- Pertahankan pencarian jika ada --}}
        @if (request('q'))
            <input type="hidden" name="q" value="{{ request('q') }}">
        @endif
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded w-full">Terapkan</button>
    </form>
</aside>
