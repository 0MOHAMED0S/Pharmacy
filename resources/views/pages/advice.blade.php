<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Daily Advice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f4fa;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .advice-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            max-width: 500px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .advice-card h2 {
            color: #0073e6;
            margin-bottom: 20px;
        }

        .advice-card p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="advice-card">
        <h2>💡 Your Health Tip for Today</h2>
        <p>{{ $advice }}</p>
    </div>

</body>
</html>
