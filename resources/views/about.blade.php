@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4">Tentang Website Ini</h1>
    <p class="mb-4">
        Website ini dibuat untuk membantu pengguna dalam memilih laptop yang sesuai dengan kebutuhan mereka, baik untuk keperluan <b>gaming</b>, <b>desain grafis</b>, <b>perkantoran</b>, maupun <b>sekolah</b>. Dengan banyaknya pilihan laptop di pasaran, seringkali konsumen kesulitan menentukan mana yang paling sesuai dengan spesifikasi dan anggaran yang dimiliki.
    </p>
    <p class="mb-4">
        Melalui website ini, pengguna dapat melakukan pencarian dan penyaringan berdasarkan berbagai kriteria seperti harga, merk, serta kategori penggunaan. Website ini juga dilengkapi fitur <b>wishlist</b> untuk menyimpan laptop yang diminati.
    </p>
    <h2 class="text-xl font-semibold mt-6 mb-2">Metode Penilaian: Simple Additive Weighting (SAW)</h2>
    <p class="mb-4">
        Untuk memberikan rekomendasi yang objektif dan relevan, website ini menggunakan metode <b>SAW (Simple Additive Weighting)</b>, salah satu metode pengambilan keputusan multikriteria. Metode ini bekerja dengan cara:
    </p>
    <ol class="list-decimal list-inside mb-4 space-y-2">
        <li>
            <b>Menentukan Bobot dan Jenis Kriteria</b><br>
            Setiap kategori laptop (gaming, desain, kantor, sekolah) memiliki bobot dan jenis kriteria yang berbeda. Contohnya:
            <ul class="list-disc list-inside ml-5">
                <li>Harga dan berat laptop dianggap sebagai <b>cost</b> (semakin rendah nilainya, semakin baik).</li>
                <li>RAM, benchmark CPU/GPU, ukuran baterai, resolusi, dll. dianggap sebagai <b>benefit</b> (semakin tinggi nilainya, semakin baik).</li>
            </ul>
        </li>
        <li>
            <b>Normalisasi Nilai</b><br>
            Nilai setiap kriteria dinormalisasi agar bisa dibandingkan secara adil.<br>
            <span class="block ml-5">Untuk kriteria benefit: <code>nilai / nilai maksimum</code></span>
            <span class="block ml-5">Untuk kriteria cost: <code>nilai minimum / nilai</code></span>
        </li>
        <li>
            <b>Perhitungan Skor Akhir</b><br>
            Setelah dinormalisasi, nilai setiap kriteria dikalikan dengan bobotnya. Seluruh hasil perkalian dijumlahkan untuk mendapatkan skor akhir SAW dari masing-masing laptop.
        </li>
        <li>
            <b>Pemeringkatan Laptop</b><br>
            Laptop-laptop akan diurutkan berdasarkan skor SAW tertinggi. Semakin tinggi skor, semakin sesuai laptop tersebut untuk kategori penggunaan yang dipilih.
        </li>
    </ol>
    <p>
        Dengan pendekatan ini, rekomendasi yang dihasilkan lebih transparan, logis, dan dapat dipertanggungjawabkan karena mempertimbangkan berbagai aspek penting dari spesifikasi laptop.
    </p>
</div>
@endsection