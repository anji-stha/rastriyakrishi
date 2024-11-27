<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
    <div class="container">
        <div class="col-md-4">
            <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('brochure.index') }}">Brochure</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notices.index') }}">Notices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs.index') }}">FAQs</a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link active">Hello, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-success nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="https://rastriyakrishi.com.np/" style="color:#F57921;">
                        <i class="bi bi-arrow-left-circle"></i> Go to Homepage
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
