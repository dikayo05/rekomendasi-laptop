@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 ">Tentang Website Ini</h1>
    <p class="mb-3 text-gray-500 ">
        Website ini dibangun sebagai platform rekomendasi laptop yang membantu pengguna dalam memilih laptop terbaik
        sesuai kebutuhan mereka, seperti untuk <strong>gaming</strong>, <strong>desain grafis</strong>,
        <strong>sekolah</strong>, maupun <strong>pekerjaan kantor</strong>.
    </p>
    <p class="mb-3 text-gray-500 ">
        Website ini memberikan rekomendasi berdasarkan metode <strong>SAW (Simple Additive Weighting)</strong>, agar proses pemilihan lebih objektif dan terstruktur.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800 ">Tujuan Website</h2>
    <ul class="list-disc list-inside text-gray-500  mb-4 space-y-1">
        <li>Membantu pengguna menemukan laptop sesuai kebutuhan dan anggaran.</li>
        <li>Menyediakan sistem penilaian dan pemeringkatan otomatis.</li>
        <li>Fitur filtering dan pencarian berdasarkan harga, brand, dan nama laptop.</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800 ">Cara Kerja Metode SAW</h2>
    <ol class="list-decimal list-inside text-gray-500  mb-4 space-y-2">
        <li>
            <strong>Menentukan Kriteria dan Bobot</strong><br>
            Setiap kategori memiliki bobot yang berbeda. Contohnya:
            <ul class="list-disc list-inside ml-5 mt-1">
                <li>Gaming: CPU, GPU, dan RAM lebih berat bobotnya.</li>
                <li>Sekolah: Harga, baterai, dan berat laptop lebih diprioritaskan.</li>
            </ul>
        </li>
        <li>
            <strong>Klasifikasi Cost dan Benefit</strong><br>
            <ul class="list-disc list-inside ml-5">
                <li><strong>Benefit:</strong> Nilai lebih tinggi lebih baik (RAM, benchmark).</li>
                <li><strong>Cost:</strong> Nilai lebih rendah lebih baik (harga, berat).</li>
            </ul>
        </li>

        <li>
            <strong>Kriteria & Bobot Kategori</strong><br>
            <div class="space-y-6">
                @foreach(['Gaming', 'Desain', 'School', 'Office'] as $kategori)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700  mt-4">{{ $kategori }}</h3>
                        <div class="overflow-auto rounded-lg border border-gray-200  mt-2">
                            <table class="w-full text-sm text-left text-gray-700 ">
                                <thead class="bg-gray-100  text-gray-700 0">
                                    <tr>
                                        <th class="px-4 py-2">Kriteria</th>
                                        <th class="px-4 py-2">Bobot</th>
                                        <th class="px-4 py-2">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white ">
                                    @php
                                        $data = [
                                            'Gaming' => [
                                                ['price', '0.15', 'cost'],
                                                ['ram', '0.15', 'benefit'],
                                                ['cpu_benchmark', '0.2', 'benefit'],
                                                ['gpu_benchmark', '0.2', 'benefit'],
                                                ['battery_size', '0.1', 'benefit'],
                                                ['screen_size', '0.05', 'benefit'],
                                                ['refresh_rate', '0.05', 'benefit'],
                                                ['internal_storage', '0.05', 'benefit'],
                                                ['weight', '0.05', 'cost'],
                                            ],
                                            'Desain' => [
                                                ['price', '0.15', 'cost'],
                                                ['ram', '0.15', 'benefit'],
                                                ['cpu_benchmark', '0.15', 'benefit'],
                                                ['gpu_benchmark', '0.1', 'benefit'],
                                                ['screen_size', '0.1', 'benefit'],
                                                ['display_type', '0.1', 'benefit'],
                                                ['resolution', '0.1', 'benefit'],
                                                ['brightness', '0.05', 'benefit'],
                                                ['weight', '0.1', 'cost'],
                                            ],
                                            'School' => [
                                                ['price', '0.25', 'cost'],
                                                ['ram', '0.15', 'benefit'],
                                                ['battery_size', '0.15', 'benefit'],
                                                ['weight', '0.15', 'cost'],
                                                ['screen_size', '0.1', 'benefit'],
                                                ['cpu_benchmark', '0.1', 'benefit'],
                                                ['internal_storage', '0.1', 'benefit'],
                                            ],
                                            'Office' => [
                                                ['price', '0.2', 'cost'],
                                                ['ram', '0.15', 'benefit'],
                                                ['cpu_benchmark', '0.15', 'benefit'],
                                                ['battery_size', '0.15', 'benefit'],
                                                ['weight', '0.1', 'cost'],
                                                ['screen_size', '0.1', 'benefit'],
                                                ['internal_storage', '0.15', 'benefit'],
                                                ['thickness', '0.05', 'cost'],
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($data[$kategori] as $row)
                                        <tr class="border-t border-gray-200 ">
                                            <td class="px-4 py-2">{{ $row[0] }}</td>
                                            <td class="px-4 py-2">{{ $row[1] }}</td>
                                            <td class="px-4 py-2">{{ $row[2] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </li>

        <li>
            <strong>Normalisasi Nilai Kriteria</strong><br>
            <ul class="list-disc list-inside ml-5 mt-1">
                <li>Benefit: <code>nilai / nilai maksimum</code></li>
                <li>Cost: <code>nilai minimum / nilai</code></li>
            </ul>
        </li>
        <li>
            <strong>Perhitungan Skor Akhir</strong><br>
            Skor dihitung dari jumlah hasil normalisasi dikali bobot.
        </li>
        <li>
            <strong>Pemeringkatan</strong><br>
            Laptop dengan skor tertinggi berada di urutan teratas sebagai rekomendasi terbaik.
        </li>
    </ol>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800 ">Fitur Tambahan</h2>
    <ul class="list-disc list-inside text-gray-500  space-y-1">
        <li>Filter berdasarkan harga minimum dan maksimum</li>
        <li>Sorting berdasarkan nama atau merek</li>
        <li>Wishlist untuk menyimpan laptop favorit</li>
    </ul>
</div>

@endsection
