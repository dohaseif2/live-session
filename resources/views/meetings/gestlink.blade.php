<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting: {{ $meeting->topic }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .zoom-container {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>{{ $meeting->topic }}</h1>
        <iframe src="https://zoom.us/wc/join/{{ $meeting->id }}?pwd={{ $meeting->password }}&un=GuestUser"
            class="zoom-container">
        </iframe>

    </div>

</body>

</html>
