<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetings</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optionally include custom CSS if needed -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Meetings</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Start Time</th>
                    <th>Duration</th>
                    <th>Start URL</th>
                    <th>Join URL</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->id }}</td>
                        <td>{{ $meeting->topic }}</td>
                        <td>{{ $meeting->start_time }}</td>
                        <td>{{ $meeting->duration }}</td>
                        <td><a href="{{ $meeting->start_url }}" target="_blank">Start URL</a></td>
                        <td><a href="{{ $meeting->join_url }}" target="_blank">Join URL</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No meetings found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Optionally include custom JS if needed -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
