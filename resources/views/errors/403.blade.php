<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #6c757d;
        }
        .error-container {
            text-align: center;
        }
        .error-code {
            font-size: 72px;
            font-weight: bold;
        }
        .error-message {
            font-size: 24px;
        }
        .btn-home {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">Anda tidak memiliki akses ke halaman ini.</div>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Login</a>
    </div>
</body>
</html>
