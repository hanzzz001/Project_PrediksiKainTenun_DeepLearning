<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PredictionController extends Controller
{
    // Menampilkan semua prediksi (READ)
    public function index()
    {
        $predictions = Prediction::latest()->get();

        //Link sejarah yang sama untuk semua motif
        $sejarah_link = 'https://tenun.id/';

        return view('histori', [
            'predictions' => $predictions,
            'sejarah_link' => $sejarah_link
        ]);
    }

    // Menyimpan hasil prediksi (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'motif_name' => 'required|string|max:255',
            'accuracy' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('predictions', 'public');

        Prediction::create([
            'motif_name' => $request->motif_name,
            'accuracy' => $request->accuracy,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('predictions.index')->with('success', 'Prediksi berhasil disimpan!');
    }

    // Menampilkan detail satu prediksi (READ)
    public function show($id)
    {
        $prediction = Prediction::findOrFail($id);
        return view('predictions.show', compact('prediction'));
    }

    // Menampilkan form edit (UPDATE)
    public function edit($id)
    {
        $prediction = Prediction::findOrFail($id);
        return view('predictions.edit', compact('prediction'));
    }

    // Menyimpan perubahan data prediksi (UPDATE)
    public function update(Request $request, $id)
    {
        $prediction = Prediction::findOrFail($id);

        $request->validate([
            'motif_name' => 'required|string|max:255',
            'accuracy' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update gambar jika diunggah ulang
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($prediction->image_path) {
                Storage::disk('public')->delete($prediction->image_path);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('predictions', 'public');
            $prediction->image_path = $imagePath;
        }

        // Update data lainnya
        $prediction->motif_name = $request->motif_name;
        $prediction->accuracy = $request->accuracy;
        $prediction->description = $request->description;
        $prediction->save();

        return redirect()->route('predictions.index')->with('success', 'Data prediksi berhasil diperbarui.');
    }

    // Menghapus data prediksi (DELETE)
    public function destroy($id)
    {
        $prediction = Prediction::findOrFail($id);

        // Hapus gambar dari storage
        if ($prediction->image_path) {
            Storage::disk('public')->delete($prediction->image_path);
        }

        // Hapus dari database
        $prediction->delete();

        return redirect()->route('predictions.index')->with('success', 'Data prediksi berhasil dihapus.');
    }
}
