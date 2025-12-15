@extends('layouts.main')

@section('content')


<div class="hero">
    <div class="container">
        <h1 class="text-center" style="font-weight:800; color:var(--pink); margin-bottom:24px;">ZOZOLAND</h1>

        {{-- OUR PROMO (dynamic) --}}
        @if(isset($promos) && $promos->count())
            @foreach($promos as $promo)
                <div class="promo-card">
                    <h3 style="margin:0; font-size:18px;">{{ $promo->title }}</h3>
                    <p style="margin:6px 0 0; font-size:14px;">{{ $promo->description }}</p>
                    @if(!empty($promo->how_to_join))
                        <p style="margin:6px 0 0; font-size:13px; color:#666;">Cara ikut: {{ $promo->how_to_join }}</p>
                    @endif
                    @if($promo->valid_from && $promo->valid_until)
                        <small style="display:block; margin-top:8px; color:#999;">Berlaku: {{ $promo->valid_from->format('Y-m-d') }} — {{ $promo->valid_until->format('Y-m-d') }}</small>
                    @endif
                </div>
            @endforeach
        @else
            <div class="promo-card">Belum ada promo saat ini.</div>
        @endif
    </div>
</div>


{{-- ================= POPUP 1 ================= --}}
<div class="popup-overlay" id="popup-promo1">
    <div class="popup-box">
        <div class="close-btn" onclick="closePopup('promo1')">×</div>

        <h3 style="font-weight:800; margin-bottom:10px;">
            Promo Spesial untuk kamu MABA UB nih~
        </h3>

        <p style="font-size:14px;">
            Nikmati Buy 1 Get 1 scoop ice cream (kecuali varian ZOZOCONE)
            khusus buat kamu mahasiswa baru UB!  
            Rasakan manisnya awal kuliah bareng es krim Zozoland 🍦✨
        </p>
    </div>
</div>


{{-- ================= POPUP 2 ================= --}}
<div class="popup-overlay" id="popup-promo2">
    <div class="popup-box">
        <div class="close-btn" onclick="closePopup('promo2')">×</div>

        <h3 style="font-weight:800;">Cara ikut promo/event</h3>

        <p style="font-size:14px;">
            1. Follow akun Instagram @zozoland.id dan TikTok @zozoland.id <br>
            2. Tunjukkan bukti follow kepada admin <br>
            3. Tunjukkan KTM saat membeli <br>
            4. Nikmati free 1 scoop ice cream! 🍨
        </p>
    </div>
</div>


{{-- ================= POPUP 3 ================= --}}
<div class="popup-overlay" id="popup-promo3">
    <div class="popup-box" style="text-align:center;">
        <div class="close-btn" onclick="closePopup('promo3')">×</div>

        <h2 style="font-weight:900;">COMING SOON!</h2>
        <p style="font-size:14px;">
            Event spesial akan hadir di Zozoland! Stay tuned 🎉
        </p>
    </div>
</div>


{{-- ========== JS FUNCTION UNTUK POPUP ========== --}}
<script>
function openPopup(id) {
    document.getElementById("popup-" + id).style.display = "flex";
}

function closePopup(id) {
    document.getElementById("popup-" + id).style.display = "none";
}
</script>

@endsection
