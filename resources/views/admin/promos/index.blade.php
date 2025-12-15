@extends('admin.layouts.app')

@section('page-title', 'Promo & Event Management')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h2 style="margin: 0; font-size: 28px;">Promo & Event</h2>
    <a href="{{ route('admin.promos.create') }}" class="btn btn-primary">+ Add New Promo</a>
</div>

<div class="card">
    <div class="card-title">All Promos & Events</div>

    @if($promos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Valid Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promos as $promo)
                <tr>
                    <td>
                        @if($promo->image)
                            <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}" style="width: 50px; height: 50px; border-radius: 4px; object-fit: cover;">
                        @else
                            <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $promo->title }}</strong></td>
                    <td><span class="badge badge-info">{{ $promo->category }}</span></td>
                    <td style="font-size: 12px;">
                        {{ $promo->valid_from->format('M d, Y') }} - {{ $promo->valid_until->format('M d, Y') }}
                        @if(\Carbon\Carbon::now() > $promo->valid_until)
                            <div style="color: #dc3545; font-weight: bold;">Expired</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $promo->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $promo->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.promos.edit', $promo->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                        <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
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
            {{ $promos->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <p style="font-size: 16px; margin-bottom: 15px;">No promos yet.</p>
            <a href="{{ route('admin.promos.create') }}" class="btn btn-primary">Create Your First Promo</a>
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
