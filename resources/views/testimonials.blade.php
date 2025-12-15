@extends('layouts.main')

@section('content')


<div class="hero">
    <div class="container">
        <h1 class="text-center" style="font-weight:800; color:#444; margin-bottom:18px;">ZOZOLAND</h1>

        <div style="display:flex; gap:12px; justify-content:center; margin-bottom:22px; flex-wrap:wrap;">
        <div class="header-btn" onclick="openTesti('form1')">Form testimoni pelanggan</div>
        </div>


        <h2 class="text-center" style="font-weight:800; margin-bottom:16px;">Kesan Pelanggan Kami</h2>

        <div class="testimonial-slideshow" style="max-width:900px; margin:0 auto; position:relative;">
            <style>
                .testimonial-slideshow .slides { position:relative; min-height:160px; overflow:hidden; }
                .testimonial-slideshow .slides-inner { display:block; transition:transform .6s ease; }
                .testimonial-slideshow .slide { position:absolute; left:0; top:0; width:100%; opacity:0; transition:opacity .6s ease; pointer-events:none; }
                .testimonial-slideshow .slide.active { opacity:1; pointer-events:auto; }
                .testimonial-slideshow.use-slide .slides-inner { display:flex; transform:translateX(0); }
                .testimonial-slideshow.use-slide .slide { position:relative; opacity:1; pointer-events:auto; width:100%; flex:0 0 100%; }
                .testimonial-slideshow .prev, .testimonial-slideshow .next { background:transparent; }
            </style>
            <div class="slides">
                <div class="slides-inner">
                @if(isset($testimonials) && $testimonials->count())
                    @foreach($testimonials as $t)
                        <div class="slide" data-id="{{ $t->id }}" style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.06);">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
                                <div style="width:48px; height:48px; border-radius:50%; background:#f0f0f0; display:flex; align-items:center; justify-content:center; font-weight:700; color:#444;">{{ strtoupper(substr($t->name ?? 'A',0,1)) }}</div>
                                <div>
                                    <strong>{{ $t->name ?? 'Anonymous' }}</strong>
                                    <div style="font-size:12px; color:#888;">{{ $t->created_at->format('Y-m-d') }}</div>
                                </div>
                            </div>
                            <p style="color:#333; margin:8px 0 12px;">{{ $t->message }}</p>
                            <div class="stars" style="margin-top:6px;">
                                @for($i=1; $i<=5; $i++)
                                    <span style="font-size:18px; color: {{ $i <= ($t->rating ?? 0) ? '#FFD166' : '#e0e0e0' }};">★</span>
                                @endfor
                                <span style="color:#666; margin-left:8px; font-size:14px;">{{ $t->rating ?? '—' }}/5</span>
                            </div>
                            @if(auth()->check() && auth()->user()->is_admin)
                                <div style="margin-top:10px;">
                                    <button class="admin-visibility btn" data-id="{{ $t->id }}">{{ $t->is_visible ? 'Unapprove' : 'Approve' }}</button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center;color:#666; padding:20px;">Belum ada testimoni.</div>
                @endif
                </div>
            </div>

            <button class="prev" aria-label="Previous" style="position:absolute; left:0; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.05); border:none; padding:10px 14px; border-radius:6px; cursor:pointer;">‹</button>
            <button class="next" aria-label="Next" style="position:absolute; right:0; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.05); border:none; padding:10px 14px; border-radius:6px; cursor:pointer;">›</button>

            <div class="dots" style="text-align:center; margin-top:12px;"></div>
        </div>
    </div>
</div>


{{-- ========== POPUP 1 ========== --}}
<div class="popup-overlay" id="popup-form1">
    <div class="popup-box">
        <div class="close-btn" onclick="closeTesti('form1')">×</div>

        <h3 style="font-weight:800; margin-bottom:10px;">Form Testimoni Pelanggan</h3>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; border-radius:6px; margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('testimonials.store') }}" method="POST">
            @csrf

            <div style="display:flex; gap:10px; margin-bottom:10px;">
                <div style="flex:1;">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')<small style="color:#dc3545">{{ $message }}</small>@enderror
                </div>
                <div style="flex:1;">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')<small style="color:#dc3545">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="margin-bottom:10px;">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                @error('message')<small style="color:#dc3545">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom:10px;">
                <label for="rating">Rating</label>
                <div class="star-picker" style="margin-top:6px;">
                    @for($i=5; $i>=1; $i--)
                        <input type="radio" id="star-{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == (string)$i ? 'checked' : '' }}>
                        <label for="star-{{ $i }}" title="{{ $i }} star">☆</label>
                    @endfor
                    @error('rating')<small style="color:#dc3545; display:block; margin-top:6px;">{{ $message }}</small>@enderror
                </div>
                <style>
                    .star-picker { direction: rtl; display: inline-block; }
                    .star-picker input { display: none; }
                    .star-picker label { font-size: 24px; color: #e0e0e0; cursor: pointer; padding: 0 4px; }
                    .star-picker input:checked ~ label,
                    .star-picker label:hover,
                    .star-picker label:hover ~ label { color: #FFD166 !important; }
                    .star-picker input:checked + label { color: #FFD166; }
                    /* Fancy stars when enabled */
                    body.fancy-stars .star-picker label { transition: transform .15s ease, color .15s ease; }
                    body.fancy-stars .star-picker label:hover { transform: scale(1.2); color: #FFD166; }
                    body.fancy-stars .star-picker input:checked + label { transform: scale(1.2); color: #FFD166; }
                </style>
            </div>

            <div style="display:flex; gap:8px; justify-content:flex-end; margin-top:8px;">
                <button type="submit" class="btn btn-primary">Submit Testimonial</button>
                <button type="button" class="btn btn-secondary" onclick="closeTesti('form1')">Cancel</button>
            </div>
        </form>
    </div>
</div>

{{-- ====== JS ====== --}}
<script>
function openTesti(id) {
    document.getElementById("popup-" + id).style.display = "flex";
}

function closeTesti(id) {
    document.getElementById("popup-" + id).style.display = "none";
}
</script>

<script>
// Slideshow logic for testimonials
document.addEventListener('DOMContentLoaded', function () {
    const slideshow = document.querySelector('.testimonial-slideshow');
    const slidesInner = document.querySelector('.testimonial-slideshow .slides-inner');
    const slides = Array.from(document.querySelectorAll('.testimonial-slideshow .slide'));
    const prevBtn = document.querySelector('.testimonial-slideshow .prev');
    const nextBtn = document.querySelector('.testimonial-slideshow .next');
    const dotsContainer = document.querySelector('.testimonial-slideshow .dots');
    let current = 0;
    let timer = null;

    let animationMode = 'fade'; // or 'slide'

    function showSlide(idx) {
        if (!slides.length) return;
        if (animationMode === 'fade') {
            slides.forEach((s, i) => s.classList.toggle('active', i === idx));
        } else {
            // slide mode: translate slidesInner
            if (slidesInner) {
                slidesInner.style.transform = `translateX(-${idx * 100}%)`;
            }
        }
        // update dots
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.style.margin = '0 4px';
            dot.style.width = '10px';
            dot.style.height = '10px';
            dot.style.borderRadius = '50%';
            dot.style.border = 'none';
            dot.style.cursor = 'pointer';
            dot.style.background = i === idx ? '#667eea' : '#e0e0e0';
            dot.addEventListener('click', () => {
                current = i; resetTimer(); showSlide(current);
            });
            dotsContainer.appendChild(dot);
        });
    }

    function prev() { current = (current - 1 + slides.length) % slides.length; showSlide(current); resetTimer(); }
    function next() { current = (current + 1) % slides.length; showSlide(current); resetTimer(); }

    // Option toggles
    const toggleAnimationBtn = document.getElementById('toggle-animation');
    const toggleStarsBtn = document.getElementById('toggle-stars');
    const toggleAdminBtn = document.getElementById('toggle-admin-controls');

    if (toggleAnimationBtn) {
        toggleAnimationBtn.addEventListener('click', () => {
            animationMode = animationMode === 'fade' ? 'slide' : 'fade';
            slideshow.classList.toggle('use-slide', animationMode === 'slide');
            toggleAnimationBtn.textContent = animationMode === 'slide' ? 'Use Fade Animation' : 'Use Slide Animation';
            // ensure layout for slide mode
            if (animationMode === 'slide' && slidesInner) {
                slidesInner.style.width = `${slides.length * 100}%`;
                slides.forEach(s => s.style.width = `${100 / slides.length}%`);
                slidesInner.style.transition = 'transform .6s ease';
            } else if (slidesInner) {
                slidesInner.style.transform = '';
                slides.forEach(s => s.style.width = '100%');
            }
            showSlide(current);
        });
    }

    if (toggleStarsBtn) {
        toggleStarsBtn.addEventListener('click', () => {
            document.body.classList.toggle('fancy-stars');
            toggleStarsBtn.textContent = document.body.classList.contains('fancy-stars') ? 'Fancy Stars: On' : 'Fancy Stars';
        });
    }

    // hide admin buttons by default
    document.querySelectorAll('.admin-visibility').forEach(btn => btn.style.display = 'none');
    if (toggleAdminBtn) {
        toggleAdminBtn.addEventListener('click', () => {
            const on = toggleAdminBtn.textContent.includes('Off');
            toggleAdminBtn.textContent = `Admin Controls: ${on ? 'On' : 'Off'}`;
            document.querySelectorAll('.admin-visibility').forEach(btn => btn.style.display = on ? 'inline-block' : 'none');
        });
    }

    function resetTimer() {
        if (timer) clearInterval(timer);
        timer = setInterval(() => { next(); }, 5000);
    }

    if (prevBtn) prevBtn.addEventListener('click', prev);
    if (nextBtn) nextBtn.addEventListener('click', next);

    // Pause on hover
    const container = document.querySelector('.testimonial-slideshow');
    if (container) {
        container.addEventListener('mouseenter', () => { if (timer) clearInterval(timer); });
        container.addEventListener('mouseleave', () => { resetTimer(); });
    }

    showSlide(current);
    resetTimer();

    // Admin approve/unapprove actions (AJAX)
    document.querySelectorAll('.admin-visibility').forEach(button => {
        button.addEventListener('click', function (e) {
            const id = this.getAttribute('data-id');
            if (!id) return;
            if (!confirm('Toggle visibility for this testimonial?')) return;
            fetch(`/admin/testimonials/${id}/visibility`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(r => {
                if (r.ok) return r.json().catch(() => ({}));
                throw new Error('Request failed');
            }).then(data => {
                // remove slide from DOM or update button text
                // For simplicity, remove the slide so it disappears from public view
                const slide = document.querySelector(`.slide[data-id="${id}"]`);
                if (slide) slide.remove();
            }).catch(err => {
                alert('Failed to toggle visibility. Make sure you are logged in as admin.');
            });
        });
    });
});
</script>

@endsection
