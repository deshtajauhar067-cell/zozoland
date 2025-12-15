@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Stats Cards -->
    <div class="card">
        <div style="font-size: 32px; margin-bottom: 10px;">📋</div>
        <div style="font-size: 12px; color: #666; margin-bottom: 5px;">TOTAL MENU ITEMS</div>
        <div style="font-size: 28px; font-weight: bold; color: #667eea;">{{ $stats['total_menus'] }}</div>
    </div>

    <div class="card">
        <div style="font-size: 32px; margin-bottom: 10px;">🎉</div>
        <div style="font-size: 12px; color: #666; margin-bottom: 5px;">ACTIVE PROMOS</div>
        <div style="font-size: 28px; font-weight: bold; color: #28a745;">{{ $stats['active_promos'] }} / {{ $stats['total_promos'] }}</div>
    </div>

    <div class="card">
        <div style="font-size: 32px; margin-bottom: 10px;">⭐</div>
        <div style="font-size: 12px; color: #666; margin-bottom: 5px;">TESTIMONIALS</div>
        <div style="font-size: 28px; font-weight: bold; color: #ffc107;">{{ $stats['visible_testimonials'] }} / {{ $stats['total_testimonials'] }}</div>
    </div>

    <div class="card">
        <div style="font-size: 32px; margin-bottom: 10px;">{{ $quick_access['is_open'] ? '🟢' : '🔴' }}</div>
        <div style="font-size: 12px; color: #666; margin-bottom: 5px;">STORE STATUS</div>
        <div style="font-size: 18px; font-weight: bold; color: {{ $quick_access['is_open'] ? '#28a745' : '#dc3545' }};">
            {{ $quick_access['is_open'] ? 'OPEN' : 'CLOSED' }}
        </div>
    </div>
</div>

<!-- Quick Access Configuration -->
<div class="card">
    <div class="card-title">⚡ Quick Access Configuration</div>
    <form action="{{ route('admin.quick-access.update') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="is_open">
                    <input type="checkbox" id="is_open" name="is_open" value="1" {{ $quick_access['is_open'] ? 'checked' : '' }}>
                    Store is Open Now
                </label>
                <small style="display: block; margin-top: 5px; color: #666;">Toggle real-time store status</small>
            </div>

            <div class="form-group">
                <label for="quick_address">Quick Address</label>
                <input type="text" id="quick_address" name="quick_address" class="form-control" value="{{ $quick_access['quick_address'] }}" required>
            </div>

            @if($featured_promo)
            <div class="form-group">
                <label for="featured_promo_id">Featured Promo</label>
                <select id="featured_promo_id" name="featured_promo_id" class="form-control">
                    <option value="">-- Select Promo --</option>
                    @foreach(\App\Models\Promo::where('is_active', true)->get() as $promo)
                        <option value="{{ $promo->id }}" {{ $featured_promo->id == $promo->id ? 'selected' : '' }}>
                            {{ $promo->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="grid-column: 1 / -1;">
                @if($featured_promo)
                <div style="background: #f8f9fa; padding: 15px; border-radius: 4px; margin-top: 10px;">
                    <strong>Featured Promo:</strong> {{ $featured_promo->title }} (Valid until {{ $featured_promo->valid_until->format('Y-m-d') }})
                </div>
                @endif
            </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Update Quick Access</button>
    </form>
</div>

<!-- Recent Testimonials -->
<div class="card">
    <div class="card-title">⭐ Recent Testimonials</div>
    @if($recent_testimonials->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent_testimonials as $testimonial)
                <tr>
                    <td><strong>{{ $testimonial->name ?? 'Anonymous' }}</strong></td>
                    <td>{{ Str::limit($testimonial->message, 50) }}</td>
                    <td>
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            ⭐
                        @endfor
                    </td>
                    <td>
                        <span class="badge {{ $testimonial->is_visible ? 'badge-success' : 'badge-danger' }}">
                            {{ $testimonial->is_visible ? 'Visible' : 'Hidden' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 15px;">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">View All Testimonials</a>
        </div>
    @else
        <p style="color: #666; text-align: center; padding: 20px;">No testimonials yet.</p>
    @endif
</div>

<!-- Quick Links -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
    <div style="background: #e7f3ff; padding: 20px; border-radius: 8px; text-align: center;">
        <div style="font-size: 24px; margin-bottom: 10px;">📋</div>
        <div style="margin-bottom: 15px;">
            <strong>Menu Management</strong>
            <p style="font-size: 12px; color: #666; margin: 5px 0;">Add, edit, or delete menu items</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-primary">Go to Menu</a>
    </div>

    <div style="background: #fff3e0; padding: 20px; border-radius: 8px; text-align: center;">
        <div style="font-size: 24px; margin-bottom: 10px;">🎉</div>
        <div style="margin-bottom: 15px;">
            <strong>Promo Management</strong>
            <p style="font-size: 12px; color: #666; margin: 5px 0;">Create and manage promotions</p>
        </div>
        <a href="{{ route('admin.promos.index') }}" class="btn btn-primary">Go to Promo</a>
    </div>

    <div style="background: #f0f7ff; padding: 20px; border-radius: 8px; text-align: center;">
        <div style="font-size: 24px; margin-bottom: 10px;">📍</div>
        <div style="margin-bottom: 15px;">
            <strong>Settings</strong>
            <p style="font-size: 12px; color: #666; margin: 5px 0;">Update location and hours</p>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">Go to Settings</a>
    </div>
</div>

@endsection
