@extends('layout.main')
@section('content')
    @include('layout.admin.nav')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar/Navbar -->
            <div class="col-md-2">
                <div class="navbar navbar-expand-md navbar-light bg-light flex-column align-items-stretch">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column w-100">
                            <li class="nav-item">
                                <a href="#" id="load-existing" data-url="{{ route('admin.existingusers') }}"
                                    class="nav-link btn btn-info mb-2" data-heading="Existing Users">
                                    Existing Data
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="load-new" data-url="{{ route('admin.newusers') }}"
                                    class="nav-link btn btn-info mb-2" data-heading="New Users">
                                    New Registration Data
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" id="load-share-rate" data-url="{{ route('admin.sharerate') }}"
                                    data-heading="Share Rate" class="nav-link btn btn-info mb-2">
                                    Share Rate
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
                        $('#content-area').html('<h2>' + heading + '</h2><hr>').append(response)
                    },
                    error: function(xhr) {
                        $('#content-area').html('<p>Error loading data. Please try again.</p>')
                    }
                })
            }

            $('#load-existing').on('click', function(e) {
                e.preventDefault()
                var url = $(this).data('url')
                var heading = $(this).data('heading')

                loadContent(url, heading)
            })

            $('#load-new').on('click', function(e) {
                e.preventDefault()
                var url = $(this).data('url')
                var heading = $(this).data('heading')

                loadContent(url, heading)
            })

            $('#load-share-rate').on('click', function(e) {
                e.preventDefault()
                var url = $(this).data('url')
                var heading = $(this).data('heading')

                loadContent(url, heading)
            })

            // Handle filter form submission
            $(document).on('submit', '#filter-form', function(e) {
                e.preventDefault()
                var url = $(this).attr('action') + '?' + $(this).serialize()
                fetchData(url)
            })

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault()
                var url = $(this).attr('href')
                fetchData(url)
            })

            function fetchData(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#content-area').html(response)
                    },
                    error: function(xhr) {
                        $('#content-area').html('<p>Error loading data. Please try again.</p>')
                    }
                })
            }
        })
    </script>
@endsection
