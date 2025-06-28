<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-3">🔍 Search for a Medicine</h2>

        <form action="{{ route('medicine.search') }}" method="POST">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Enter medicine name..." required>
            <button class="btn btn-primary mt-3">Search</button>
        </form>

        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @isset($medicine)
            <div class="mt-4">
                <h4>{{ $medicine['name'] }}</h4>
                <p><strong>Description:</strong> {{ $medicine['description'] }}</p>
            </div>
        @endisset
    </div>
</div>
</body>
</html>
