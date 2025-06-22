@extends('layouts.app')

@section('title', 'Tentang Tenun')

@section('content')
<div style="display: flex; justify-content: center; margin-top: 40px;">
    <div class="about-tenun" style="max-width: 800px; background-color: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: center;">
        <h1 style="color: #c0392b; margin-bottom: 24px;">Tentang Tenun di Indonesia</h1>

        <img src="{{ asset('images/kain tenun.jpg') }}" alt="Kain Tenun Indonesia" style="width: 300px; height: auto; margin-bottom: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">

        <p style="font-size: 16px; line-height: 1.8; text-align: justify;">
            Tenun adalah teknik pembuatan kain dengan prinsip sederhana, yaitu menggabungkan benang secara memanjang (lusi) dan melintang (pakan) secara bergantian. Kain tenun biasanya terbuat dari serat kayu, kapas, sutra, dan lainnya.
        </p>

        <h2 style="color: #c0392b; margin-top: 24px;">Sejarah Tenun</h2>
        <p style="font-size: 16px; line-height: 1.8; text-align: justify;">
            Kegiatan menenun telah ada sejak tahun 500 SM di berbagai peradaban seperti Mesopotamia, Mesir, India, dan Turki. Di Indonesia, tradisi menenun diperkirakan berkembang sejak masa Neolitikum, dibuktikan dengan ditemukannya artefak tenun di situs-situs prasejarah seperti Sumba Timur, Gunung Wingko, Yogyakarta, dan Gilimanuk.
        </p>

        <h2 style="color: #c0392b; margin-top: 24px;">Ragam Tenun Nusantara</h2>
        <p style="font-size: 16px; line-height: 1.8; text-align: justify;">
            Kain tenun diproduksi di berbagai daerah di Indonesia, masing-masing dengan ciri khas motif dan teknik yang unik. Beberapa jenis tenun yang terkenal antara lain:
        </p>
        <ul style="text-align: left; font-size: 16px; line-height: 1.8;">
            <li><strong>Songket:</strong> Tenun dengan benang emas atau perak, populer di Palembang, Sumatera Barat, dan Sambas.</li>
            <li><strong>Tenun Ikat:</strong> Teknik mengikat dan mewarnai benang sebelum ditenun, ditemukan di Nusa Tenggara dan Kalimantan.</li>
            <li><strong>Gringsing:</strong> Tenun khas Bali dengan motif simetris dan filosofi mendalam.</li>
            <li><strong>Ulos:</strong> Kain adat Batak dari Sumatera Utara yang digunakan dalam upacara tradisional.</li>
        </ul>

        <p style="font-size: 16px; line-height: 1.8; text-align: justify;">
            Setiap kain tenun mencerminkan identitas budaya dan nilai-nilai masyarakat setempat, menjadikannya warisan budaya yang berharga.
        </p>
    </div>
</div>
@endsection
