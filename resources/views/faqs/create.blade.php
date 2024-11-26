@extends('layout.main')

@section('content')
    @include('layout.admin.nav')

    <div class="container mt-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Add FAQs</h2>
            <a href="{{ route('faqs.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>

        <form method="POST" action="{{ route('faqs.store') }}">
            @csrf
            <div id="faq-fields">
                <div class="card mb-3 faq-item">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" name="questions[]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <textarea name="answers[]" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" id="add-faq" class="btn btn-secondary mt-2">
                    <i class="bi bi-plus-circle"></i> Add More
                </button>
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="bi bi-check-circle"></i> Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-faq').addEventListener('click', function() {
            const faqFields = document.getElementById('faq-fields');
            const faqItem = document.querySelector('.faq-item').cloneNode(true);
            faqItem.querySelectorAll('input, textarea').forEach(field => field.value = '');
            faqFields.appendChild(faqItem);
        });
    </script>
@endsection
