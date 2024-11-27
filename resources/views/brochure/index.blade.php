@extends('layout.main')

@section('content')
    @include('layout.admin.nav')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Uploaded Brochures</h2>
                <a href="{{ route('brochure.upload.form') }}" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Brochure
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (!empty($files) && count($files) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Brochure Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $index => $file)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ basename($file) }}</td>
                                    <td>
                                        <a href="{{ route('brochure.view', basename($file)) }}" class="btn btn-info btn-sm"
                                            target="_blank">View</a>
                                        <a href="{{ route('brochure.download', basename($file)) }}"
                                            class="btn btn-success btn-sm">Download</a>
                                        <form action="{{ route('brochure.delete', basename($file)) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this brochure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No brochures uploaded yet.</p>
                @endif

            </div>
        </div>
    </div>
@endsection
