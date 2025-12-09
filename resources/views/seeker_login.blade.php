<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Login - HobLoop</title>
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container-fluid py-4">
        <!-- Logo -->
        <div class="row justify-content-center">

            <div class="header-wrapper col-12 col-lg-9 col-xl-7 d-flex justify-content-between align-items-center mb-4">

                <p class="logo-header fw-bold fs-3 mb-0">HobLoop</p>

                <div class="text-role fw-medium ms-auto">
                    <a href="employer_login">Are you a employer?</a>
                </div>

            </div>
        </div>

        <div class="main-content">
            <!-- Register Card -->
            <div class="register-login-card-content row justify-content-center">
                <div class="form-content col-12 col-lg-9 col-xl-7 p-4 shadow rounded bg-white">

                    <div class="headline-text">
                        <p class="headline-text-content fw-semibold">Login</p>
                    </div>

                    <form class="text-start" action="/login-seeker" method="POST">
                        @csrf
                        <div class="text-email fw-medium">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="text-password fw-medium position-relative mb-3">
                            <label class="form-label">Password</label>

                            <input type="password" class="form-control" id="passInput" name="password" required>

                            <span class="toggle-pass position-absolute translate-middle-y" data-target="passInput"
                                style="cursor:pointer; right:12px; top:50px;">

                                <svg class="eye-closed" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.3999 19.5L5.3999 4.5M10.1999 10.4416C9.82648 10.8533 9.5999 11.394 9.5999 11.9863C9.5999 13.2761 10.6744 14.3217 11.9999 14.3217C12.611 14.3217 13.1688 14.0994 13.5926 13.7334M20.4387 14.3217C21.2649 13.0848 21.5999 12.0761 21.5999 12.0761C21.5999 12.0761 19.4153 5.1 11.9999 5.1C11.5836 5.1 11.1838 5.12199 10.7999 5.16349M17.3999 17.3494C16.0225 18.2281 14.2492 18.8495 11.9999 18.8127C4.67683 18.693 2.3999 12.0761 2.3999 12.0761C2.3999 12.0761 3.45776 8.69808 6.5999 6.64332"
                                        stroke="#003366" stroke-width="2" stroke-linecap="round" />
                                </svg>

                                <img class="eye-open" src="{{ asset('img/eye-open.png') }}" alt="eye-open"
                                    style="width:24px; display:none;">
                            </span>
                        </div>
                        
                        <a class="forgot-pass-text d-flex justify-content-end" href="{{ route('password.request') }}">
                            <p>Forgot password?</p>
                        </a>

                        <button type="submit" class="register-login btn d-block w-100 text-white fw-medium">
                            Login
                        </button>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </form>

                    <!-- Divider -->
                    <div class="divider d-flex align-items-center my-3">
                        <hr class="flex-grow-1">
                        <span class="px-3 text-muted">Or continue with</span>
                        <hr class="flex-grow-1">
                    </div>

                    <!-- Google Login -->
                    <a href="/auth/google/redirect" class="google-button btn w-100 fw-medium d-flex justify-content-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.8055 10.0415H21V10H12V14H17.6515C16.827 16.3285 14.6115 18 12 18C8.6865 18 6 15.3135 6 12C6 8.6865 8.6865 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C6.4775 2 2 6.4775 2 12C2 17.5225 6.4775 22 12 22C17.5225 22 22 17.5225 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                fill="#FFC107" />
                            <path
                                d="M3.15308 7.3455L6.43858 9.755C7.32758 7.554 9.48058 6 12.0001 6C13.5296 6 14.9211 6.577 15.9806 7.5195L18.8091 4.691C17.0231 3.0265 14.6341 2 12.0001 2C8.15908 2 4.82808 4.1685 3.15308 7.3455Z"
                                fill="#FF3D00" />
                            <path
                                d="M11.9999 22C14.5829 22 16.9299 21.0115 18.7044 19.404L15.6094 16.785C14.5719 17.5745 13.3037 18.0014 11.9999 18C9.39891 18 7.19041 16.3415 6.35841 14.027L3.09741 16.5395C4.75241 19.778 8.11341 22 11.9999 22Z"
                                fill="#4CAF50" />
                            <path
                                d="M21.8055 10.0415H21V10H12V14H17.6515C17.2571 15.1082 16.5467 16.0766 15.608 16.7855L15.6095 16.7845L18.7045 19.4035C18.4855 19.6025 22 17 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                                fill="#1976D2" />
                        </svg>
                        Continue with google
                    </a>

                    <!-- Bottom Text -->
                    <div class="register-login-bottom-text d-flex justify-content-start">
                        <p>Do not have an account?</p>
                        <a href="seeker_register">Register</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
