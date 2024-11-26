@extends('layout.main')

@section('content')
    @include('layout.admin.nav')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Edit FAQs</h2>
            <a href="{{ route('faqs.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>

        <form method="POST" action="{{ route('faqs.update', $faq->id) }}">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" id="question" name="question" class="form-control"
                            value="{{ old('question', $faq->question) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea id="answer" name="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
