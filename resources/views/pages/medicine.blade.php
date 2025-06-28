<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - Order Medicines</title>
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

        header h1 {
            font-size: 2.5rem;
        }

        .section-title {
            text-align: center;
            padding: 40px 0 0;
            font-size: 28px;
            color: #003366;
            font-weight: bold;
        }

        .medicine-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 30px 15px;
        }

        .medicine-card {
            width: 260px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .medicine-card:hover {
            transform: translateY(-4px);
        }

        .medicine-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .medicine-card-body {
            padding: 15px;
            text-align: center;
        }

        .medicine-card-body h3 {
            font-size: 18px;
            color: #0073e6;
            margin-bottom: 5px;
        }

        .medicine-info {
            font-size: 14px;
            color: #555;
        }

        .price {
            font-size: 16px;
            font-weight: bold;
            color: #ff6600;
            margin: 10px 0;
        }

        .order-btn {
            background-color: #0073e6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
        }

        .order-btn:hover {
            background-color: #005bb5;
        }

        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        .spinner-border {
            width: 1.8rem;
            height: 1.8rem;
        }
    </style>
</head>

<body>

    <header>
        <h1>💊 Welcome to Our Pharmacy</h1>
        <p>Your Trusted Source for Quality Healthcare</p>
    </header>

    <h2 class="section-title">Available Medicines</h2>

    <div class="medicine-grid">
        @foreach ($medicines as $medicine)
            <div class="medicine-card">
                <div class="medicine-image">
                    <img src="{{ asset('storage/' . $medicine->path) }}" alt="{{ $medicine->name }}">
                </div>
                <div class="medicine-card-body">
                    <h3>{{ $medicine->name }}</h3>
                    <p class="medicine-info">Quantity: {{ $medicine->quantity }}</p>
                    <p class="price">${{ $medicine->price }}</p>
                    <button class="order-btn" data-id="{{ $medicine->id }}">Order Now</button>
                </div>
            </div>
        @endforeach
    </div>

    <footer>
        <p>&copy; 2025 Pharmacy. All rights reserved.</p>
    </footer>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <h5 class="modal-title mb-3" id="orderModalLabel">🛒 Processing Order</h5>
                <div id="orderModalBody">
                    <div class="spinner-border text-primary mb-3" role="status"></div>
                    <p class="text-muted">Please wait while we confirm your order...</p>
                </div>
                <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const orderModal = new bootstrap.Modal(document.getElementById("orderModal"));
            const modalBody = document.getElementById("orderModalBody");

            document.querySelectorAll(".order-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const medicineId = this.getAttribute("data-id");

                    // Reset modal to show loader
                    modalBody.innerHTML = `
                        <div class="spinner-border text-primary mb-3" role="status"></div>
                        <p class="text-muted">Please wait while we confirm your order...</p>
                    `;
                    orderModal.show();

                    fetch("/order-medicine", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: JSON.stringify({ id: medicineId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        modalBody.innerHTML = `
                            <h5 class="text-success">✅ Order Confirmed!</h5>
                            <p class="mt-2">Medicine ID: <strong>${data.medicine_id}</strong></p>
                        `;
                    })
                    .catch(error => {
                        modalBody.innerHTML = `
                            <h5 class="text-danger">❌ Failed to place order</h5>
                            <p>Please try again later.</p>
                        `;
                        console.error("Error:", error);
                    });
                });
            });
        });
    </script>

</body>

</html>
