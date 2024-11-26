@extends('layout.main')
@section('content')
    @include('layout.admin.nav')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Notice Details</h2>
                <a href="{{ route('notices.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5><strong>Title:</strong></h5>
                    <p>{{ $notice->title }}</p>
                </div>
                <div class="mb-3">
                    <h5><strong>Description:</strong></h5>
                    <p>{{ $notice->description }}</p>
                </div>
                <div class="mb-3">
                    <h5><strong>Status:</strong></h5>
                    <p class="badge badge-{{ $notice->status === 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($notice->status) }}
                    </p>
                </div>
                <div class="mb-3">
                    <h5><strong>Image:</strong></h5>
                    @if ($notice->image)
                        <img src="{{ asset('storage/' . $notice->image) }}" alt="Notice Image" class="img-fluid"
                            style="max-height: 150px;">
                    @else
                        <p>No Image Uploaded.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
