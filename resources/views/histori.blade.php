@extends('layouts.app')

@section('title', 'Histori Prediksi')

@section('content')
    <div class="container">
        <main class="main" style="margin-left: 240px; padding: 20px;">
            <header class="topbar">
                <h1>Histori Prediksi</h1>
            </header>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <section class="history-section">
                @forelse ($predictions as $prediction)
                    <div class="history-card"
                        style="border:1px solid #ccc; padding:15px; margin-bottom:15px; display:flex; gap:15px; align-items:center;">
                        <div class="card-image">
                            <img src="{{ asset('storage/' . $prediction->image_path) }}" alt="Tenun"
                                style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        </div>
                        <div class="card-info">
                            <p><strong>Nama Tenun:</strong> {{ $prediction->motif_name }}</p>
                            <p><strong>Tanggal:</strong> {{ $prediction->created_at->format('d M Y') }}</p>
                            <p><strong>Akurasi:</strong> {{ $prediction->accuracy }}%</p>
                            <p><strong>Deskripsi:</strong>
                                {{ $prediction->description }}
                                <a href="{{ $sejarah_link }}" target="_blank" style="color: blue; text-decoration: underline;">
                                    (Baca sejarah lengkap)
                                </a>
                            </p>
                            <form action="{{ route('predictions.destroy', $prediction->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada data prediksi.</p>
                @endforelse
            </section>
        </main>
    </div>
@endsection
