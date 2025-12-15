<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zozoland</title>

    {{-- IMPORT STYLE GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

    {{-- ================= NAVBAR ================= --}}
    <header class="site-header">
        <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
            {{-- LOGO KIRI --}}
            <a href="/" class="site-brand">
                <img src="{{ asset('img/Logo Zozoland_bg transparent.png') }}" alt="Zozoland logo">
            </a>

            {{-- MENU BUTTONS --}}
            <nav class="nav-links">
                <a href="/testimonials" class="top-btn">Testimoni</a>
                <a href="/promo" class="top-btn">Promo & Event</a>
                <a href="/location" class="top-btn">Lokasi & Jam</a>
                <a href="/menu" class="top-btn">Menu & Harga</a>
                <a href="/about" class="top-btn">Tentang Zozoland</a>
            </nav>
        </div>
    </header>

    {{-- ================= CONTENT ================= --}}
    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

</body>
</html>

