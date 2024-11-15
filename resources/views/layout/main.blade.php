<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rastriya Krishi</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        legend {
            font-weight: 700;
            padding: 0px 10px;
            color: #F57921;
        }

        .submit-btn {
            border-radius: 20px;
            font-weight: 700;
            font-size: 18px;
            background: #21B24B;
            padding: 5px 25px;
            border: none;
        }

        .footer {
            background: #006837;
            color: #fff;
            padding-top: 60px;
            padding-bottom: 90px;
        }

        .footer a {
            color: #fff;
            line-height: 30px;
        }

        .form-control {
            border-radius: 10px;
        }

        fieldset {
            border-radius: 15px;
            border: solid 1px #eee;
        }
    </style>

</head>

<body>

    @yield('content')

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/custom.js') }}"></script>

</body>

</html>
