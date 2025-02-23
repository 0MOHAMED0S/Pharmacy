<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - Quality Healthcare</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #f4f7fc;
            color: #333;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(135deg, #0073e6, #003366);
            color: white;
            padding: 80px 20px;
            animation: fadeIn 2s ease-in-out;
        }

        .medicine-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 40px 20px;
        }

        .medicine-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .medicine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .medicine-card img {
            height: 180px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .medicine-card h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #0073e6;
        }

        .medicine-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background-color: #cc5200;
            transform: scale(1.1);
        }

        footer {
            background-color: #222;
            color: white;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Our Pharmacy</h1>
        <p>Your Trusted Source for Quality Healthcare</p>
    </header>

    <section>
        <h2>Available Medicines</h2>
        <div class="medicine-container">
            @foreach ($medicines as $medicine)
                <div class="medicine-card">
                    <img src="{{ asset('storage/' . $medicine->path) }}" alt="{{ $medicine->name }}">
                    <h3>{{ $medicine->name }}</h3>
                    <p>Quantity: {{ $medicine->quantity }}</p>
                    <p>Price: ${{ $medicine->price }}</p>
                    <button class="btn order-btn" data-id="{{ $medicine->id }}">Order Now</button>
                </div>
            @endforeach

            <!-- CSRF Token (Important for Laravel POST requests) -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelectorAll(".order-btn").forEach(button => {
                        button.addEventListener("click", function() {
                            let medicineId = this.getAttribute("data-id");

                            fetch("/order-medicine", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute("content")
                                    },
                                    body: JSON.stringify({
                                        id: medicineId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    alert(`Order Placed! Medicine ID: ${data.medicine_id}`);
                                })
                                .catch(error => console.error("Error:", error));
                        });
                    });
                });
            </script>


        </div>
    </section>

    <footer>
        <p>&copy; 2025 Pharmacy. All rights reserved.</p>
    </footer>

</body>

</html>
