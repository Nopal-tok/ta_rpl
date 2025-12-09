<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change_Password - HobLoop</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-transparent shadow-0 border-0 p-0">
        <div class="container-fluid p-4">
            <a class="logo-header navbar-brand fw-bold me-5" href="{{ route('landing') }}">HobLoop</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="nav-links-box d-flex w-100">
                    <ul class="navbar-nav nav-gap">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing') }}">Job search</a>
                        </li>
                        
                        @auth
                            @if(auth()->user()->role === 'perusahaan')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/formpostingjob') }}">Posting</a>
                            </li>
                            @endif

                            <li class="nav-item dropdown nav-link-item-custom">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown">
                                    Profile
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 10L12 14.5L17 10" stroke="#0A090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    @if(auth()->user()->role === 'pelamar')
                                        <li><a class="dropdown-item" href="{{ route('seeker.profile') }}">Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/change_password') }}">Change password</a></li>
                                        <li><a class="dropdown-item" href="{{ route('saved.index') }}">Saved job</a></li>
                                    @endif
                                    @if(auth()->user()->role === 'perusahaan')
                                        <li><a class="dropdown-item" href="{{ route('employer.profile') }}">Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ url('/change_password') }}">Change password</a></li>
                                        <li><a class="dropdown-item" href="{{ route('job.list') }}">Job Posted</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ url('/logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                    <a class="navbar-text ms-auto" href="{{ route('employer.login') }}">
                        Are you an employer?
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="container my-5">
        <p class="profile-text">Change password</p>
        
        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="profile-card card shadow-sm border-0">
                <div class="card-body">
                    <div class="text-password fw-medium position-relative mb-3">
                        <label class="form-label">Current password</label>

                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_pass">
                        @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <span class="toggle-pass position-absolute translate-middle-y" data-target="current_pass"
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

                    <div class="text-password fw-medium position-relative mb-3">
                        <label class="form-label">New password</label>

                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_pass">
                        @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <span class="toggle-pass position-absolute translate-middle-y" data-target="new_pass"
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

                    <div class="text-password fw-medium position-relative mb-3">
                        <label class="form-label">Confirm password</label>

                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_pass">
                        @error('confirm_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <span class="toggle-pass position-absolute translate-middle-y" data-target="confirm_pass"
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
                </div>


                <button type="submit"
                    class="btn-save d-flex align-items-center justify-content-center shadow mt-5 text-white gap-2 px-4 py-2"
                    style="border-radius: 12px; background-color:#003366;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.9375 19.875V14.8125C6.9375 14.1912 7.44118 13.6875 8.0625 13.6875H15.9375C16.5588 13.6875 17.0625 14.1912 17.0625 14.8125V20.4375M17.0625 4.125V6.375C17.0625 6.99632 16.5588 7.5 15.9375 7.5L8.0625 7.5C7.44118 7.5 6.9375 6.99632 6.9375 6.375L6.9375 3M20.4351 6.93513L17.0649 3.56487C16.7032 3.20319 16.2127 3 15.7012 3H4.92857C3.86344 3 3 3.86344 3 4.92857V19.0714C3 20.1366 3.86344 21 4.92857 21H19.0714C20.1366 21 21 20.1366 21 19.0714V8.29883C21 7.78734 20.7968 7.2968 20.4351 6.93513Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>

                    Save
                </button>

            </div>
        </form>
    </div>
    </div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
