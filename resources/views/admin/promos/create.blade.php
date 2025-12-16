@extends('admin.layouts.app')

@section('page-title', 'Create New Promo')

@section('content')
<div class="card">
    <div class="card-title">Create New Promo/Event</div>

    <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="title">Promo Title *</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g., Birthday Special 50% Off" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category *</label>
                <input type="text" id="category" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="e.g., Birthday Special, UTBK Event" required>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="valid_from">Valid From *</label>
                <input type="date" id="valid_from" name="valid_from" class="form-control @error('valid_from') is-invalid @enderror" value="{{ old('valid_from') }}" required>
                @error('valid_from')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="valid_until">Valid Until *</label>
                <input type="date" id="valid_until" name="valid_until" class="form-control @error('valid_until') is-invalid @enderror" value="{{ old('valid_until') }}" required>
                @error('valid_until')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_active">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    Promo is Active
                </label>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="description">Description *</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Describe the promo details" required>{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="how_to_join">How to Join (Cara Ikut) *</label>
                <textarea id="how_to_join" name="how_to_join" class="form-control @error('how_to_join') is-invalid @enderror" rows="4" placeholder="Provide step-by-step instructions" required>{{ old('how_to_join') }}</textarea>
                @error('how_to_join')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="image">Promo Image *</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                <small style="display: block; margin-top: 5px; color: #666;">Accepted formats: JPEG, PNG, JPG, GIF. Max 2MB</small>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">Create Promo</button>
            <a href="{{ route('admin.promos.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
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
