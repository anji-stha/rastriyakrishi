@extends('layout.main')
@include('layout.navbar')
@section('content')
    <!-- FAQs Section -->
    <div class="container mt-5">
        <h2 class="mb-4">Frequently Asked Questions</h2>
        <hr>
        <div class="row">
            @foreach ($faqs as $faq)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <strong>{{ $loop->iteration }}. {{ $faq->question }}</strong>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                {{ $faqs->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
    @include('layout.footer')
@endsection
