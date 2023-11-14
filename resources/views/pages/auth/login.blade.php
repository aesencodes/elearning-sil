<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />

        {{-- font family --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300&family=Lexend+Peta&display=swap" rel="stylesheet">

        <style>
            * {
                overflow: hidden;
                font-family: 'DM Sans', sans-serif;
            }

            .bg-blur {
                background-image: url("{{ asset('img/illustration/login_backround.png') }}");
                background-size: cover;
                height: 100vh;
                width: 100vw;
            }

            .banner-img {
                background-color: #7cb0ff;
                width: 50%;
                height: 96vh;
                margin: 20px;
                padding: 20px;
                border-radius: 20px;
            }

            .img-in-banner {
                width: 60%;
            }

            .login-input {
                width: 46%;
                margin: auto !important;
            }
            .btn-sign-in {
                letter-spacing: 1px;
            }

            .font-input {
                font-size: 18px;
                border: none !important;
            }

            .title {
                letter-spacing: 0.7px;
                font-size: 50px !important;
            }

            .sub-title {
                font-size: 20px;
                margin-bottom: 2.5rem;
            }

            .text-recovery {
                text-decoration: none;
                color: #414141;
                font-size: 18px;
            }

            .error-text {
                color: #de4c4c !important;
                display: block !important;
                margin: 6px 0;
            }

            textarea:focus,
            textarea.form-control:focus,
            input.form-control:focus,
            input[type=text]:focus,
            input[type=password]:focus,
            input[type=email]:focus,
            input[type=number]:focus,
            [type=text].form-control:focus,
            [type=password].form-control:focus,
            [type=email].form-control:focus,
            [type=tel].form-control:focus,
            [contenteditable].form-control:focus {
                box-shadow: inset 0 -1px 0 #ddd;
            }
        </style>
    </head>
    <body class="bg-blur">
        <div class="d-flex flex-wrap">
            <div class="banner-img text-center d-flex align-items-center justify-content-center">
                <img class="img-in-banner" src="{{ asset('img/illustration/learning.png') }}">
            </div>
            <div class="login-input text-center">
                <h2 class="title mb-3 fw-bold">Hello Again!</h2>
                <p class="sub-title">Siapkan diri kamu untuk belajar lebih jauh!</p>

                <div class="form-login container d-flex align-items-center justify-content-center">
                    <form method="POST" class="w-50" action="{{ route('login.post') }}">
                        @csrf

                        @include('partials.alert')

                        <div class="form-group mb-3">
                            <input class="form-control p-4 font-input rounded-3" type="text" placeholder="Enter Email" name="email"/>
                            @error('email')<small class="error-text form-text text-muted text-start">*{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control p-4 font-input rounded-3" type="password" placeholder="Password" name="password"/>
                            @error('password') <small class="error-text form-text text-muted text-start">*{{ $message }}</small> @enderror
                        </div>
                        <div class="text-end pt-3 pb-3">
                            <a href="#" class="text-recovery">Recovery Password</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                            <button type="submit" class="btn btn-primary w-100 pt-3 pb-3 fw-bold btn-sign-in">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
