<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile – Pharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
        }

        header {
            background: linear-gradient(135deg, #0073e6, #003366);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .profile-container {
            max-width: 500px;
            background-color: #fff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        .btn-primary {
            background-color: #0073e6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005bb5;
        }

        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
        .btn-outline-danger {
    font-weight: 600;
    transition: all 0.3s ease-in-out;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
}

    </style>
</head>
<body>

    <header>
        <h1>👤 User Profile</h1>
        <p>Review your info and select your disease</p>
    </header>

    <div class="profile-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{{route('profile.update.disease')}}}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input readonly type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input readonly type="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
            </div>

            <div class="mb-3">
                <label for="disease" class="form-label">Select Your Disease</label>
                <select name="disease" id="disease" class="form-select" required>
                    <option value="" disabled>Select your condition</option>
                    <option value="none" {{ auth()->user()->disease === 'none' ? 'selected' : '' }}>None</option>
                    <option value="diabetes" {{ auth()->user()->disease === 'diabetes' ? 'selected' : '' }}>Diabetes</option>
                    <option value="hypertension" {{ auth()->user()->disease === 'hypertension' ? 'selected' : '' }}>Hypertension</option>
                    <option value="asthma" {{ auth()->user()->disease === 'asthma' ? 'selected' : '' }}>Asthma</option>
                    <option value="heart" {{ auth()->user()->disease === 'heart' ? 'selected' : '' }}>Heart Disease</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Update Disease</button>
        </form>
    </div>
    <form method="POST" action="{{ route('pharmacy.logout') }}" class="text-center mt-4">
    @csrf
    <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-pill shadow-sm">
        <i class="fa fa-power-off me-2"></i>
        {{ __('Log Out') }}
    </button>
</form>

    <footer>
        <p>&copy; 2025 Pharmacy. All rights reserved.</p>
    </footer>

</body>
</html>
