<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobLoop - Form View Posting</title>

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
        <div class="profile-card card shadow-sm border-0 position-relative">
            <div class="card-body">

                <div class="dropdown action-dropdown-custom">
                    <button type="button" class="save-btn d-flex align-items-center" id="saveBtn">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M8.7899 6.48395H14.2066M11.5 15.1936L17.1669 20.2558C17.4891 20.5436 18 20.3149 18 19.8829V5C18 3.89543 17.1046 3 16 3H7C5.89543 3 5 3.89543 5 5V19.8829C5 20.3149 5.51092 20.5436 5.8331 20.2558L11.5 15.1936Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="row align-items-start">
                    <div class="col-md-7">

                        <div class="red-placeholder"></div>

                        <!-- JOB TITLE -->
                        <a href="#" class="job-title-post">{{ $job->nama_pekerjaan }}</a>

                        <!-- COMPANY NAME -->
                        <p class="company-name-text fw-normal">
                            {{ $job->company->nama_perusahaan ?? 'Perusahaan tidak tersedia' }}
                        </p>

                        <ul class="job-info-list">

                            <!-- JENIS PEKERJAAN -->
                            <li>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path d="M19.7143 16.1672V21.7145M15.6071 3.28571H23.8214M33.6786 22.0612C33.6786 29.8383 27.4265 36.1428 19.7143 36.1428C12.002 36.1428 5.75 29.8383 5.75 22.0612C5.75 14.2841 12.002 7.97958 19.7143 7.97958C27.4265 7.97958 33.6786 14.2841 33.6786 22.0612Z"
                                        stroke="#363636" stroke-width="3.28571" stroke-linecap="round" />
                                </svg>
                                {{ $job->jenis_pekerjaan }}
                            </li>

                            <!-- LOKASI -->
                            <li>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path d="M23.6577 15.7717C23.6577 17.9493 21.8924 19.7145 19.7148 19.7145C17.5372 19.7145 15.772 17.9493 15.772 15.7717C15.772 13.5941 17.5372 11.8288 19.7148 11.8288C21.8924 11.8288 23.6577 13.5941 23.6577 15.7717Z"
                                        stroke="#363636" stroke-width="3.28571" />
                                    <path d="M19.7143 35.4857C19.7143 35.4857 32.0572 24.5143 32.0572 16.2857C32.0572 9.46896 26.5311 3.94287 19.7143 3.94287C12.8975 3.94287 7.37146 9.46896 7.37146 16.2857C7.37146 24.5143 19.7143 35.4857 19.7143 35.4857Z"
                                        stroke="#363636" stroke-width="3.28571" />
                                </svg>
                                {{ $job->lokasi ?? 'Lokasi tidak tersedia' }}
                            </li>

                            <!-- GAJI -->
                            <li>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path d="M3.94287 12.8143C3.94287 11.1811 5.26683 9.85712 6.90001 9.85712H32.5286C34.1618 9.85712 35.4857 11.1811 35.4857 12.8143V26.6143C35.4857 28.2474 34.1618 29.5714 32.5286 29.5714H6.90001C5.26683 29.5714 3.94287 28.2474 3.94287 26.6143V12.8143Z"
                                        stroke="#363636" stroke-width="3.28571" />
                                    <path d="M23.6572 19.7143C23.6572 21.8918 21.8919 23.6571 19.7143 23.6571C17.5367 23.6571 15.7714 21.8918 15.7714 19.7143C15.7714 17.5367 17.5367 15.7714 19.7143 15.7714C21.8919 15.7714 23.6572 17.5367 23.6572 19.7143Z"
                                        stroke="#363636" stroke-width="3.28571" />
                                </svg>

                                Rp {{ number_format($job->gaji, 0, ',', '.') }}
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-5">
                        <h5 class="fw-bold mb-3 mt-5">Persyaratan untuk pekerjaan ini:</h5>

                        <ul class="job-info-list">

                            <!-- PENDIDIKAN MINIMAL -->
                            <li>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path ... fill="#363636" />
                                </svg>
                                {{ $job->pendidikan_minimal }}
                            </li>

                            <!-- PENGALAMAN MINIMAL -->
                            <li>
                                <svg width="35" height="40" viewBox="0 0 35 40" fill="none">
                                    <path ... stroke="#363636" />
                                </svg>
                                {{ $job->pengalaman_minimal }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Deskripsi pekerjaan</h5>
                    <p class="text-secondary" style="line-height: 1.6;">
                        {{ $job->deskripsi_kualifikasi ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="d-flex gap-3 mt-5">
                    @auth
                        @if(auth()->user()->role === 'pelamar')
                            <form id="saveJobForm" action="{{ route('saved.save', $job->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="button-apply" id="applyBtn">
                                    @if(auth()->user()->savedJobs()->where('job_id', $job->id)->exists())
                                        Remove
                                    @else
                                        Apply
                                    @endif
                                </button>
                            </form>
                        @else
                            <button class="button-apply" disabled title="Only job seekers can apply">Apply</button>
                        @endif
                    @else
                        <a href="{{ url('/seeker_login') }}" class="button-apply">Apply</a>
                    @endauth

                    <a href="{{ route('landing') }}" class="button-back-view">Back</a>
                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
