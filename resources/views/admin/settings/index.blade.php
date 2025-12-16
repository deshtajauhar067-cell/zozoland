@extends('admin.layouts.app')

@section('page-title', 'Location & Operating Hours')

@section('content')
<div class="card">
    <div class="card-title">📍 Business Location & Operating Hours</div>

<<<<<<< HEAD
    <form action="{{ route('admin.settings.update') }}" method="POST">
=======
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
        @csrf

        <!-- General Business Information -->
        <div style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 2px solid #f0f0f0;">
            <h3 style="margin-bottom: 20px; font-size: 18px; color: #333;">Business Information</h3>

<<<<<<< HEAD
=======
            <div class="form-group" style="grid-column: 1 / -1;">
    <label>Store Image</label>
    <input type="file" name="store_image" class="form-control">
    
    @if($settings['store_image'] ?? false)
        <img src="{{ asset('storage/'.$settings['store_image']) }}"
             style="margin-top:10px; max-height:150px; border-radius:10px;">
    @endif
</div>

>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="business_name">Business Name *</label>
                    <input type="text" id="business_name" name="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name', $settings['business_name']) }}" required>
                    @error('business_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="business_phone">Business Phone *</label>
                    <input type="tel" id="business_phone" name="business_phone" class="form-control @error('business_phone') is-invalid @enderror" value="{{ old('business_phone', $settings['business_phone']) }}" required>
                    @error('business_phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="business_address">Full Business Address *</label>
                    <textarea id="business_address" name="business_address" class="form-control @error('business_address') is-invalid @enderror" rows="3" required>{{ old('business_address', $settings['business_address']) }}</textarea>
                    @error('business_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="google_maps_link">Google Maps Link *</label>
                    <input type="url" id="google_maps_link" name="google_maps_link" class="form-control @error('google_maps_link') is-invalid @enderror" value="{{ old('google_maps_link', $settings['google_maps_link']) }}" placeholder="https://maps.google.com/..." required>
                    <small style="display: block; margin-top: 5px; color: #666;">Paste your Google Maps location URL</small>
                    @error('google_maps_link')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Default Operating Hours -->
        <div style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 2px solid #f0f0f0;">
            <h3 style="margin-bottom: 20px; font-size: 18px; color: #333;">Default Operating Hours</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="opening_time">Opening Time (All Days) *</label>
                    <input type="time" id="opening_time" name="opening_time" class="form-control @error('opening_time') is-invalid @enderror" value="{{ old('opening_time', $settings['opening_time']) }}" required>
                    @error('opening_time')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="closing_time">Closing Time (All Days) *</label>
                    <input type="time" id="closing_time" name="closing_time" class="form-control @error('closing_time') is-invalid @enderror" value="{{ old('closing_time', $settings['closing_time']) }}" required>
                    @error('closing_time')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Day-Specific Hours -->
        <div style="margin-bottom: 30px;">
            <h3 style="margin-bottom: 20px; font-size: 18px; color: #333;">Day-Specific Operating Hours</h3>

            @php
                $days = [
                    'monday' => 'Monday',
                    'tuesday' => 'Tuesday',
                    'wednesday' => 'Wednesday',
                    'thursday' => 'Thursday',
                    'friday' => 'Friday',
                    'saturday' => 'Saturday',
                    'sunday' => 'Sunday',
                ];
            @endphp

            @foreach($days as $dayKey => $dayName)
            <div style="background: #f8f9fa; padding: 20px; border-radius: 6px; margin-bottom: 15px;">
                <div style="display: grid; grid-template-columns: auto 1fr 1fr 1fr; gap: 15px; align-items: center;">
                    <div>
                        <label for="is_open_{{ $dayKey }}">
                            <input type="checkbox" id="is_open_{{ $dayKey }}" name="is_open_{{ $dayKey }}" value="1" {{ old('is_open_' . $dayKey, $settings['is_open_' . $dayKey]) ? 'checked' : '' }}>
                            <strong>{{ $dayName }}</strong>
                        </label>
                    </div>

                    <div class="form-group" style="margin: 0;">
                        <input type="time" name="{{ $dayKey }}_open" class="form-control @error($dayKey . '_open') is-invalid @enderror" value="{{ old($dayKey . '_open', $settings[$dayKey . '_open']) }}" required>
                    </div>

                    <div style="text-align: center; font-weight: bold;">to</div>

                    <div class="form-group" style="margin: 0;">
                        <input type="time" name="{{ $dayKey }}_close" class="form-control @error($dayKey . '_close') is-invalid @enderror" value="{{ old($dayKey . '_close', $settings[$dayKey . '_close']) }}" required>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px; padding-top: 20px; border-top: 2px solid #f0f0f0;">
            <button type="submit" class="btn btn-primary">Save All Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </form>
</div>

<!-- Info Card -->
<div class="card" style="background: #e7f3ff; border-left: 4px solid #667eea; margin-top: 20px;">
    <div style="color: #0066cc;">
        <strong>💡 Tip:</strong> These settings are used throughout the application to display your business information to customers. Make sure they are accurate and up-to-date.
    </div>
</div>

<style>
    .is-invalid {
        border-color: #dc3545 !important;
    }

    .text-danger {
        color: #dc3545;
    }
</style>
@endsection
