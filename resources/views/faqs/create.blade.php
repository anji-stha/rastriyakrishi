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
        <h1>Add FAQs</h1>
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
            <button type="button" id="add-faq" class="btn btn-secondary mt-2">Add More</button>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
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
