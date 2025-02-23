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

        .btn {
            display: inline-block;
            padding: 14px 28px;
            margin-top: 20px;
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

        section {
            padding: 60px 20px;
            animation: slideUp 1.5s ease-in-out;
            background: white;
            margin: 20px auto;
            max-width: 900px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0) 70%);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        section:hover::before {
            opacity: 1;
        }

        .about-content,
        .services-content,
        .contact-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .icon {
            font-size: 50px;
            color: #0073e6;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            font-size: 18px;
            margin: 10px 0;
            opacity: 0;
            animation: fadeInUp 1s ease-in-out forwards;
        }

        ul li:nth-child(1) {
            animation-delay: 0.3s;
        }

        ul li:nth-child(2) {
            animation-delay: 0.6s;
        }

        ul li:nth-child(3) {
            animation-delay: 0.9s;
        }

        ul li:nth-child(4) {
            animation-delay: 1.2s;
        }

        footer {
            background-color: #222;
            color: white;
            padding: 20px;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Our Smart Pharmacy</h1>
        <p>Your Trusted Source for Quality Healthcare</p>
    </header>



    <section id="about">
        <div class="about-content">
            <div class="icon">💊</div>
            <h2>About Us</h2>
            <p>We provide top-quality medicines with no hassle. Order online and pick up your prescription easily.</p>
        </div>
    </section>
    <section id="services">
        <div class="services-content">
            <div class="icon">⚕️</div>
            <h2>Our Services</h2>
            <ul>
                <li>✅ Prescription Refills</li>
                <li>✅ Over-the-Counter Medications</li>
                <li>✅ Online Consultations</li>
                <li>✅ Fast Delivery</li>
            </ul>
        </div>
    </section>
    <section id="contact">
        <div class="contact-content">
            <div class="icon">📞</div>
            <h2>Contact Us</h2>
            <p>Email: <strong>contact@pharmacy.com</strong></p>
            <p>Phone: <strong>+123 456 7890</strong></p>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Pharmacy. All rights reserved.</p>
    </footer>
</body>

</html>
