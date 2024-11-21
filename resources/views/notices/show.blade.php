@extends('layout.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
            </div>

            <div class="col-md-8 text-right pt-1">
                <a href="javascript:void(0);" onclick="window.history.back();" style="color:#F57921;">
                    <i class="bi bi-arrow-left-circle"></i> Go Back
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Notice Details</h2>
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
