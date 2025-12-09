<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobLoop - Saved Jobs</title>

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
        <h2 class="mb-5 fw-bold">Pekerjaan yang Tersimpan</h2>

        @if($saved->count() > 0)
            <div class="row">
                @foreach($saved as $savedJob)
                    <div class="col-md-12 mb-4">
                        <div class="profile-card card shadow-sm border-0">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Job Information -->
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <a href="{{ route('job.show', $savedJob->jobListing->id) }}" class="job-title-post">
                                                {{ $savedJob->jobListing->nama_pekerjaan }}
                                            </a>
                                        </div>

                                        <p class="company-name-text fw-normal">
                                            {{ $savedJob->jobListing->company->nama_perusahaan ?? 'Perusahaan tidak tersedia' }}
                                        </p>

                                        <ul class="job-info-list">
                                            <li>
                                                <svg width="20" height="20" viewBox="0 0 40 40" fill="none">
                                                    <path d="M19.7143 16.1672V21.7145M15.6071 3.28571H23.8214M33.6786 22.0612C33.6786 29.8383 27.4265 36.1428 19.7143 36.1428C12.002 36.1428 5.75 29.8383 5.75 22.0612C5.75 14.2841 12.002 7.97958 19.7143 7.97958C27.4265 7.97958 33.6786 14.2841 33.6786 22.0612Z"
                                                        stroke="#363636" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                                {{ $savedJob->jobListing->jenis_pekerjaan }}
                                            </li>

                                            <li>
                                                <svg width="20" height="20" viewBox="0 0 40 40" fill="none">
                                                    <path d="M23.6577 15.7717C23.6577 17.9493 21.8924 19.7145 19.7148 19.7145C17.5372 19.7145 15.772 17.9493 15.772 15.7717C15.772 13.5941 17.5372 11.8288 19.7148 11.8288C21.8924 11.8288 23.6577 13.5941 23.6577 15.7717Z"
                                                        stroke="#363636" stroke-width="2" />
                                                    <path d="M19.7143 35.4857C19.7143 35.4857 32.0572 24.5143 32.0572 16.2857C32.0572 9.46896 26.5311 3.94287 19.7143 3.94287C12.8975 3.94287 7.37146 9.46896 7.37146 16.2857C7.37146 24.5143 19.7143 35.4857 19.7143 35.4857Z"
                                                        stroke="#363636" stroke-width="2" />
                                                </svg>
                                                {{ $savedJob->jobListing->lokasi ?? 'Lokasi tidak tersedia' }}
                                            </li>

                                            <li>
                                                <svg width="20" height="20" viewBox="0 0 40 40" fill="none">
                                                    <path d="M3.94287 12.8143C3.94287 11.1811 5.26683 9.85712 6.90001 9.85712H32.5286C34.1618 9.85712 35.4857 11.1811 35.4857 12.8143V26.6143C35.4857 28.2474 34.1618 29.5714 32.5286 29.5714H6.90001C5.26683 29.5714 3.94287 28.2474 3.94287 26.6143V12.8143Z"
                                                        stroke="#363636" stroke-width="2" />
                                                    <path d="M23.6572 19.7143C23.6572 21.8918 21.8919 23.6571 19.7143 23.6571C17.5367 23.6571 15.7714 21.8918 15.7714 19.7143C15.7714 17.5367 17.5367 15.7714 19.7143 15.7714C21.8919 15.7714 23.6572 17.5367 23.6572 19.7143Z"
                                                        stroke="#363636" stroke-width="2" />
                                                </svg>
                                                Rp {{ number_format($savedJob->jobListing->gaji, 0, ',', '.') }}
                                            </li>
                                        </ul>

                                        <div class="mt-3">
                                            <small class="text-muted">
                                                Disimpan pada: {{ $savedJob->created_at->format('d M Y H:i') }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="col-md-4 d-flex flex-column justify-content-between align-items-end">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('job.show', $savedJob->jobListing->id) }}" class="btn btn-primary btn-sm">
                                                Lihat Detail
                                            </a>
                                            <form action="{{ route('saved.remove', $savedJob->jobListing->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Belum ada pekerjaan yang disimpan</h4>
                <p>Anda belum menyimpan pekerjaan apapun. <a href="{{ route('landing') }}">Cari pekerjaan sekarang</a></p>
            </div>
        @endif

        <div class="mt-5">
            <a href="{{ route('landing') }}" class="btn btn-secondary">Kembali ke Pencarian</a>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
