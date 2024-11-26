@extends('layout.main')
@section('content')
    @include('layout.admin.nav')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>Notices Management</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
        </div>
        <hr>
        <a href="{{ route('notices.create') }}" class="btn btn-primary">Create Notice</a>

        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notices as $key => $notice)
                    <tr>
                        <td>{{ $key + 1 + ($notices->currentPage() - 1) * $notices->perPage() }}</td>
                        <td>{{ $notice->title }}</td>
                        <td>{{ Str::limit($notice->description, 50) }}</td>
                        <td>{{ $notice->status }}</td>
                        <td>
                            <a href="{{ route('notices.show', $notice->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('notices.destroy', $notice->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content mt-4">
            <nav aria-label="Page navigation">
                {{ $notices->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
