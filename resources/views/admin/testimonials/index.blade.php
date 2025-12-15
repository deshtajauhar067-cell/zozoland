@extends('admin.layouts.app')

@section('page-title', 'Testimonials & Feedback')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
    <div class="card">
        <div style="font-size: 12px; color: #666;">TOTAL TESTIMONIALS</div>
        <div style="font-size: 28px; font-weight: bold; color: #667eea; margin-top: 10px;">{{ $stats['total'] }}</div>
    </div>
    <div class="card">
        <div style="font-size: 12px; color: #666;">VISIBLE</div>
        <div style="font-size: 28px; font-weight: bold; color: #28a745; margin-top: 10px;">{{ $stats['visible'] }}</div>
    </div>
    <div class="card">
        <div style="font-size: 12px; color: #666;">PENDING REVIEW</div>
        <div style="font-size: 28px; font-weight: bold; color: #ffc107; margin-top: 10px;">{{ $stats['pending'] }}</div>
    </div>
    <div class="card">
        <div style="font-size: 12px; color: #666;">AVG RATING</div>
        <div style="font-size: 28px; font-weight: bold; color: #17a2b8; margin-top: 10px;">{{ $stats['avg_rating'] }} ⭐</div>
    </div>
</div>

<div class="card">
    <div class="card-title">⭐ Testimonials & Reviews</div>

    @if($testimonials->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Message</th>
                    <th>Rating</th>
                    <th>Category</th>
                    <th>Visibility</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>
                        <strong>{{ $testimonial->name ?? 'Anonymous' }}</strong>
                        @if($testimonial->email)
                            <div style="font-size: 12px; color: #666;">{{ $testimonial->email }}</div>
                        @endif
                    </td>
                    <td>{{ Str::limit($testimonial->message, 60) }}</td>
                    <td>
                        <span style="white-space: nowrap;">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <span style="color: #ffc107;">⭐</span>
                            @endfor
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-info">{{ $testimonial->category ?? 'Review' }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $testimonial->is_visible ? 'badge-success' : 'badge-danger' }}">
                            {{ $testimonial->is_visible ? '👁️ Visible' : '🙈 Hidden' }}
                        </span>
                    </td>
                    <td style="font-size: 12px;">{{ $testimonial->created_at->format('M d, Y') }}</td>
                    <td>
                        <form action="{{ route('admin.testimonials.visibility', $testimonial->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $testimonial->is_visible ? 'btn-secondary' : 'btn-success' }}" style="padding: 5px 10px; font-size: 11px;">
                                {{ $testimonial->is_visible ? 'Hide' : 'Show' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 11px;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $testimonials->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <p style="font-size: 16px;">No testimonials submitted yet.</p>
        </div>
    @endif
</div>

<div class="card" style="margin-top: 20px;">
    <div class="card-title">📋 Testimonial Guidelines</div>
    <ul style="line-height: 1.8;">
        <li><strong>Visible:</strong> Testimonials marked as visible will be displayed on the public website.</li>
        <li><strong>Hidden:</strong> Testimonials marked as hidden will not be shown to customers.</li>
        <li><strong>Moderation:</strong> New testimonials are hidden by default. Review and approve them before publishing.</li>
        <li><strong>Categories:</strong> Testimonials can be categorized as Review, Suggestion, Complaint, etc.</li>
        <li><strong>Rating:</strong> Customers can rate from 1 to 5 stars.</li>
    </ul>
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
