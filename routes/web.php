<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\SekilasPerusahaanController;
use App\Http\Controllers\JejakLangkahController;
use App\Http\Controllers\VisiMisiBudayaController;
use App\Http\Controllers\SertifikatPenghargaanController;
use App\Http\Controllers\FotoLayananController;
use App\Http\Controllers\FacilityManagement\CarouselFMController;
use App\Http\Controllers\FacilityManagement\GambarFMController;
use App\Http\Controllers\FacilityManagement\TextFMController;
use App\Http\Controllers\FacilityManagement\FacilityManagementController;
use App\Http\Controllers\Swasegar\SwasegarCarouselController;
use App\Http\Controllers\Swasegar\GambarSSController;
use App\Http\Controllers\Swasegar\TextSSController;
use App\Http\Controllers\Swasegar\SwasegarController;
use App\Http\Controllers\Swatour\CarouselteoController;
use App\Http\Controllers\Swatour\GambarteoController;
use App\Http\Controllers\Swatour\TextteoController;
use App\Http\Controllers\Swatour\SwatourorganizerController;
use App\Http\Controllers\Digitalsolution\CarouseldsController;
use App\Http\Controllers\Digitalsolution\DigitalSolutionController;
use App\Http\Controllers\Digitalsolution\GambardsController;
use App\Http\Controllers\Digitalsolution\TextdsController;

// Route untuk halaman utama
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('landingpage');

// Routes untuk Auth (Login, Register, Logout)
Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('auth/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'register']);

// Routes untuk admin
Route::middleware('admin')->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [CarouselController::class, 'index'])->name('admin.dashboard');

    // Landing Page routes
    Route::get('/landingpage', function () {
        return view('admin.landingpage.index');
    })->name('admin.landingpage.index');

    // Routes untuk Carousel CRUD
    Route::prefix('carousel')->group(function () {
        Route::get('/', [CarouselController::class, 'showCarousel'])->name('admin.landingpage.carousel.index');
        Route::post('/store', [CarouselController::class, 'store'])->name('admin.landingpage.carousel.store');
        Route::put('/update/{id}', [CarouselController::class, 'update'])->name('admin.landingpage.carousel.update');
        Route::delete('/delete/{id}', [CarouselController::class, 'destroy'])->name('admin.landingpage.carousel.destroy');
    });

    // Routes untuk Sekilas Perusahaan CRUD
    Route::prefix('sekilas')->group(function () {
        Route::get('/', [SekilasPerusahaanController::class, 'index'])->name('admin.landingpage.sekilas.index');
        Route::post('/store', [SekilasPerusahaanController::class, 'store'])->name('admin.landingpage.sekilas.store');
        Route::put('/update/{id}', [SekilasPerusahaanController::class, 'update'])->name('admin.landingpage.sekilas.update');
        Route::delete('/delete/{id}', [SekilasPerusahaanController::class, 'destroy'])->name('admin.landingpage.sekilas.destroy');
    });

    // Routes untuk Jejak Langkah CRUD
    Route::prefix('jejaklangkah')->group(function () {
        Route::get('/', [JejakLangkahController::class, 'index'])->name('admin.landingpage.jejaklangkah.index');
        Route::post('/store', [JejakLangkahController::class, 'store'])->name('admin.landingpage.jejaklangkah.store');
        Route::put('/update/{id}', [JejakLangkahController::class, 'update'])->name('admin.landingpage.jejaklangkah.update');
        Route::delete('/delete/{id}', [JejakLangkahController::class, 'destroy'])->name('admin.landingpage.jejaklangkah.destroy');
    });

    // Routes untuk Visi Misi Budaya CRUD
    Route::prefix('visimisi')->group(function () {
        Route::get('/', [VisiMisiBudayaController::class, 'index'])->name('admin.landingpage.visimisi.index');
        Route::post('/store', [VisiMisiBudayaController::class, 'store'])->name('admin.landingpage.visimisi.store');
        Route::put('/update/{id}', [VisiMisiBudayaController::class, 'update'])->name('admin.landingpage.visimisi.update');
        Route::delete('/delete/{id}', [VisiMisiBudayaController::class, 'destroy'])->name('admin.landingpage.visimisi.destroy');
    });

    // Routes untuk Sertifikat Penghargaan CRUD
    Route::prefix('sertifikat-penghargaan')->group(function () {
        Route::get('/', [SertifikatPenghargaanController::class, 'index'])->name('admin.landingpage.sertifikat-penghargaan.index');
        Route::post('/store', [SertifikatPenghargaanController::class, 'store'])->name('admin.landingpage.sertifikat-penghargaan.store');
        Route::put('/update/{id}', [SertifikatPenghargaanController::class, 'update'])->name('admin.landingpage.sertifikat-penghargaan.update');
        Route::delete('/delete/{id}', [SertifikatPenghargaanController::class, 'destroy'])->name('admin.landingpage.sertifikat-penghargaan.destroy');
    });

    // Routes untuk Foto Layanan CRUD
    Route::prefix('foto-layanan')->group(function () {
        Route::get('/', [FotoLayananController::class, 'index'])->name('admin.landingpage.fotoLayanan.index');
        Route::post('/store', [FotoLayananController::class, 'store'])->name('admin.foto-layanan.store');
        Route::put('/update/{id}', [FotoLayananController::class, 'update'])->name('admin.foto-layanan.update');
        Route::delete('/destroy/{id}', [FotoLayananController::class, 'destroy'])->name('admin.landingpage.fotoLayanan.destroy');
    });

    // Routes untuk Facility Management CRUD
    Route::prefix('facilitymanagement')->group(function () {
        // Carousel FM
        Route::prefix('carouselFM')->group(function () {
            Route::get('/', [CarouselFMController::class, 'index'])->name('admin.facilitymanagement.carouselFM.index');
            Route::post('/store', [CarouselFMController::class, 'store'])->name('admin.facilitymanagement.carouselFM.store');
            Route::put('/update/{id}', [CarouselFMController::class, 'update'])->name('admin.facilitymanagement.carouselFM.update');
            Route::delete('/destroy/{id}', [CarouselFMController::class, 'destroy'])->name('admin.facilitymanagement.carouselFM.destroy');
        });

        // Gambar FM
        Route::prefix('gambarFM')->group(function () {
            Route::get('/', [GambarFMController::class, 'index'])->name('admin.facilitymanagement.gambarFM.index');
            Route::post('/store', [GambarFMController::class, 'store'])->name('admin.facilitymanagement.gambarFM.store');
            Route::put('/update/{id}', [GambarFMController::class, 'update'])->name('admin.facilitymanagement.gambarFM.update');
            Route::delete('/destroy/{id}', [GambarFMController::class, 'destroy'])->name('admin.facilitymanagement.gambarFM.destroy');
        });

        // Text FM
        Route::prefix('textfm')->group(function () {
            Route::get('/', [TextFMController::class, 'index'])->name('admin.textfm.index');
            Route::post('/store', [TextFMController::class, 'store'])->name('admin.textfm.store');
            Route::put('/update/{id}', [TextFMController::class, 'update'])->name('admin.textfm.update');
            Route::delete('/destroy/{id}', [TextFMController::class, 'destroy'])->name('admin.textfm.destroy');
        });
    });

    // Routes untuk Swasegar CRUD
    Route::prefix('swasegar')->group(function () {
        // Carousel Swasegar
        Route::prefix('carousel')->group(function () {
            Route::get('/', [SwasegarCarouselController::class, 'index'])->name('admin.swasegar.carousel.index');
            Route::post('/store', [SwasegarCarouselController::class, 'store'])->name('admin.swasegar.carousel.store');
            Route::put('/update/{id}', [SwasegarCarouselController::class, 'update'])->name('admin.swasegar.carousel.update');
            Route::delete('/destroy/{id}', [SwasegarCarouselController::class, 'destroy'])->name('admin.swasegar.carousel.destroy');
        });

        // Gambar SS
        Route::prefix('gambarSS')->group(function () {
            Route::get('/', [GambarSSController::class, 'index'])->name('admin.swasegar.gambarSS.index');
            Route::post('/', [GambarSSController::class, 'store'])->name('admin.swasegar.gambarSS.store');
            Route::put('/{id}', [GambarSSController::class, 'update'])->name('admin.swasegar.gambarSS.update');
            Route::delete('/{id}', [GambarSSController::class, 'destroy'])->name('admin.swasegar.gambarSS.destroy');
        });

        // Text SS
        Route::prefix('textss')->group(function () {
            Route::get('/', [TextSSController::class, 'index'])->name('admin.swasegar.textss.index');
            Route::post('/store', [TextSSController::class, 'store'])->name('admin.swasegar.textss.store');
            Route::put('/update/{id}', [TextSSController::class, 'update'])->name('admin.swasegar.textss.update');
            Route::delete('/destroy/{id}', [TextSSController::class, 'destroy'])->name('admin.swasegar.textss.destroy');
        });
    });

    // Routes untuk Swatour CRUD
    Route::prefix('swatour')->group(function () {
        // Carousel Teo
        Route::prefix('carouselteo')->group(function () {
            Route::get('/', [CarouselteoController::class, 'index'])->name('admin.swatour.carouselteo.index');
            Route::post('/store', [CarouselteoController::class, 'store'])->name('admin.swatour.carouselteo.store');
            Route::put('/update/{id}', [CarouselteoController::class, 'update'])->name('admin.swatour.carouselteo.update');
            Route::delete('/destroy/{id}', [CarouselteoController::class, 'destroy'])->name('admin.swatour.carouselteo.destroy');
        });

        // Gambarteo
        Route::prefix('gambarteo')->group(function () {
            Route::get('/', [GambarteoController::class, 'index'])->name('admin.swatour.gambarteo.index');
            Route::post('/store', [GambarteoController::class, 'store'])->name('admin.swatour.gambarteo.store');
            Route::put('/update/{id}', [GambarteoController::class, 'update'])->name('admin.swatour.gambarteo.update');
            Route::delete('/destroy/{id}', [GambarteoController::class, 'destroy'])->name('admin.swatour.gambarteo.destroy');
        });

        // Text Teo
        Route::prefix('textteo')->group(function () {
            Route::get('/', [TextteoController::class, 'index'])->name('admin.swatour.textteo.index');
            Route::post('/store', [TextteoController::class, 'store'])->name('admin.swatour.textteo.store');
            Route::put('/update/{id}', [TextteoController::class, 'update'])->name('admin.swatour.textteo.update');
            Route::delete('/destroy/{id}', [TextteoController::class, 'destroy'])->name('admin.swatour.textteo.destroy');
        });
    });

    // Routes untuk Digitalsolution CRUD
    Route::prefix('digitalsolution')->group(function () {
        // Carouselds
        Route::prefix('carouselds')->group(function () {
            Route::get('/', [CarouseldsController::class, 'index'])->name('admin.digitalsolution.carouselds.index');
            Route::post('/store', [CarouseldsController::class, 'store'])->name('admin.digitalsolution.carouselds.store');
            Route::put('/update/{id}', [CarouseldsController::class, 'update'])->name('admin.digitalsolution.carouselds.update');
            Route::delete('/delete/{id}', [CarouseldsController::class, 'destroy'])->name('admin.digitalsolution.carouselds.destroy');
        });

        // Gambards
        Route::prefix('gambards')->group(function () {
            Route::get('/', [GambardsController::class, 'index'])->name('admin.digitalsolution.gambards.index');
            Route::post('/store', [GambardsController::class, 'store'])->name('admin.digitalsolution.gambards.store');
            Route::put('/update/{id}', [GambardsController::class, 'update'])->name('admin.digitalsolution.gambards.update');
            Route::delete('/destroy/{id}', [GambardsController::class, 'destroy'])->name('admin.digitalsolution.gambards.destroy');
        });

        // Textds
        Route::prefix('textds')->group(function () {
            Route::get('/', [TextdsController::class, 'index'])->name('admin.digitalsolution.textds.index');
            Route::post('/store', [TextdsController::class, 'store'])->name('admin.digitalsolution.textds.store');
            Route::put('/update/{id}', [TextdsController::class, 'update'])->name('admin.digitalsolution.textds.update');
            Route::delete('/destroy/{id}', [TextdsController::class, 'destroy'])->name('admin.digitalsolution.textds.destroy');
        });
    });
});

// Routes untuk halaman public
Route::get('/facility-management', [FacilityManagementController::class, 'index'])->name('facility-management');
Route::get('/swasegar', [SwasegarController::class, 'index'])->name('swasegar');
Route::get('/swatour', [SwatourorganizerController::class, 'index'])->name('swatour');
Route::get('/Digital-Solution', [DigitalSolutionController::class, 'index'])->name('digitalsolution');
