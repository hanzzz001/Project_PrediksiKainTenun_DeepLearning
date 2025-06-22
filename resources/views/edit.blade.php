@extends('layouts.app')

@section('title', 'Edit Prediksi')

@section('content')
<div class="container">
    <h1>Edit Prediksi</h1>

    <form action="{{ route('predictions.update', $prediction->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Motif:</label>
        <input type="text" name="motif_name" value="{{ $prediction->motif_name }}" required><br>

        <label>Akurasi:</label>
        <input type="text" name="accuracy" value="{{ $prediction->accuracy }}" required><br>

        <label>Deskripsi:</label>
        <textarea name="description" required>{{ $prediction->description }}</textarea><br>

        <label>Gambar:</label>
        <input type="file" name="image"><br>
        <img src="{{ asset('storage/' . $prediction->image_path) }}" width="200">

        <button type="submit">Update</button>
    </form>
</div>
@endsection
