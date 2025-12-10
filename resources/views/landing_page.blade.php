<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HobLoop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Definisi Warna */
        :root {
            --dark-blue: #002244; /* Warna utama Footer & Tombol Custom */
            --danger-red: #dc3545; /* Warna Tombol Log In/Join Now */
        }

        /* Gaya Tombol Kustom (Warna sama dengan Footer) */
        .btn-custom-dark {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
            color: white;
            transition: background-color 0.2s;
        }
        .btn-custom-dark:hover {
            background-color: #003366;
            border-color: #003366;
            color: white;
        }
        
        /* HERO/HEADER STYLES */
        .hero {
            background-image: url("{{ asset('img/b.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 580px;
            position: relative;
        }
        .search-box {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            max-width: 950px;
        }
        
        /* STYLE CHIP YANG DIKLIK (Revisi) */
        .filter-chip-link {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #495057;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-right: 8px;
            display: inline-block;
            text-decoration: none; 
            transition: background-color 0.2s, color 0.2s;
        }
        .filter-chip-link:hover {
            background-color: #e9ecef;
            color: var(--dark-blue); 
            border-color: #ced4da;
        }
        /* Tombol More yang dipindah ke bawah */
        .btn-more-filters {
            margin-top: 15px; 
        }

        /* Hapus gaya .filter-chip lama karena diganti .filter-chip-link */
        /* .filter-chip { ... } */

        /* INTRODUCING HOBLOOP STYLES */
        .intro-link-card {
            display: block; /* Penting agar <a> bertindak sebagai container */
            text-decoration: none;
            color: inherit;
            transition: opacity 0.2s;
            border-radius: 10px;
        }
        .intro-link-card:hover {
            opacity: 0.9;
        }
        .intro-container {
            position: relative;
            margin-top: 15px;
        }
        .intro-card-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
        }
        .intro-card-overlay {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 50%;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .intro-card-overlay a {
            color: var(--dark-blue);
            text-decoration: none;
        }
        .intro-card-list-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .intro-card-list-item:last-child {
            border-bottom: none;
        }

        /* CONNECTING OPPORTUNITIES STYLES */
        .stat-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            padding: 0 !important;
            background-color: white;
        }
        .stat-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 4px 4px 0 0;
        }

        /* FOOTER STYLES */
        .custom-footer {
            background-color: var(--dark-blue);
        }
        .footer-link-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .footer-link-item:last-child {
            border-bottom: none; 
        }
        .footer-link-item a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
        }
        .footer-link-item .arrow {
            font-size: 1.5rem;
            color: white;
        }

        .head-logo {
            font-weight: 700;
            font-style: Bold;
            font-size: 32px;
            line-height: 100%;
            letter-spacing: 0px;
            color: white;

        }
        </style>
</head>
<body>
    <div class="hero text-white">
        <nav class="navbar navbar-expand-lg bg-transparent shadow-0 border-0 p-0">
            <div class="container-fluid p-4">
                <a class="head-logo navbar-brand fw-bold me-5" href="{{ route('landing') }}">HobLoop</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="nav-links-box d-flex w-100">
                        <ul class="navbar-nav nav-gap">

                            <!-- ALWAYS VISIBLE -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('landing') }}">Job search</a>
                            </li>

                            <!-- ====================== -->
                            <!-- IF USER IS GUEST -->
                            <!-- ====================== -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('seeker.login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('seeker.register') }}">Register</a>
                                </li>
                            @endguest

                            <!-- ====================== -->
                            <!-- IF USER IS LOGGED IN  -->
                            <!-- ====================== -->
                            @auth

                                <!-- COMPANY ONLY -->
                                @if(auth()->user()->role === 'perusahaan')
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ url('/formpostingjob') }}">Posting Job</a>
                                </li>
                                @endif

                                <!-- PROFILE DROPDOWN -->
                                <li class="nav-item dropdown nav-link-item-custom">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1 text-white" href="#" role="button" data-bs-toggle="dropdown">
                                        Profile
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                            <path d="M7 10L12 14.5L17 10" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>

                                    <ul class="dropdown-menu">

                                        <!-- PELAMAR -->
                                        @if(auth()->user()->role === 'pelamar')
                                            <li><a class="dropdown-item" href="{{ route('seeker.profile') }}">Profile</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/change_password') }}">Change password</a></li>
                                            <li><a class="dropdown-item" href="{{ route('saved.index') }}">Saved job</a></li>
                                        @endif

                                        <!-- PERUSAHAAN -->
                                        @if(auth()->user()->role === 'perusahaan')
                                            <li><a class="dropdown-item" href="{{ route('employer.profile') }}">Profile</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/change_password') }}">Change password</a></li>
                                            <li><a class="dropdown-item" href="{{ route('job.list') }}">Job Posted</a></li>
                                        @endif

                                        <li><hr class="dropdown-divider"></li>

                                        <!-- LOGOUT -->
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
                    </div>
                </div>
            </div>
        </nav>
 
        <div class="container d-flex flex-column justify-content-start align-items-start h-100 pt-5 ">
            <h1 class="display-5 fw-bold" style="max-width: 750px;">Find the Right Job. Build Your Career with HobLoop.</h1>
        </div>

        <div class="search-box bg-white p-4 shadow rounded-3">
            <form action="{{ route('job.search') }}" method="GET">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <input type="text" name="keyword" class="form-control p-3" placeholder="Enter keyword">
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" name="classification" class="form-control p-3" placeholder="Classification">
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" name="location" class="form-control p-3" placeholder="City or region">
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button class="btn btn-custom-dark px-4">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($jobs))
        <div class="container py-5">
            <h3 class="fw-bold mb-4">Search Results</h3>

            @if($jobs->count() == 0)
                <p class="text-muted">No jobs found.</p>
            @endif

            @foreach($jobs as $job)
                <div class="card-result card shadow-sm gap-3 p-4 mb-3">
                    <h4 class="fw-bold">{{ $job->nama_pekerjaan }}</h4>
                    <p class="mb-1">
                        <strong>Company:</strong> {{ $job->company->nama_perusahaan ?? 'Unknown' }}
                    </p>
                    <p class="mb-1">
                        <strong>Location:</strong> {{ $job->lokasi }}
                    </p>
                    <p class="mb-2">{{ Str::limit($job->deskripsi_kualifikasi, 120) }}</p>

                    <a href="{{ route('job.show', $job->id) }}" class="btn btn-custom btn-sm text-white py-2" style="background-color: #003366">
                        View Job
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <div class="container py-4">
        <div class="d-flex flex-wrap gap-2">
            <a href="#" class="filter-chip-link">Part Time - Jawa Timur</a>
            <a href="#" class="filter-chip-link">Crew</a>
            <a href="#" class="filter-chip-link">Lowongan kerja - Malang</a>
        </div>
        
        <a href="#" class="btn btn-custom-dark btn-more-filters px-4 py-2 mt-2 fw-bold">More</a>
    </div>

    <div class="container py-5">
        <h2 class="fw-bold mb-4">Introducing HobLoop</h2>

        <a href="/about-hobloop" class="intro-link-card shadow-lg">
            <div class="intro-container">
                <img src="{{ asset('img/c.jpg') }}" alt="Woman Working" class="intro-card-img">
                
                <div class="intro-card-overlay">
                    <h5 class="fw-bold text-dark mb-2">HobLoop</h5>
                    <p class="small mb-4">A recruiting platform to find and post jobs effortlessly.</p>
                    
                    <i class="fa-solid fa-arrow-right arrow d-block mb-3" style="color: var(--dark-blue); font-size: 1.2rem;"></i>
                    
                    <div class="list-unstyled small">
                        <div class="intro-card-list-item">
                            <h6 class="fw-bold mb-0">What we do</h6>
                            <p class="text-muted small mt-1 mb-0">We build a simple, fast hiring platform so companies can manage jobs without stress.</p>
                        </div>

                        <div class="intro-card-list-item d-flex justify-content-between">
                            <h6 class="fw-bold mb-0">Why we started</h6>
                            <i class="fa-solid fa-arrow-right arrow my-auto" style="font-size: 1rem; color: #333;"></i>
                        </div>
                        
                        <div class="intro-card-list-item d-flex justify-content-between">
                            <h6 class="fw-bold mb-0">What we believe</h6>
                            <i class="fa-solid fa-arrow-right arrow my-auto" style="font-size: 1rem; color: #333;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/about-hobloop" class="btn btn-custom-dark px-4 py-2 mt-4">See more <i class="fa-solid fa-arrow-right ms-2"></i></a>
    </div>

    <div class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold mb-5">Connecting opportunities for a sustainable future</h2>

            <div class="row g-4 justify-content-center mt-4">
                <div class="col-md-6 col-lg-4">
                    <a href="/jobs-available" class="text-decoration-none text-dark">
                        <div class="card shadow-lg border-0 h-100 d-flex flex-row align-items-center p-3">
                            
                            <!-- Image Section -->
                            <div class="text-center me-3">
                                <img src="{{ asset('img/a.jpg') }}" 
                                    class="rounded img-fluid" 
                                    style="width: 110px; height: 90px; object-fit: cover;" 
                                    alt="Jobs Available">
                                
                                <button class="btn btn-custom-dark btn-sm mt-2 p-2">
                                    Get started
                                </button>
                            </div>

                            <!-- Content -->
                            <div>
                                <h5 class="fw-bold mb-1">1k+</h5>
                                <h5 class="mb-1">Jobs available</h5>
                                <p class="text-muted small mb-0">Browse job opportunities every day</p>
                            </div>

                        </div>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <a href="/candidates-ready" class="text-decoration-none text-dark">
                        <div class="card shadow-lg border-0 h-100 p-4">
                            
                            <h5 class="fw-bold">1k+</h5>
                            <h5 class="">Candidates Ready to Apply</h5>
                            <p class="text-muted small mt-1 mb-3">
                                Find the right talent for your team
                            </p>

                            <button class="btn btn-custom-dark btn-sm p-2 w-auto">
                                Get started
                            </button>

                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>

    <footer class="custom-footer text-white py-5">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3">Where opportunities begin</h2>
                    <p class="small opacity-75">Built with clarity, helping you hire better every day</p>
                    <a href="#" class="btn btn-danger px-4 py-2 mt-2">Join now</a>
                </div>

                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="list-unstyled">
                        <div class="footer-link-item">
                            <a href="#">Job seekers</a>
                            <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="footer-link-item">
                            <a href="#">Employers</a>
                            <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="footer-link-item">
                            <a href="#">About us</a>
                            <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                        <div class="footer-link-item">
                            <a href="#">Contact</a>
                            <span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-3">
                <h1 class="fw-bolder display-4 mb-3">HobLoop</h1>
            </div>

            <hr class="border-light opacity-50 my-3">

            <p class="small opacity-75 mb-0">
                © 2025 Developed by **University State of Malang's Students** - All rights reserved
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>