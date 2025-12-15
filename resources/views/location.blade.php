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

        </div>

        {{-- GAMBAR TOKO --}}
        <div class="card" style="max-width:900px; margin-left:auto; margin-right:auto;">
            <img src="{{ asset('img/toko.jpg') }}" style="width:100%; border-radius:12px; object-fit:cover;">
        </div>

    </div>
</div>
@endsection
