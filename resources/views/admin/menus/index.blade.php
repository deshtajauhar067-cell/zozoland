@extends('admin.layouts.app')

@section('page-title', 'Menu & Harga Management')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="margin: 0; font-size: 28px;">Menu & Harga</h2>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">+ Add New Menu Item</a>
</div>

<div class="card">
    <div class="card-title">All Menu Items</div>

    @if($menus->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama ?? $menu->name }}" style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">
                        @else
                            <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $menu->nama ?? $menu->name }}</strong></td>
                    <td><span class="badge badge-info">{{ $menu->category }}</span></td>
                    <td><strong>Rp {{ number_format($menu->harga ?? $menu->price, 0, ',', '.') }}</strong></td>
                    <td>
                        <span class="badge {{ $menu->is_available ? 'badge-success' : 'badge-danger' }}">
                            {{ $menu->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $menus->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <p style="font-size: 16px; margin-bottom: 15px;">No menu items yet.</p>
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Create Your First Menu Item</a>
        </div>
    @endif
</div>

<style>
    .pagination {
        display: flex;
        gap: 5px;
        justify-content: center;
        padding: 10px 0;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #667eea;
        font-size: 14px;
    }

    .pagination a:hover {
        background: #f8f9fa;
    }

    .pagination .active span {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
</style>
@endsection
