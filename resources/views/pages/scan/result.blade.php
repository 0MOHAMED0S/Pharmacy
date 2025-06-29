<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Translate -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ar',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <style>
        body {
            background-color: #f4f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
        }
        .lang-toggle {
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Language Switcher -->
    <div class="lang-toggle mb-4" id="google_translate_element"></div>

    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">🔍 Search for a Medicine</h2>

        <!-- Form to search again -->
        <form action="{{ route('medicine.search') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Enter medicine name..." required>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- Error message -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Medicine result -->
        @isset($medicine)
            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-capsule" style="font-size: 1.5rem;"></i>
                    </div>
                    <h4 class="ms-3 mb-0 fw-semibold text-primary">
                        {{ ucfirst($medicine['name']) }}
                    </h4>
                </div>

                <h6 class="text-muted mb-2">Description</h6>
                <p class="text-dark fs-6" style="line-height: 1.6;">
                    {{ $medicine['description'] }}
                </p>
            </div>
        @endisset
    </div>
</div>

<!-- Bootstrap JS (for dismissible alerts) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
