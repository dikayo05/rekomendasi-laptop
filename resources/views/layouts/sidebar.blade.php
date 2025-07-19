<aside class="w-64 bg-white shadow rounded-lg p-6 mr-8 hidden md:block h-fit">
    <h4 class="font-bold text-lg mb-4">Filter</h4>

    {{-- Dropdown Kategori --}}
    <div class="max-w-4xl mx-auto mt-6 mb-6">
        <form method="GET" action="{{ route('user') }}">
            {{-- Pertahankan filter pencarian dan harga --}}
            <input type="hidden" name="q" value="{{ request('q') }}">
            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
            <input type="hidden" name="sort" value="{{ request('sort') }}">

            <div class="flex items-center gap-2">
                <label class="font-semibold">Kategori:</label>

                <button id="dropdownCategoryButton" data-dropdown-toggle="dropdownCategory"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    {{ ucfirst(request('category', $category ?? 'gaming')) }}
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown menu -->
            <div id="dropdownCategory"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCategoryButton">
                    @foreach (['gaming', 'desain', 'school', 'office'] as $cat)
                        <li>
                            <button type="submit" name="category" value="{{ $cat }}"
                                class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request('category', $category ?? 'gaming') === $cat ? 'font-semibold' : '' }}">
                                {{ ucfirst($cat) }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>

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
