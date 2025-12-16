@extends('layouts.main')

@section('content')
<div class="container">
    <h2 style="font-weight:800; margin-bottom:20px;">Kelola Testimoni</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>{{ $t->email }}</td>
                    <td>{{ $t->message }}</td>
                    <td>{{ $t->rating }}/5</td>
                    <td>
                        @if($t->is_visible)
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.testimonials.visibility', $t->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm {{ $t->is_visible ? 'btn-danger' : 'btn-success' }}">
                                {{ $t->is_visible ? 'Unapprove' : 'Approve' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada testimoni</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
