@extends('admin.layouts.app')

@section('page-title', 'Add New Menu Item')

@section('content')
<div class="card">
    <div class="card-title">Add New Menu Item</div>

    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="nama">Menu Name *</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category *</label>
                <input type="text" id="category" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="e.g., Main Course, Appetizer" required>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Price (Rp) *</label>
                <input type="number" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" step="0.01" min="0" required>
                @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_available">
                    <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available') ? 'checked' : '' }}>
                    Item is Available
                </label>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="description">Description *</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="image">Item Image *</label>
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                <small style="display: block; margin-top: 5px; color: #666;">Accepted formats: JPEG, PNG, JPG, GIF. Max 2MB</small>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">Create Menu Item</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
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
