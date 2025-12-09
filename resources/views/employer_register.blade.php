<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HobLoop</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container-fluid py-4">
        <!-- Logo -->
        <div class="row justify-content-center">

            <div class="header-wrapper col-12 col-lg-9 col-xl-7 d-flex justify-content-between align-items-center mb-4">

                <div class="logo-header">
                    <p class="fw-bold fs-3 mb-0">HobLoop</p>
                </div>

                <div class="text-role fw-medium ms-auto">
                    <a href="seeker_login">Are you looking for a job?</a>
                </div>

            </div>
        </div>

        <div class="main-content">
            <!-- Register Card -->
            <div class="register-login-card-content row justify-content-center">
                <div class="form-content col-12 col-lg-9 col-xl-7 p-4 shadow rounded bg-white">

                    <div class="headline-text">
                        <p class="headline-text-content fw-semibold">Register as employer</p>
                    </div>

                    <form class="text-start" action="/register-company" method="POST">
                        @csrf
                        <div class="text-email fw-medium">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="text-password fw-medium position-relative mb-3">
                            <label class="form-label">Password</label>

                            <input type="password" class="form-control" id="passInput" name="password">

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

                        <div class="text-password-confirm fw-medium position-relative">
                            <label class="form-label">Confirm Password</label>

                            <input type="password" class="form-control" id="confirmInput" name="password_confirmation">

                            <span class="toggle-pass position-absolute translate-middle-y" data-target="confirmInput"
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

                        <button type="submit" class="register-login btn d-block w-100 text-white fw-medium">
                            Register
                        </button>

                    </form>

                    <!-- Bottom Text -->
                    <div class="register-login-bottom-text d-flex justify-content-start">
                        <p>Already have an account?</p>
                        <a href="employer_login">Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
