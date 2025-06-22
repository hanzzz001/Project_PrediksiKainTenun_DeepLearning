@extends('layouts.app')

@section('title', 'Panduan Pengguna')

@section('content')
    <div class="container">

        <main class="main">
            <header class="topbar">
                <h1>Panduan Pengguna</h1>
            </header>

            <section class="guide-section">
                <h2>Cara Menggunakan Aplikasi:</h2>
                <ol>
                    <li>Pilih menu <strong>Prediksi</strong></li>
                    <li>Unggah foto tenun</li>
                    <li>Tekan tombol <strong>Prediksi</strong></li>
                    <li>Lihat hasil prediksi dan akurasi</li>
                    <li>Simpan jika diperlukan</li>
                </ol>
                <p>Anda juga dapat melihat riwayat prediksi di menu <strong>Histori</strong>.</p>
            </section>
        </main>
    </div>
@endsection