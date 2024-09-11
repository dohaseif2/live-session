<!DOCTYPE html>
<html>
<head>
    <title>Create Meeting</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create a Meeting</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('meetings.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            
            <div class="form-group">
                <label for="start_date_time">Start Date & Time:</label>
                <input type="datetime-local" id="start_date_time" name="start_date_time" class="form-control" value="{{ old('start_date_time') }}">
            </div>
            
            <div class="form-group">
                <label for="duration_in_minute">Duration (minutes):</label>
                <input type="number" id="duration_in_minute" name="duration_in_minute" class="form-control" value="{{ old('duration_in_minute') }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Create Meeting</button>
        </form>
    </div>


</body>
</html>
