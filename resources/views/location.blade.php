@extends('layouts.main')

@section('content')
<div class="hero">
    <div class="container">

        {{-- INFO UTAMA --}}
        <div style="display:flex; gap:18px; flex-wrap:wrap; margin-bottom:20px;">

            {{-- STATUS --}}
            <div style="flex:1; min-width:220px; background:#e6fffa; padding:14px 18px; border-radius:12px; font-weight:700; border:2px solid #38b2ac; text-align:center;">
                Status Toko:
                <div style="margin-top:6px;">
                    {{ $is_open ? '🟢 Buka Sekarang' : '🔴 Tutup' }}
                </div>
            </div>

            {{-- ALAMAT --}}
            <div style="flex:1; min-width:220px; background:#ffd6f3; padding:14px 18px; border-radius:12px; font-weight:700; border:2px solid #ffbada; text-align:center;">
                Alamat:
                <div style="margin-top:6px;">
                    {{ $quick_address ?? 'Belum diatur' }}
                </div>
            </div>

            {{-- JAM --}}
            <div style="flex:1; min-width:220px; background:#fff5d6; padding:14px 18px; border-radius:12px; font-weight:700; border:2px solid #f6c453; text-align:center;">
                Jam Operasional:
                <div style="margin-top:6px;">
                    {{ $jam_operasional ?? 'Belum diatur' }}
                </div>
            </div>

          @if($maps)
<div style="margin-top:20px;">
    <iframe
        src="{{ $maps }}"
        width="100%"
        height="300"
        style="border:0; border-radius:12px;"
        allowfullscreen
        loading="lazy">
    </iframe>
</div>
@endif

            

        </div>

       {{-- GAMBAR TOKO --}}
<div class="card" style="max-width:900px; margin:auto;">
    <img 
        src="{{ $store_image ? asset('storage/'.$store_image) : asset('img/toko.jpg') }}"
        style="width:100%; border-radius:12px; object-fit:cover;"
    >
</div>


        {{-- GOOGLE MAPS --}}
@if($maps)
    <div style="margin-top:30px; border-radius:12px; overflow:hidden;">
        <iframe 
            src="{{ $maps }}"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endif


    </div>
</div>
@endsection
