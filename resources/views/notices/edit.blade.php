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
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Edit Notice</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('notices.update', $notice) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $notice->title }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $notice->description }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($notice->image)
                            <img src="{{ asset('storage/' . $notice->image) }}" alt="Notice Image" class="mt-2" style="max-width: 100px;">
                        @endif
                    </div>

                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="inactive" {{ $notice->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{ $notice->status == 'active' ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>

                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
