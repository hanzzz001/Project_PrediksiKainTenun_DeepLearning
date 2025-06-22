@extends('layouts.app')

@section('title', 'Prediksi Tenun')

@section('content')
    <div class="container">
        <main class="main">
            <section class="prediction-section">
                <div class="upload-box">
                    <h3>New Scan</h3>

                    <form action="{{ route('predictions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="upload-area">
                            <input type="file" id="upload" name="image" required hidden />
                            <label for="upload" class="upload-label">CHOOSE SCAN</label>
                        </div>

                        <div class="image-preview">
                            <img id="preview-image" src="" alt="Preview Gambar" style="max-width: 100%; display: none;" />
                        </div>

                        <input type="hidden" name="motif_name" id="motif_name">
                        <input type="hidden" name="accuracy" id="accuracy">
                        <input type="hidden" name="description" id="description">

                        <div style="margin-top: 1rem;">
                            <button type="button" class="predict-btn btn-filled">Prediksi</button>
                        </div>

                        <div class="result-box" style="margin-top: 2rem;">
                            <h3>Results</h3>

                            <div class="image-preview">
                                <img id="result-image" src="" alt="Hasil Gambar" style="max-width: 100%; display: none;" />
                            </div>

                            <div class="result-info" style="margin-top: 1rem;">
                                <p><strong>Nama Motif:</strong> -</p>
                                <p><strong>Akurasi:</strong> -</p>
                                <p><strong>Deskripsi:</strong> -</p>
                            </div>

                            <div style="margin-top: 1rem;">
                                <button type="submit" class="btn-filled">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
@endsection

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadInput = document.getElementById('upload');
        const previewImage = document.getElementById('preview-image');
        const resultImage = document.getElementById('result-image');
        const resultInfo = document.querySelector('.result-info');
        const predictBtn = document.querySelector('.predict-btn');

        const motifInput = document.getElementById('motif_name');
        const accuracyInput = document.getElementById('accuracy');
        const descriptionInput = document.getElementById('description');

        const motifDescriptions = {
            "Bali": "Kain tenun dari Bali dikenal dengan nama Gringsing, salah satu jenis kain tenun ikat ganda yang langka dan hanya diproduksi di desa Tenganan Pegringsingan.",
            "Sumatera": "Kain tenun khas dari Sumatera Barat dikenal dengan nama Songket Minangkabau, dengan benang emas atau perak yang menciptakan motif megah dan berkilau.",
            "Barat": "Kain tenun khas dari Sumatera Barat dikenal dengan nama Songket Minangkabau.",
            "Lombok": "Kain tenun dari Lombok biasa disebut Tenun Ikat Lombok, dibuat oleh suku Sasak, bermotif alam dan geometris.",
            "Palembang": "Songket Palembang adalah kain tenun yang mewah dengan benang emas atau perak, sering dikenakan dalam acara adat.",
            "Riau": "Kain tenun Riau dikenal dengan nama Tenun Melayu Riau, bermotif flora/fauna, melambangkan kesopanan dan budaya pesisir."
        };

        const labelMap = {
            "Bali": "Motif Bali",
            "Sumatera": "Motif Sumatera",
            "Barat": "Motif Sumatera Barat",
            "Lombok": "Motif Lombok",
            "Palembang": "Motif Palembang",
            "Riau": "Motif Riau"
        };

        uploadInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        predictBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const file = uploadInput.files[0];
            if (!file) {
                alert("Silakan pilih gambar terlebih dahulu.");
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            fetch('http://localhost:5000/predict', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text || 'Server error');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    const predictedLabel = data.label;
                    const accuracy = parseFloat(data.accuracy); // pastikan angka
                    const threshold = 70;

                    let fullMotifName, description;

                    if (accuracy < threshold || !labelMap[predictedLabel]) {
                        fullMotifName = "Bukan termasuk motif kain Tenun";
                        description = "Gambar ini tidak dikenali sebagai salah satu motif kain Tenun oleh sistem.";
                    } else {
                        fullMotifName = labelMap[predictedLabel];
                        description = motifDescriptions[predictedLabel] || "Deskripsi tidak ditemukan.";
                    }

                    resultImage.src = previewImage.src;
                    resultImage.style.display = 'block';
                    resultInfo.innerHTML = `
                        <p><strong>Nama Motif:</strong> ${fullMotifName}</p>
                        <p><strong>Akurasi:</strong> ${accuracy}%</p>
                        <p><strong>Deskripsi:</strong> ${description}</p>
                    `;

                    motifInput.value = fullMotifName;
                    accuracyInput.value = accuracy;
                    descriptionInput.value = description;
                })
                .catch((err) => {
                    console.error('Terjadi kesalahan saat prediksi:', err);
                    alert('Terjadi kesalahan saat prediksi.\n' + err.message);
                });
        });
    });
</script>