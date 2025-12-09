<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobLoop - Profile</title>

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

        <p class="profile-text">Edit Profile</p>

        <div class="profile-card card shadow-sm border-0">
            <form action="/edit_profile_employer/update" method="POST" enctype="multipart/form-data" class="personal-information row g-4">
                @csrf

                <p class="fw-medium profile-section-title">About</p>
                <div class="about-section">
                    <textarea class="form-control company-about-text" name="about" rows="6"
                        placeholder="Write something about your company...">{{ old('about', $company->about) }}</textarea>
                </div>

                <p class="fw-medium profile-section-title mt-3">Company information</p>

                    <div class="col-12 col-md-4">
                        <label class="text-secondary fw-medium mb-1 small">Company Name</label>
                        <input type="text" class="form-control py-2" name="nama_perusahaan" placeholder="Enter company name"
                        value="{{ old('nama_perusahaan', $company->nama_perusahaan) }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-secondary fw-medium mb-1 small">Email</label>
                        <input type="email" class="form-control py-2" name="email_perusahaan" placeholder="Company email"
                        value="{{ old('email_perusahaan', $company->email_perusahaan) }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-secondary fw-medium mb-1 small">Country</label>
                        <input type="text" class="form-control py-2" name="negara" placeholder="Country"
                        value="{{ old('negara', $company->negara) }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-secondary fw-medium mb-1 small">Address</label>
                        <input type="text" class="form-control py-2" name="alamat_perusahaan" placeholder="Company address"
                        value="{{ old('alamat_perusahaan', $company->alamat_perusahaan) }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-secondary fw-medium mb-1 small">Phone</label>
                        <input type="text" class="form-control py-2" name="nomor_telepon" placeholder="+62 xxx"
                        value="{{ old('nomor_telepon', $company->nomor_telepon) }}">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn-save d-flex align-items-center justify-content-center shadow text-white gap-2 px-4 py-2"
                            style="border-radius: 12px; background-color:#003366;">
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
