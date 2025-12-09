<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - HobLoop</title>
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
            <!-- Reset Password Card -->
            <div class="register-login-card-content row justify-content-center">
                <div class="form-content col-12 col-lg-9 col-xl-7 p-4 shadow rounded bg-white">

                    <div class="headline-text">
                        <p class="headline-text-content fw-semibold">Reset Password</p>
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

                    <form class="text-start" action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Email Address</label>
                            <input type="email" name="email" value="{{ $email }}" class="form-control @error('email') is-invalid @enderror" required disabled>
                            <input type="hidden" name="email" value="{{ $email }}">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label fw-medium">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="register-login btn d-block w-100 text-white fw-medium mb-3" type="submit">
                            Reset Password
                        </button>

                    </form>

                    <!-- Bottom Text -->
                    <div class="register-login-bottom-text d-flex justify-content-start">
                        <p>Ingat password Anda?</p>
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
