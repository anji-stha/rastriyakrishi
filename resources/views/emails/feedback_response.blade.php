<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Response</title>
</head>

<body>
    <h1>Feedback Response</h1>

    <p>Dear User,</p>

    <p>{{ $statusMessage }}</p>

    @if ($registrationNumber)
        <p>Your registration number is: {{ $registrationNumber }}</p>
    @endif

    <p>Thank you for your submission.</p>
</body>

</html>
