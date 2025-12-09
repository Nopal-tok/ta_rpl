<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - HobLoop</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container-fluid py-4">
        <!-- Logo -->
        <div class="row justify-content-center">
            <div class="header-wrapper col-12 col-lg-9 col-xl-7 d-flex justify-content-between align-items-center mb-4">
                <p class="logo-header fw-bold fs-3 mb-0">HobLoop</p>
            </div>
        </div>

        <div class="main-content">
            <!-- Forgot Password Card -->
            <div class="register-login-card-content row justify-content-center">
                <div class="form-content col-12 col-lg-9 col-xl-7 p-4 shadow rounded bg-white">

                    <div class="headline-text">
                        <p class="headline-text-content fw-semibold">Forgot Password</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="text-start" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="text-email fw-medium mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="register-login btn d-block w-100 text-white fw-medium mb-3" type="submit">
                            Send Reset Link
                        </button>
                    </form>

                    <!-- Bottom Text -->
                    <div class="register-login-bottom-text d-flex justify-content-start">
                        <p>Remember your password?</p>
                        <a href="{{ route('seeker.login') }}">Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
