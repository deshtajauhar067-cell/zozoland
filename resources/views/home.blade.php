@extends('layouts.main')

@section('content')

<div class="hero">

     {{-- QUICK ACCESS --}}
    <div class="container" style="text-align:center; margin-top:6px;">
        <div style="display:flex; gap:12px; justify-content:center;">
            <div class="quick-btn">Quick Access</div>
            <div class="quick-btn">Quick Access</div>
            <div class="quick-btn">Quick Access</div>
        </div>

        {{-- JUDUL --}}
        <div class="text-center" style="margin-top:18px;">
            <h1 style="font-size:32px; font-weight:700; color:#333;">
                Nikmati manisnya setiap gigitan di Zozoland
            </h1>
        </div>
    </div>

    {{-- 2 COLUMN IMAGE ROW --}}
    <div class="container" style="display:flex; gap:30px; margin-top:40px; flex-wrap:wrap;">
        <div class="big-box" style="flex:1; text-align:center; min-width:180px;">
            <img src="{{ asset('img/Wafflove.png') }}" style="width:100%; max-width: 250px;">
        </div>
        <div class="big-box" style="flex:1; text-align:center; min-width:180px;">
            <img src="{{ asset('img/cone.png') }}" style="width:100%; max-width: 200px;">
        </div>
        <div class="big-box" style="flex:1; text-align:center; min-width:180px;">
            <img src="{{ asset('img/Chillabun.png') }}" style="width:100%; max-width: 250px;">
        </div>
        <div class="big-box" style="flex:1; text-align:center; min-width:180px;">
            <img src="{{ asset('img/Brownice.png') }}" style="width:100%; max-width: 200px;">
        </div>
    </div>

</div>

{{-- FOOTER --}}
<div class="footer-box">
    <div class="container" style="display:flex; justify-content: space-between; padding: 10px 0; flex-wrap:wrap; gap:18px;">
        <div style="flex:1; min-width:220px;">
            <h3>Alamat</h3>
            <p>📍 Universitas Brawijaya | CREATIVE LAND (LANTAI 2)</p>
        </div>

        <div style="flex:1; min-width:220px; text-align:right;">
            <h3>Our Social Media</h3>
            <p>📸 @zozoland.id &nbsp; 🎵 @zozoland.id</p>
        </div>
    </div>
</div>

@endsection




