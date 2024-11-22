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
        <h1>Edit FAQ</h1>
        <form method="POST" action="{{ route('faqs.update', $faq->id) }}">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control"
                            value="{{ old('question', $faq->question) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer" class="form-control" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
