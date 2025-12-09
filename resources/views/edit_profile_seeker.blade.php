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

            <p class="fw-medium profile-section-title mt-3">Personal information</p>

            <form action="/edit_profile_seeker/update" method="POST" enctype="multipart/form-data" class="personal-information row g-4">
                @csrf

                <div class="col-12 col-md-4">
                    <label class="text-secondary fw-medium mb-1 small">Name</label>
                    <input type="text" class="form-control py-2" name="nama" placeholder="Enter your name"
                    value="{{ old('nama', $profile->nama) }}">
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-secondary fw-medium mb-1 small">Email</label>
                    <input type="email" class="form-control py-2" name="email" placeholder="Your email"
                    value="{{ old('email', $profile->email) }}">
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-secondary fw-medium mb-1 small">Telephone</label>
                    <input type="text" class="form-control py-2" name="whatsapp" placeholder="Your phone number"
                    value="{{ old('whatsapp', $profile->whatsapp) }}">
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-secondary fw-medium mb-1 small">Last education</label>
                    <input type="text" class="form-control py-2" name="pendidikan_terakhir" placeholder="Your last education"
                    value="{{ old('pendidikan_terakhir', $profile->pendidikan_terakhir) }}">
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-secondary fw-medium mb-1 small">Gender</label>
                    <select name="jenis_kelamin" class="form-control py-2">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <p class="text-secondary fw-medium mb-1 small">Replace CV (PDF, max 10 MB)</p>

                    {{-- Jika CV sudah ada, tampilkan preview/link --}}
                    @if($profile->cv_path)
                        <div class="p-3 border rounded bg-light mb-2">
                            <p class="mb-1 small">Current CV:</p>
                            <a href="{{ asset('storage/'.$profile->cv_path) }}" 
                            target="_blank" 
                            class="text-primary fw-medium">
                                View Current CV
                            </a>
                        </div>
                    @endif

                    {{-- Upload CV Baru (Replace) --}}
                    <div id="cvUploadCard"
                        class="cv-upload-card p-3 border rounded d-flex flex-column align-items-center justify-content-center"
                        style="cursor: pointer; background-color: #f8f9fa;"
                        onclick="document.getElementById('cvReplaceInput').click()">

                        <input type="file" 
                            id="cvReplaceInput" 
                            name="cv" 
                            accept="application/pdf" 
                            style="display:none;" />

                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" class="mb-2">
                            <path d="M10.4 21.6H5.6C4.28 21.6 3.2 20.52 3.2 19.2V4.8C3.2 3.47 4.28 2.4 5.6 2.4H16.4C17.73 2.4 18.8 3.47 18.8 4.8V11.4"
                                stroke="#6c757d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <p class="fw-normal mb-1">Click or upload new PDF</p>
                        <p class="text-secondary fw-medium small mb-0">Replacing will delete old CV</p>
                    </div>

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

    <script>
    document.getElementById("cvReplaceInput").addEventListener("change", function(event) {
        let file = event.target.files[0];

        if (file && file.type === "application/pdf") {
            let fileURL = URL.createObjectURL(file);

            // hide upload box
            document.getElementById("cvUploadCard").style.display = "none";

            // show preview
            document.getElementById("cvPreviewFrame").src = fileURL;
            document.getElementById("cvPreview").style.display = "block";
        }
    });
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
