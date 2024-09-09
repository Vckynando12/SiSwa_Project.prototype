<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Landing Page
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.carousel.index') }}">Carousel</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.fotoLayanan.index') }}">Foto Layanan</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.jejaklangkah.index') }}">Jejak Langkah</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.sekilas.index') }}">Sekilas Perusahaan</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.sertifikat-penghargaan.index') }}">Sertifikat & Penghargaan</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.landingpage.visimisi.index') }}">Visi Misi & Budaya</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            FacilityManagement
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.facilitymanagement.carouselFM.index') }}">Carousel</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.facilitymanagement.gambarFM.index') }}">Gambar</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.textfm.index') }}">Text</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            swasegar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.swasegar.carousel.index') }}">Carousel</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.swasegar.gambarSS.index') }}">Gambar</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.swasegar.textss.index') }}">Text</a></li>
                        </ul>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
