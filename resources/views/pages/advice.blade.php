<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Daily Advice</title>
    <link rel="icon" href="{{ asset('logo/medicine.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f4fa;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .advice-card {
            background-color: #fff;
            border-radius: 16px;
            padding: 30px 25px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .advice-card h2 {
            color: #0073e6;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .advice-card p {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.6;
        }

        @media (max-width: 576px) {
            .advice-card {
                padding: 25px 15px;
            }

            .advice-card h2 {
                font-size: 1.3rem;
            }

            .advice-card p {
                font-size: 1rem;
            }
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
