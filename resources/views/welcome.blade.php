<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- OR PNG Format -->
<link rel="icon" href="{{ asset('logo/medicine.png') }}" type="image/png">
    <title>Pharmacy – Smart Healthcare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f7fc;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #0073e6, #003366);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        h1,
        h2 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        section {
            padding: 60px 20px;
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
        }

        .feature-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .feature-card {
            width: 48%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 40px;
            margin-bottom: 10px;
            color: #0073e6;
        }

        .about-text p,
        .contact-text p {
            max-width: 800px;
            margin: 0 auto 20px;
            text-align: center;
        }

        .contact-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .contact-item {
            background: #f1f5fb;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            min-width: 250px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .contact-item span {
            font-size: 22px;
            color: #0073e6;
        }

        footer {
            background: #222;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .feature-card {
                width: 100%;
            }
        }
        .google-login-btn {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    gap: 10px;
    background-color: #fff;
    color: #444;
    font-weight: 600;
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: 50px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.google-login-btn:hover {
    background-color: #f1f1f1;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.google-icon {
    width: 20px;
    height: 20px;
}

    </style>
</head>

<body>

    <header>
        <h1><i class="fas fa-prescription-bottle-alt"></i> Smart Pharmacy</h1>
        <p>Bringing Healthcare to Your Fingertips</p>
@php
    $isLoggedIn = Auth::guard('pharmacy')->check() || Auth::guard('web')->check();
@endphp

@if (! $isLoggedIn)
    <center class="mt-4">
    <a href="{{ route('login') }}" class="google-login-btn text-decoration-none">
        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="google-icon">
        <span>Login with Google</span>
    </a>
</center>

@endif

    </header>

    <section id="features">
        <center>
            <h2>Explore Our Services</h2>
        </center>
        <div class="feature-wrapper">
            <a href="{{ route('chat.index') }}" class="feature-card">
                <div class="icon">🤖</div>
                <h5>Chatbot</h5>
            </a>
             <a href="{{ route('pharmacy.index') }}" class="feature-card">
                <div class="icon">🛒</div>
                <h5>Order</h5>
            </a>
            <a href="{{route('advice.daily')}}" class="feature-card">
                <div class="icon">💡</div>
                <h5>Advice</h5>
            </a>
            <a href="{{ route('scan') }}" class="feature-card">
                <div class="icon">🔍</div>
                <h5>Search</h5>
            </a>
@php
    $profileRoute = Auth::guard('pharmacy')->check()
        ? route('profile.index')
        : (Auth::guard('web')->check()
            ? route('profile.show')
            : route('login'));
@endphp

<a href="{{ $profileRoute }}" class="feature-card">
    <div class="icon">👤</div>
    <h5>Profile</h5>
</a>



        </div>
    </section>

    <section id="about">
        <center>
            <h2>About Us</h2>
        </center>
        <div class="about-text">
            <p>
                Smart Pharmacy is on a mission to modernize how healthcare is delivered. From AI-powered chat support to
                simple medicine ordering,
                our goal is to give you the tools to manage your health faster, smarter, and with confidence.
            </p>
            <p>
                We believe that technology should empower people. Our team of developers, pharmacists, and health
                experts work together to ensure that
                Smart Pharmacy stays reliable, human-centered, and accessible to everyone.
            </p>
        </div>
    </section>

    <section id="contact">
        <center>
            <h2>Contact Us</h2>
        </center>
        <div class="contact-text">
            <p>If you need help or want to give us feedback, we’re here for you.</p>
        </div>
        <div class="contact-details">
            <div class="contact-item"><span>📧</span> support@smartpharmacy.com</div>
            <div class="contact-item"><span>📞</span> +123 456 7890</div>
            <div class="contact-item"><span>📍</span> 123 Health Street, Cairo, Egypt</div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Smart Pharmacy. All rights reserved.</p>
    </footer>

</body>

</html>
