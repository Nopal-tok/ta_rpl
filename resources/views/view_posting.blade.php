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
                                <a class="nav-link" href="{{ url('/formpostingjob') }}">Posting Job</a>
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

        @foreach ($jobs as $job )
        
        <div class="profile-card card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between">
                <div class="content-info">
                    <div class="content-text-card-top mb-5">
                        <a class="job-title-post">{{ $job->nama_pekerjaan }}</a>
                        <p class="company-name-text fw-normal" style="font-size: 22px; color:#363636">{{ $job->company->nama_perusahaan}}
                        </p>
                    </div>

                    <div class="content-text-card-bottom">
                        <p>{{ $job->jenis_pekerjaan }}</p>
                        <p>{{ $job->lokasi ?? 'Lokasi tidak tersedia' }}</p>
                        <p>Rp {{ number_format($job->gaji, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <div class="content-pic">
                    <div class="pic-wrapper position-relative">
                        <button type="button" class="save-btn d-flex align-items-center" id="saveBtn">
                            <svg id="iconOutline" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                d="M8.7899 6.48395H14.2066M11.5 15.1936L17.1669 20.2558C17.4891 20.5436 18 20.3149 18 19.8829V5C18 3.89543 17.1046 3 16 3H7C5.89543 3 5 3.89543 5 5V19.8829C5 20.3149 5.51092 20.5436 5.8331 20.2558L11.5 15.1936Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            
                            <svg id="iconFill" width="24" height="24" viewBox="0 0 24 24" style="display:none;">
                                <path
                                d="M5 5C5 3.89543 5.89543 3 7 3H16C17.1046 3 18 3.89543 18 5V19.8829C18 20.3149 17.4891 20.5436 17.1669 20.2558L11.5 15.1936L5.8331 20.2558C5.51092 20.5436 5 20.3149 5 19.8829V5Z"
                                fill="white" id="pathFill" />
                                <path
                                d="M8.7899 6.48395H14.2066M11.5 15.1936L17.1669 20.2558C17.4891 20.5436 18 20.3149 18 19.8829V5C18 3.89543 17.1046 3 16 3H7C5.89543 3 5 3.89543 5 5V19.8829C5 20.3149 5.51092 20.5436 5.8331 20.2558L11.5 15.1936Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                id="pathStroke" />
                            </svg>
                        </button>
                        
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        @endforeach
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>