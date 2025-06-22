<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'TENUN AI')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <div class="container">
        @include('sideBar') <!-- Menyertakan Sidebar untuk setiap halaman -->

        <main class="main">
            @yield('content') <!-- Konten halaman yang akan diganti -->
        </main>
    </div>
</body>

</html>