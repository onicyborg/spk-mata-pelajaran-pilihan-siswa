<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <style>
        .card-selection {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .card-selection:hover {
            transform: scale(1.05);
        }

        .card-active {
            border: 2px solid #007bff;
        }

        .login-form {
            display: none;
        }

        .login-form.active {
            display: block;
        }

        .card-body {
            width: 400px;
            /* Lebar card ditingkatkan menjadi 400px */
        }

        .btn-group-toggle .btn {
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <h2 class="mb-4">Anda Adalah</h2>
        <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
            <button class="btn btn-outline-primary" id="btn-siswa">Siswa</button>
            <button class="btn btn-outline-primary" id="btn-guru">Guru</button>
            <button class="btn btn-outline-primary" id="btn-admin">Admin</button>
        </div>

        <div class="card p-4 shadow-sm login-form active" id="form-siswa">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login Siswa</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="username"
                            placeholder="Enter NISN">
                    </div>
                    <div class="mb-3">
                        <label for="password-siswa" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-siswa" name="password"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>

        <div class="card p-4 shadow-sm login-form" id="form-guru">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login Guru</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="username"
                            placeholder="Enter NIP">
                    </div>
                    <div class="mb-3">
                        <label for="password-guru" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-guru" name="password"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>

        <div class="card p-4 shadow-sm login-form" id="form-admin">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login Admin</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="password-admin" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-admin" name="password"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script>
        document.getElementById('btn-siswa').addEventListener('click', function() {
            setActiveForm('form-siswa');
        });

        document.getElementById('btn-guru').addEventListener('click', function() {
            setActiveForm('form-guru');
        });

        document.getElementById('btn-admin').addEventListener('click', function() {
            setActiveForm('form-admin');
        });

        function setActiveForm(formId) {
            document.querySelectorAll('.login-form').forEach(function(form) {
                form.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
        }
    </script>

    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    @if (session('error'))
        <script>
            swal("Error!", "{{ session('error') }}", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            });
        </script>
    @endif
</body>

</html>
