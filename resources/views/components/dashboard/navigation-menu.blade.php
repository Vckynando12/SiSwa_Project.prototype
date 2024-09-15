<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role_id == '1')
            {{-- admin --}}
        @elseif(Auth::user()->role_id == '2')
            {{-- smd --}}
        @elseif(Auth::user()->role_id == '3')
            {{-- digital marketing --}}
        @endif
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
            <span class="hide-menu">UI COMPONENTS</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Landing Page</span>
                <span class="ms-auto">
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.carousel.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.fotoLayanan.index') }}" class="sidebar-link">
                        <span class="hide-menu">Foto dan Layanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.jejaklangkah.index') }}" class="sidebar-link">
                        <span class="hide-menu">Jejak Langkah</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.sekilas.index') }}" class="sidebar-link">
                        <span class="hide-menu">Sekilas Perusahaan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.sertifikat-penghargaan.index') }}" class="sidebar-link">
                        <span class="hide-menu">Sertifikat & Penghargaan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.visimisi.index') }}" class="sidebar-link">
                        <span class="hide-menu">Visi Misi & Budaya</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center"
                href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Facility Management</span>
                </span>
                <span>
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                    <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.facilitymanagement.carouselFM.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.facilitymanagement.gambarFM.index') }}" class="sidebar-link">
                        <span class="hide-menu">Gambar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.textfm.index') }}" class="sidebar-link">
                        <span class="hide-menu">Text Area</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center"
                href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Swa Segar</span>
                </span>
                <span>
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                    <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.swasegar.carousel.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.swasegar.gambarSS.index') }}" class="sidebar-link">
                        <span class="hide-menu">Gambar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.swasegar.textss.index') }}" class="sidebar-link">
                        <span class="hide-menu">Text</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center"
                href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Swa Tour & Organizer</span>
                </span>
                <span>
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                    <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.swatour.carouselteo.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.swatour.gambarteo.index') }}" class="sidebar-link">
                        <span class="hide-menu">Gambar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.swatour.textteo.index') }}" class="sidebar-link">
                        <span class="hide-menu">Text</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center"
                href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Digital Solution</span>
                </span>
                <span>
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                    <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.digitalsolution.carouselds.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.digitalsolution.gambards.index') }}" class="sidebar-link">
                        <span class="hide-menu">Gambar </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.digitalsolution.textds.index') }}" class="sidebar-link">
                        <span class="hide-menu">Text</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center"
                href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
                    <span class="hide-menu">Swa Academy</span>
                </span>
                <span>
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                    <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                </span>
            </a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('carouselacademy.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('gambarAcademy.index') }}" class="sidebar-link">
                        <span class="hide-menu">Gambar </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('textacademy.index') }}" class="sidebar-link">
                        <span class="hide-menu">Text</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
            <span class="hide-menu">AUTH</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('auth.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Register</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">EXTRA</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:sticker-smile-circle-2-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Icons</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Sample Page</span>
            </a>
        </li>
    </ul>
    <div class="unlimited-access hide-menu bg-primary-subtle position-relative mb-7 mt-7 rounded-3">
        <div class="d-flex">
            <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-75">Upgrade to pro</h6>
                <a href="#" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy
                    Pro</a>
            </div>
            <div class="unlimited-access-img">
                <img src="{{ asset('admin/images/backgrounds/rocket.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</nav>
