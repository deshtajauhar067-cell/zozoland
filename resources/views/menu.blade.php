@extends('layouts.main')

@section('content')

{{-- styles moved to public/style.css (menu-specific classes) --}}

<div class="menu-bg">

    {{-- CONE BESAR --}}
    <img src="{{ asset('img/cone.png') }}" class="big-cone-bg" alt="cone-bg">

    {{-- TITLE --}}
    <h1 class="menu-title">ZOZOLAND MENU</h1>

    {{-- LIST MENU --}}
    <div class="menu-grid">
        @forelse($menus as $menu)
            <div class="menu-left">
                @if(!empty($menu->image) && file_exists(public_path('storage/' . $menu->image)))
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama ?? $menu->name }}">
                @else
                    <img src="{{ asset('img/cone.png') }}" alt="{{ $menu->nama ?? $menu->name }}">
                @endif
                <div class="menu-left-box">{{ $menu->nama ?? $menu->name }}</div>
            </div>
            <div class="menu-price">Rp {{ number_format($menu->harga ?? $menu->price, 0, ',', '.') }}</div>
        @empty
            <div style="grid-column: 1 / -1; text-align:center; padding:40px; color:#666;">
                Tidak ada menu tersedia.
            </div>
        @endforelse
    </div>

    {{-- ADDITION --}}
    <h2 class="text-center" style="margin-top:70px; font-weight:800; color:#444;">Addition</h2>

    <div class="addition-box">
        <div style="display:flex; justify-content:space-between;">
            <span>+1 scoop ice cream</span>
            <span>12k</span>
        </div>
        <div style="display:flex; justify-content:space-between; margin-top:12px;">
            <span>Cookies</span>
            <span>2k</span>
        </div>
    </div>

</div>

@endsection
