<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Profile</title>

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

        <p class="profile-text">Profile</p>

        <div class="profile-card card shadow-sm border-0">
            <div class="card-body">

                <div class="profile-header d-flex align-items-center flex-wrap">

                    <div class="pic-name d-flex align-items-center mb-3 mb-md-0">

                        <!-- Foto Profil (klik untuk upload) -->
                        <div class="rounded-circle bg-light overflow-hidden d-flex align-items-center justify-content-center me-3"
                            style="width: 72px; height: 72px; cursor: pointer; position: relative;">

                            <!-- Foto Preview -->
                            <img id="profileImagePreview"
                                src="{{ $profile->foto ? asset('storage/'.$profile->foto ) : asset('img/default.png') }}"
                                class="w-100 h-100"
                                style="object-fit: cover;">

                            <!-- FORM HIDDEN -->
                            <form id="profileImageForm" action="/seeker/upload-photo" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="profileImageInput" name="foto" accept="image/*" style="display:none;">
                            </form>
                        </div>

                        <!-- Nama -->
                        <div class="text-center">
                            <p class="highlight-name fw-medium text-white">{{ $profile->nama ?: '-' }}</p>
                        </div>

                    </div>

                    <div class="d-flex flex-column text-md-end text-white contact-box">
                        <span class="d-flex align-items-center justify-content-md-start mb-2">
                            <svg width="24" height="24" fill="none">
                                <path
                                    d="M4.6875 6.75L11.3596 11.5403C11.7449 11.8168 12.2551 11.8168 12.6404 11.5403L19.3125 6.75M5.25 19H18.75C19.9926 19 21 17.9553 21 16.6667V7.33333C21 6.04467 19.9926 5 18.75 5H5.25C4.00736 5 3 6.04467 3 7.33333V16.6667C3 17.9553 4.00736 19 5.25 19Z"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="ms-2">{{ $profile->email ?? '-' }}</span>
                        </span>

                        <span class="d-flex align-items-center justify-content-md-start">
                            <svg width="24" height="24" fill="none">
                                <path
                                    d="M20.6633 18.771C20.6633 18.771 19.5047 19.909 19.2207 20.2426C18.7582 20.7362 18.2132 20.9693 17.4988 20.9693C17.4301 20.9693 17.3568 20.9693 17.2881 20.9647C15.9279 20.8779 14.6639 20.3477 13.7159 19.8953C11.1238 18.643 8.84771 16.8651 6.95629 14.6119C5.39461 12.7335 4.35044 10.9968 3.65891 9.13211C3.233 7.99409 3.07729 7.10744 3.14598 6.27107C3.19178 5.73634 3.39787 5.29302 3.77798 4.91368L5.33966 3.35519C5.56406 3.14496 5.80221 3.0307 6.03577 3.0307C6.32429 3.0307 6.55786 3.20437 6.70441 3.35062C6.70899 3.35519 6.71357 3.35977 6.71815 3.36434C6.99751 3.62485 7.26313 3.8945 7.54249 4.18243C7.68446 4.32868 7.83101 4.47493 7.97756 4.62575L9.22782 5.87345C9.71327 6.35791 9.71327 6.8058 9.22782 7.29026C9.09501 7.4228 8.96678 7.55534 8.83397 7.68331C8.44927 8.07636 8.75147 7.77477 8.35304 8.13126C8.34388 8.1404 8.33472 8.14497 8.33014 8.15411C7.93629 8.54716 8.00956 8.93107 8.092 9.19158C8.09658 9.20529 8.10116 9.219 8.10573 9.23271C8.43089 10.0188 8.88886 10.7592 9.58498 11.6413L9.58956 11.6459C10.8536 13.1998 12.1862 14.4109 13.6563 15.3387C13.8441 15.4575 14.0364 15.5535 14.2196 15.6449C14.3845 15.7272 14.5402 15.8049 14.673 15.8871C14.6913 15.8963 14.7097 15.91 14.728 15.9191C14.8837 15.9968 15.0302 16.0334 15.1814 16.0334C15.5615 16.0334 15.7996 15.7957 15.8775 15.718L16.7752 14.8222C16.9309 14.6668 17.1782 14.4794 17.4667 14.4794C17.7506 14.4794 17.9842 14.6576 18.1262 14.813L20.6587 17.3404C21.1305 17.8066 20.6633 18.771 20.6633 18.771Z"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <span class="ms-2">{{ $profile->whatsapp ?? '-' }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <p class="fw-medium profile-section-title">Personal information</p>

            <div class="personal-information row g-4">

                <div class="col-12 col-md-4">
                    <p class="text-secondary fw-medium mb-1 small">Name</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->nama ?: '-' }}</p>

                    <p class="text-secondary fw-medium mb-1 small">Last education</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->pendidikan_terakhir ?? '-' }}</p>

                    <p class="text-secondary fw-medium mb-1 small">Birth</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->tanggal_lahir ?? '-' }}</p>
                </div>

                <div class="col-12 col-md-4">
                    <p class="text-secondary fw-medium mb-1 small">Email</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->email ?? '-'}}</p>

                    <p class="text-secondary fw-medium mb-1 small">Telephone</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->whatsapp ?? '-' }}</p>

                    <p class="text-secondary fw-medium mb-1 small">Work Experience</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->pengalaman_kerja ?? '-' }}</p>
                </div>

                <div class="col-12 col-md-4 ">
                    <p class="text-secondary fw-medium mb-1 small">Gender</p>
                    <p class="fw-normal data-value mb-4">{{ $profile->jenis_kelamin ?? '-' }}</p>

                    <div>
                        <p class="text-secondary fw-medium mb-1 small">CV</p>

                        {{-- Jika CV belum diupload → tampilkan form upload --}}
                        @if(!$profile->cv_path)
                            <form action="/seeker/upload-cv" 
                                method="POST" 
                                enctype="multipart/form-data">
                                @csrf

                                <div class="cv-upload-card position-relative" id="cvUploadCard">
                                    <input type="file"
                                        id="cvInputFile"
                                        name="cv"
                                        accept="application/pdf"
                                        style="opacity:0; position:absolute; inset:0; cursor:pointer;">

                                    <div id="cvDropArea" style="pointer-events:none;">
                                        <svg width="24" height="24" fill="none">
                                            <path d="M10.4058 21.6H5.6058C4.28031 21.6 3.2058 20.5254 
                                                    3.20581 19.2L3.2059 4.80001C3.20591 3.47453 
                                                    4.28043 2.40002 5.6059 2.40002H16.4062C17.7317 
                                                    2.40002 18.8062 3.47454 18.8062 4.80002V11.4" 
                                                    stroke="#B2B2B2" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <p class="fw-normal mb-1">Upload your PDF here -</p>
                                        <p class="text-secondary fw-medium small mb-0">up to 10 MB</p>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Upload CV</button>
                            </form>

                        {{-- Jika CV sudah ada → tampilkan CV --}}
                        @else
                            <div class="p-3 border rounded bg-light">
                                <p class="mb-1">Your CV:</p>
                                <a href="{{ asset('storage/'.$profile->cv_path) }}" 
                                target="_blank" 
                                class="fw-medium text-primary">
                                    View / Download CV
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="/edit_profile_seeker" class="btn-edit d-flex align-items-center justify-content-center shadow mt-5">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4.7999 15.6L8.9999 19.2M4.1999 15.6L16.0313 3.35542C17.3052 2.08152 19.3706 2.08152 20.6445 3.35542C21.9184 4.62932 21.9184 6.69472 20.6445 7.96862L8.3999 19.8L2.3999 21.6L4.1999 15.6Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>


    <script>
        // Klik foto → buka file input
        document.getElementById('profileImagePreview').onclick = function() {
            document.getElementById('profileImageInput').click();
        };

        // Setelah foto dipilih → tampilkan preview + submit otomatis
        document.getElementById('profileImageInput').onchange = function() {
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImagePreview').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);

                // Submit otomatis
                document.getElementById('profileImageForm').submit();
            }
        };
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
