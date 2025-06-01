@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4">Tentang Website Ini</h1>
    <p class="mb-4">
        Website ini dibangun sebagai platform rekomendasi laptop yang membantu pengguna dalam memilih laptop terbaik sesuai kebutuhan mereka, seperti untuk <b>gaming</b>, <b>desain grafis</b>, <b>sekolah</b>, maupun <b>pekerjaan kantor</b>.
    </p>
    <p class="mb-4">
        Kami menyadari bahwa memilih laptop yang tepat bisa menjadi hal yang membingungkan karena banyaknya spesifikasi teknis yang perlu dipertimbangkan. Oleh karena itu, website ini hadir untuk memberikan rekomendasi laptop berdasarkan perhitungan yang objektif dan terstruktur, menggunakan metode <b>SAW (Simple Additive Weighting)</b>.
    </p>
    <h2 class="text-xl font-semibold mt-6 mb-2">Tujuan Website</h2>
    <ul class="list-disc list-inside mb-4 space-y-1">
        <li>Membantu pengguna menemukan laptop yang paling sesuai dengan kebutuhan dan anggaran mereka.</li>
        <li>Menyediakan sistem penilaian dan pemeringkatan laptop secara otomatis berdasarkan berbagai kriteria penting.</li>
        <li>Memberikan filtering dan pencarian berdasarkan harga, brand, dan nama laptop.</li>
    </ul>
    <h2 class="text-xl font-semibold mt-6 mb-2">Cara Kerja Metode SAW</h2>
    <ol class="list-decimal list-inside mb-4 space-y-2">
        <li>
            <b>Menentukan Kriteria dan Bobot</b><br>
            Setiap kategori (seperti gaming, desain, sekolah, kantor) memiliki kriteria dan bobot penilaian yang berbeda. Contohnya:
            <ul class="list-disc list-inside ml-5">
                <li>Untuk kategori gaming, kriteria seperti <b>CPU</b>, <b>GPU</b>, dan <b>RAM</b> memiliki bobot yang besar karena sangat memengaruhi performa.</li>
                <li>Untuk kategori sekolah, kriteria seperti <b>harga</b>, <b>daya tahan baterai</b>, dan <b>berat laptop</b> lebih diprioritaskan.</li>
            </ul>
        </li>
        <li>
            <b>Klasifikasi Cost dan Benefit</b>
            <ul class="list-disc list-inside ml-5">
                <li><b>Benefit:</b> Semakin tinggi nilainya, semakin baik (contoh: RAM, CPU benchmark).</li>
                <li><b>Cost:</b> Semakin rendah nilainya, semakin baik (contoh: harga, berat laptop).</li>
            </ul>
        </li>
        <li>
            <b>Normalisasi Nilai Kriteria</b><br>
            Nilai setiap laptop dinormalisasi agar dapat dibandingkan secara adil:
            <ul class="list-disc list-inside ml-5">
                <li>Untuk benefit: <code>nilai / nilai maksimum</code></li>
                <li>Untuk cost: <code>nilai minimum / nilai</code></li>
            </ul>
        </li>
        <li>
            <b>Perhitungan Skor Akhir (SAW Score)</b><br>
            Skor akhir dihitung dengan menjumlahkan hasil normalisasi yang telah dikalikan dengan bobot masing-masing kriteria.
        </li>
        <li>
            <b>Pemeringkatan</b><br>
            Laptop dengan skor tertinggi akan muncul di urutan teratas sebagai rekomendasi terbaik untuk kategori yang dipilih.
        </li>
    </ol>
    <h2 class="text-xl font-semibold mt-6 mb-2">Fitur Tambahan</h2>
    <ul class="list-disc list-inside mb-2 space-y-1">
        <li>Filter berdasarkan harga minimum dan maksimum</li>
        <li>Sorting berdasarkan nama atau merek</li>
        <li>Wishlist, agar pengguna dapat menyimpan laptop favorit mereka</li>
    </ul>
</div>
@endsection