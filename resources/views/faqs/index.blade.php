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
        <div class="row">
            <div class="col-md-12">
                <h2>FAQs Management</h2>
                <hr>
            </div>
        </div>
        <a href="{{ route('faqs.create') }}" class="btn btn-primary mb-3">Add FAQ</a>

        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $key => $faq)
                    <tr>
                        <td>{{ $key + 1 + ($faqs->currentPage() - 1) * $faqs->perPage() }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <a href="{{ route('faqs.edit', $faq) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('faqs.destroy', $faq) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content mt-4">
            <nav aria-label="Page navigation">
                {{ $faqs->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
