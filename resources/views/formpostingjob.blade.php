<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobLoop - Form Posting Job</title>

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

        <form action="{{ isset($job) ? route('job.update', $job->id) : route('job.store') }}" method="POST">
             @csrf
             @if(isset($job))
                @method('PUT')
             @endif
            <div class="mb-4">
                <label for="companyName" class="posting-text">Company name</label>
                <p class="text-secondary-form mb-2 small">Enter the official company name and full address (street,
                    city,
                    country). Helps candidates know where they'll be working.</p>
                <input type="text" class="form-control" id="companyName" name="company_name" placeholder="" value="{{ isset($job) ? Auth::user()->company->nama_perusahaan : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="jobAddress" class="posting-text">Job address</label>
                <p class="text-secondary-form mb-2 small">Write the full workplace address (street, city,
                    province/country).
                    Helps candidates understand the job location clearly.</p>
                <input type="text" class="form-control" id="jobAddress" name="job_address" placeholder="" value="{{ isset($job) ? $job->lokasi : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="jobTitle" class="posting-text">Job title</label>
                <p class="text-secondary-form mb-2 small">Provide the exact job title (e.g., "Backend Engineer,"
                    "Kitchen
                    Staff").</p>
                <input type="text" class="form-control" id="jobTitle" name="nama_pekerjaan" placeholder="" value="{{ isset($job) ? $job->nama_pekerjaan : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="jobType" class="posting-text">Job Type</label>
                <p class="text-secondary-form mb-2 small">Select the role type (Full-time, Part-time, Contract,
                    Internship, Remote, Hybrid). Be straight about schedule and flexibility.</p>

                <select class="form-control" id="jobType" name="jobType" required>
                    <option value="" disabled @if(!isset($job)) selected @endif>Select Job Type</option>
                    <option value="full-time" @if(isset($job) && $job->jenis_pekerjaan === 'full-time') selected @endif>Full-time</option>
                    <option value="part-time" @if(isset($job) && $job->jenis_pekerjaan === 'part-time') selected @endif>Part-time</option>
                    <option value="contract" @if(isset($job) && $job->jenis_pekerjaan === 'contract') selected @endif>Contract</option>
                    <option value="internship" @if(isset($job) && $job->jenis_pekerjaan === 'internship') selected @endif>Internship</option>
                    <option value="remote" @if(isset($job) && $job->jenis_pekerjaan === 'remote') selected @endif>Remote</option>
                    <option value="hybrid" @if(isset($job) && $job->jenis_pekerjaan === 'hybrid') selected @endif>Hybrid</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="experience" class="posting-text">Experience</label>
                <p class="text-secondary-form mb-2 small">State required experience level (e.g., 1-2 years, fresh
                    graduate
                    welcome). Mention key field or tools if needed.</p>
                <input type="text" class="form-control" id="experience" name="pengalaman_minimal" placeholder="" value="{{ isset($job) ? $job->pengalaman_minimal : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="minEducation" class="posting-text">Minimum Education</label>
                <p class="text-secondary-form mb-2 small">Specify the minimum education requirement (e.g., Bachelor's
                    Degree, Diploma, High School, or Not Required).</p>
                <input type="text" class="form-control" id="minEducation" name="pendidikan_minimal" placeholder="" value="{{ isset($job) ? $job->pendidikan_minimal : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="salary" class="posting-text">Salary</label>
                <p class="text-secondary-form mb-2 small">Include salary range or fixed amount + currency (e.g., IDR
                    6.000.000 - 9.000.000 / month). Transparency attracts more candidates.</p>
                <input type="text" class="form-control" id="salary" name="gaji" placeholder="" value="{{ isset($job) ? $job->gaji : '' }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="posting-text">Description</label>
                <p class="text-secondary-form mb-2 small">Describe the responsibilities and must-have skills in short
                    and clear points. Separate must-haves and nice-to-haves.</p>

                <textarea class="form-control" style="border: 2px solid #003366" id="description" name="deskripsi_kualifikasi" rows="5"
                    required>{{ isset($job) ? $job->deskripsi_kualifikasi : '' }}</textarea>
            </div>

            <div class="text-end" style="margin-top: 50px;">
                @if(isset($job))
                    <a href="{{ route('job.list') }}" class="btn btn-secondary me-2">
                        Cancel
                    </a>
                @endif
                <button type="submit" class="btn-save-posting text-white border-0">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    {{ isset($job) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
