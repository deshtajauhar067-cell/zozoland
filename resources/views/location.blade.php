@extends('layouts.main')

@section('content')

<div class="hero">
    <div class="container">
        <div style="display:flex; gap:18px; flex-wrap:wrap;">
            <div style="flex:1; min-width:220px; background:#ffd6f3; padding:14px 18px; border-radius:12px; font-weight:700; border:2px solid #ffbada; text-align:center;">Alamat: Creative Land (CL) Universitas Brawijaya lantai 2</div>

            <div style="flex:1; min-width:220px; background:#ffd6f3; padding:14px 18px; border-radius:12px; font-weight:700; border:2px solid #ffbada; text-align:center;">Jam buka & tutup: <span style="color:var(--pink);">{{ $jam_operasional ?? 'Belum diatur' }}</span></div>
        </div>

        <div class="card" style="margin-top:20px; max-width:900px; margin-left:auto; margin-right:auto;">
            <img src="{{ asset('img/toko.jpg') }}" style="width:100%; border-radius:12px; object-fit:cover;">
        </div>
    </div>
</div>

@endsection
