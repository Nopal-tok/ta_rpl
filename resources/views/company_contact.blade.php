<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HobLoop - Kontak Perusahaan</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-transparent shadow-0 border-0 p-0">
        <div class="container-fluid p-4">
            <a class="logo-header navbar-brand fw-bold me-5" href="{{ route('landing') }}">HobLoop</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-3">{{ $company->nama_perusahaan ?? 'Perusahaan' }}</h2>

                <p class="mb-3">{{ $company->about ?? '-' }}</p>

                <div class="mb-3">
                    <strong>Email:</strong>
                    <div>{{ $company->email_perusahaan ?? '-' }}</div>
                </div>

                <div class="mb-3">
                    <strong>Telepon:</strong>
                    <div>{{ $company->nomor_telepon ?? '-' }}</div>
                </div>

                <div class="mb-3">
                    <strong>Alamat:</strong>
                    <div>{{ $company->alamat_perusahaan ?? '-' }}</div>
                </div>

                @php
                    $email = $company->email_perusahaan ?? '';
                    $phoneRaw = $company->nomor_telepon ?? '';
                    $phoneDigits = preg_replace('/\D+/', '', $phoneRaw);
                    // If phone starts with 0, assume Indonesian number and convert to country code 62
                    if ($phoneDigits && preg_match('/^0/', $phoneDigits)) {
                        $phoneDigits = '62' . substr($phoneDigits, 1);
                    }

                    $gmailUrl = $email ? 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($email) . '&su=' . urlencode('Pertanyaan Lowongan') : null;
                    $whatsappUrl = $phoneDigits ? 'https://wa.me/' . $phoneDigits . '?text=' . urlencode('Halo, saya tertarik dengan lowongan di ' . ($company->nama_perusahaan ?? 'Perusahaan Anda') . '.') : null;
                @endphp

                <div class="mt-4">
                    @if($gmailUrl)
                        <a href="{{ $gmailUrl }}" target="_blank" rel="noopener" class="btn btn-primary me-2">Hubungi via Gmail</a>
                    @elseif(!empty($email))
                        <a href="mailto:{{ $email }}" class="btn btn-primary me-2">Hubungi via Email</a>
                    @endif

                    @if($whatsappUrl)
                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn btn-success">Hubungi via WhatsApp</a>
                    @elseif(!empty($phoneRaw))
                        <a href="tel:{{ $phoneRaw }}" class="btn btn-secondary">Hubungi via Telepon</a>
                    @endif

                    <a href="{{ route('landing') }}" class="btn btn-link ms-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
