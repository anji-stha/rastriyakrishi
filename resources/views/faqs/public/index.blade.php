@extends('layout.main')

@section('content')
    <!-- Header Section -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" alt="Logo" />
            </div>
            <div class="col-md-8 text-right pt-1">
                <a href="https://rastriyakrishi.com.np/" style="color:#F57921;">
                    <i class="bi bi-arrow-left-circle"></i> Go to Homepage
                </a>
            </div>
        </div>
    </div>

    <!-- FAQs Section -->
    <div class="container mt-5">
        <h1 class="mb-4">Frequently Asked Questions</h1>
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

    {{-- footer --}}
    <div class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>राष्ट्रिय कृषि कम्पनी नेपाल लि.</h5>
                    <p>हामी नेपालको कृषि क्षेत्रको विकासमा समर्पित छौं।</p>
                </div>
                <div class="col-md-4">
                    <h5>सम्पर्क</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> काठमाडौं, नेपाल<br>
                        <i class="fas fa-phone"></i> +977-1-5970017<br>
                        <i class="fas fa-envelope"></i> info@rastriyakrishi.com.np
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>उपयोगी लिंकहरू</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">गोपनीयता नीति</a></li>
                        <li><a href="#">सेवाका सर्तहरू</a></li>
                        <li><a href="#">रोजगारी</a></li>
                        <li><a href="#">सहायता केन्द्र</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <small>&copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> राष्ट्रिय कृषि कम्पनी नेपाल लि. सर्वाधिकार सुरक्षित।
                </small>
            </div>
        </div>
    </div>
@endsection
