
<aside class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/Tenun.png') }}" alt="Logo Tenun AI" style="width: 180px; height: auto; margin-bottom: 8px;">
    </div>
    <nav>
    <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
    <a href="{{ url('/prediksi') }}" class="{{ Request::is('prediksi') ? 'active' : '' }}">Prediksi</a>
    <a href="{{ url('/histori') }}" class="{{ Request::is('histori') ? 'active' : '' }}">Histori</a>
    <a href="{{ url('/panduan') }}" class="{{ Request::is('panduan') ? 'active' : '' }}">Panduan Pengguna</a>
</nav>
    <div class="user-info">
        <p>Diana Resky Utami</p>
        <p>Vina Aulya Putri</p>
        <small>dina21ti@mahasiswa.pcr.ac.id</small>
        <small>vina22ti@mahasiswa.pcr.ac.id</small>
    </div>
</aside>
