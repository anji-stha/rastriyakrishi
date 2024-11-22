@extends('layout.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
            </div>

            <div class="col-md-8 text-right pt-1">
                <a href="https://rastriyakrishi.com.np/" style="color:#F57921; "><i class="bi bi-arrow-left-circle"></i> Go to
                    Homepage</a>
                @auth
                    <ul class="list-unstyled d-inline-flex align-items-center mb-0 ml-3">
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
                    </ul>
                @endauth
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#" id="load-existing" data-url="{{ route('admin.existingusers') }}"
                            class="btn btn-success" data-heading="Existing Users">Existing
                            Data</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" id="load-new" data-url="{{ route('admin.newusers') }}" class="btn btn-success"
                            data-heading="New Users">New Registration
                            Data</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('notices.index') }}" id="load-notice" class="btn btn-info">
                            Notices List
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('faqs.index') }}" id="load-faqs" class="btn btn-info">
                            FAQs List
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <section class="col-md-10">
                <div id="content-area">
                    <h2>Welcome to Dashboard</h2>
                    <p>Select a category from the sidebar to view the details.</p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadContent(url, heading) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#content-area').html('<h2>' + heading + '</h2><hr>').append(response);
                    },
                    error: function(xhr) {
                        $('#content-area').html('<p>Error loading data. Please try again.</p>');
                    }
                });
            }

            $('#load-existing').on('click', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var heading = $(this).data('heading');

                loadContent(url, heading);
            });

            $('#load-new').on('click', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                var heading = $(this).data('heading');

                loadContent(url, heading);
            });

            // Handle filter form submission
            $(document).on('submit', '#filter-form', function(e) {
                e.preventDefault();
                var url = $(this).attr('action') + '?' + $(this).serialize();
                fetchData(url);
            });

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                fetchData(url);
            });

            function fetchData(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#content-area').html(response);
                    },
                    error: function(xhr) {
                        $('#content-area').html('<p>Error loading data. Please try again.</p>');
                    }
                });
            }
        });
    </script>
@endsection
