<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #f4f7fc;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
            color: #0073e6;
        }

        .btn {
            display: block;
            padding: 14px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #cc5200;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Pharmacy Login</h1>
        @auth('pharmacy')
            <a class="btn" href="{{ route('medicines.index') }}">Go to Dashboard</a>
        @else
            <a class="btn" href="{{ route('auth.google') }}">Sign in with Google</a>
        @endauth
    </div>
</body>

</html>
