<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\CompanyOverviewController;
use App\Http\Controllers\Digitalsolution\CarouseldsController;
use App\Http\Controllers\Digitalsolution\GambardsController;
use App\Http\Controllers\Digitalsolution\TextdsController;
use App\Http\Controllers\FacilityManagement\CarouselFMController;
use App\Http\Controllers\FotoLayananController;
use App\Http\Controllers\JejakLangkahController;
use App\Http\Controllers\SekilasPerusahaanController;
use App\Http\Controllers\SertifikatPenghargaanController;
use App\Http\Controllers\VisiMisiBudayaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FacilityManagement\FacilityManagementController;
use App\Http\Controllers\facilitymanagement\GambarFMController;
use App\Http\Controllers\FacilityManagement\TextFMController;
use App\Http\Controllers\Swasegar\GambarSSController;
use App\Http\Controllers\swasegar\SwasegarCarouselController;
use App\Http\Controllers\Swasegar\SwasegarController;
use App\Http\Controllers\Swasegar\TextSSController;
use App\Http\Controllers\Swatour\CarouselteoController;
use App\Http\Controllers\Swatour\GambarteoController;
use App\Http\Controllers\Swatour\SwatourorganizerController;
use App\Http\Controllers\Swatour\TextteoController;

// Route untuk halaman utama
Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/carouselFM', [WelcomeController::class, 'index'])->name('');

// Routes untuk admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [CarouselController::class, 'index'])->name('admin.dashboard');
    
    // Landing Page routes
    Route::get('admin/landingpage', function () {
        return view('admin.landingpage.index');
    })->name('admin.landingpage.index');

    // Routes untuk Carousel CRUD
    Route::get('/admin/carousel', [CarouselController::class, 'showCarousel'])->name('admin.landingpage.carousel.index');
    Route::post('/admin/carousel/store', [CarouselController::class, 'store'])->name('admin.landingpage.carousel.store');
    Route::post('/admin/carousel/update/{id}', [CarouselController::class, 'update'])->name('admin.landingpage.carousel.update');
    Route::delete('/admin/carousel/delete/{id}', [CarouselController::class, 'destroy'])->name('admin.landingpage.carousel.destroy');
    
    // Routes untuk Sekilas Perusahaan CRUD
    Route::get('/admin/sekilas', [SekilasPerusahaanController::class, 'index'])->name('admin.landingpage.sekilas.index');
    Route::post('/admin/sekilas/store', [SekilasPerusahaanController::class, 'store'])->name('admin.landingpage.sekilas.store');
    Route::post('/admin/sekilas/update/{id}', [SekilasPerusahaanController::class, 'update'])->name('admin.landingpage.sekilas.update');
    Route::delete('/admin/sekilas/delete/{id}', [SekilasPerusahaanController::class, 'destroy'])->name('admin.landingpage.sekilas.destroy');

    // Routes untuk Jejak Langkah CRUD
    Route::get('/admin/jejaklangkah', [JejakLangkahController::class, 'index'])->name('admin.landingpage.jejaklangkah.index');
    Route::post('/admin/jejaklangkah/store', [JejakLangkahController::class, 'store'])->name('admin.landingpage.jejaklangkah.store');
    Route::put('/admin/jejaklangkah/update/{id}', [JejakLangkahController::class, 'update'])->name('admin.landingpage.jejaklangkah.update');
    Route::delete('/admin/jejaklangkah/delete/{id}', [JejakLangkahController::class, 'destroy'])->name('admin.landingpage.jejaklangkah.destroy');

    Route::get('/admin/visimisi', [VisiMisiBudayaController::class, 'index'])->name('admin.landingpage.visimisi.index');
    Route::post('/admin/visimisi/store', [VisiMisiBudayaController::class, 'store'])->name('admin.landingpage.visimisi.store');
    Route::put('/admin/visimisi/update/{id}', [VisiMisiBudayaController::class, 'update'])->name('admin.landingpage.visimisi.update');
    Route::delete('/admin/visimisi/delete/{id}', [VisiMisiBudayaController::class, 'destroy'])->name('admin.landingpage.visimisi.destroy');

    Route::get('/admin/sertifikat-penghargaan', [SertifikatPenghargaanController::class, 'index'])->name('admin.landingpage.sertifikat-penghargaan.index');
    Route::post('/admin/sertifikat-penghargaan/store', [SertifikatPenghargaanController::class, 'store'])->name('admin.landingpage.sertifikat-penghargaan.store');
    Route::put('/admin/sertifikat-penghargaan/update/{id}', [SertifikatPenghargaanController::class, 'update'])->name('admin.landingpage.sertifikat-penghargaan.update');
    Route::delete('/admin/sertifikat-penghargaan/delete/{id}', [SertifikatPenghargaanController::class, 'destroy'])->name('admin.landingpage.sertifikat-penghargaan.destroy');

    Route::get('/admin/foto-layanan', [FotoLayananController::class, 'index'])->name('admin.landingpage.fotoLayanan.index');
    Route::post('/admin/foto-layanan/store', [FotoLayananController::class, 'store'])->name('admin.foto-layanan.store');
    Route::post('/admin/foto-layanan/update/{id}', [FotoLayananController::class, 'update'])->name('admin.foto-layanan.update');
    Route::delete('/admin/foto-layanan/destroy/{id}', [FotoLayananController::class, 'destroy'])->name('admin.landingpage.fotoLayanan.destroy');

    Route::get('/admin/facilitymanagement/carouselFM', [CarouselFMController::class, 'index'])->name('admin.facilitymanagement.carouselFM.index');
    Route::post('/admin/facilitymanagement/carouselFM', [CarouselFMController::class, 'store'])->name('admin.facilitymanagement.carouselFM.store');
    Route::post('/admin/facilitymanagement/carouselFM/{id}', [CarouselFMController::class, 'update'])->name('admin.facilitymanagement.carouselFM.update');
    Route::delete('/admin/facilitymanagement/carouselFM/{id}', [CarouselFMController::class, 'destroy'])->name('admin.facilitymanagement.carouselFM.destroy');

    Route::get('/admin/facilitymanagement/gambarFM', [GambarFMController::class, 'index'])->name('admin.facilitymanagement.gambarFM.index');
    Route::post('/admin/facilitymanagement/gambarFM', [GambarFMController::class, 'store'])->name('admin.facilitymanagement.gambarFM.store');
    Route::put('/admin/facilitymanagement/gambarFM/{id}', [GambarFMController::class, 'update'])->name('admin.facilitymanagement.gambarFM.update');
    Route::delete('/admin/facilitymanagement/gambarFM/{id}', [GambarFMController::class, 'destroy'])->name('admin.facilitymanagement.gambarFM.destroy');

    Route::get('/admin/facilitymanagement/textfm', [TextFMController::class, 'index'])->name('admin.textfm.index');
    Route::post('/admin/facilitymanagement/textfm/store', [TextFMController::class, 'store'])->name('admin.textfm.store');
    Route::post('/admin/facilitymanagement/textfm/update/{id}', [TextFMController::class, 'update'])->name('admin.textfm.update');
    Route::delete('/admin/facilitymanagement/textfm/destroy/{id}', [TextFMController::class, 'destroy'])->name('admin.textfm.destroy');
    
    Route::get('/admin/swasegar/carousel', [SwasegarCarouselController::class, 'index'])->name('admin.swasegar.carousel.index');
    Route::post('/admin/swasegar/carousel/store', [SwasegarCarouselController::class, 'store'])->name('admin.swasegar.carousel.store');
    Route::put('/admin/swasegar/carousel/update/{id}', [SwasegarCarouselController::class, 'update'])->name('admin.swasegar.carousel.update');
    Route::delete('/admin/swasegar/carousel/destroy/{id}', [SwasegarCarouselController::class, 'destroy'])->name('admin.swasegar.carousel.destroy');

    Route::get('/admin/swasegar/gambarSS', [GambarSSController::class, 'index'])->name('admin.swasegar.gambarSS.index');
    Route::post('/admin/swasegar/gambarSS', [GambarSSController::class, 'store'])->name('admin.swasegar.gambarSS.store');
    Route::put('/admin/swasegar/gambarSS/{id}', [GambarSSController::class, 'update'])->name('admin.swasegar.gambarSS.update');
    Route::delete('/admin/swasegar/gambarSS/{id}', [GambarSSController::class, 'destroy'])->name('admin.swasegar.gambarSS.destroy');

    Route::get('/admin/swasegar/textss', [TextSSController::class, 'index'])->name('admin.swasegar.textss.index');
    Route::post('/admin/swasegar/textss/store', [TextSSController::class, 'store'])->name('admin.swasegar.textss.store');
    Route::put('/admin/swasegar/textss/update/{id}', [TextSSController::class, 'update'])->name('admin.swasegar.textss.update');
    Route::delete('/admin/swasegar/textss/destroy/{id}', [TextSSController::class, 'destroy'])->name('admin.swasegar.textss.destroy');

    Route::get('/admin/swatour/carouselteo', [CarouselteoController::class, 'index'])->name('admin.swatour.carouselteo.index');
    Route::post('/admin/swatour/carouselteo/store', [CarouselteoController::class, 'store'])->name('admin.swatour.carouselteo.store');
    Route::put('/admin/swatour/carouselteo/update/{id}', [CarouselteoController::class, 'update'])->name('admin.swatour.carouselteo.update');
    Route::delete('/admin/swatour/carouselteo/destroy/{id}', [CarouselteoController::class, 'destroy'])->name('admin.swatour.carouselteo.destroy');

    Route::get('/admin/swatour/gambarteo', [GambarteoController::class, 'index'])->name('admin.swatour.gambarteo.index');
    Route::post('/admin/swatour/gambarteo/store', [GambarteoController::class, 'store'])->name('admin.swatour.gambarteo.store');
    Route::put('/admin/swatour/gambarteo/update/{id}', [GambarteoController::class, 'update'])->name('admin.swatour.gambarteo.update');
    Route::delete('/admin/swatour/gambarteo/destroy/{id}', [GambarteoController::class, 'destroy'])->name('admin.swatour.gambarteo.destroy');

    Route::get('/admin/swatour/textteo', [TextteoController::class, 'index'])->name('admin.swatour.textteo.index');
    Route::post('/admin/swatour/textteo/store', [TextteoController::class, 'store'])->name('admin.swatour.textteo.store');
    Route::put('/admin/swatour/textteo/update/{id}', [TextteoController::class, 'update'])->name('admin.swatour.textteo.update');
    Route::delete('/admin/swatour/textteo/destroy/{id}', [TextteoController::class, 'destroy'])->name('admin.swatour.textteo.destroy');

    Route::prefix('admin/digitalsolution')->group(function () {
        Route::get('carouselds', [CarouseldsController::class, 'index'])->name('admin.digitalsolution.carouselds.index');
        Route::post('carouselds/store', [CarouseldsController::class, 'store'])->name('admin.digitalsolution.carouselds.store');
        Route::post('carouselds/update/{id}', [CarouseldsController::class, 'update'])->name('admin.digitalsolution.carouselds.update');
        Route::delete('carouselds/delete/{id}', [CarouseldsController::class, 'destroy'])->name('admin.digitalsolution.carouselds.destroy');

        Route::get('gambards', [GambardsController::class, 'index'])->name('admin.digitalsolution.gambards.index');
        Route::post('gambards/store', [GambardsController::class, 'store'])->name('admin.digitalsolution.gambards.store');
        Route::put('gambards/update/{id}', [GambardsController::class, 'update'])->name('admin.digitalsolution.gambards.update');
        Route::delete('gambards/destroy/{id}', [GambardsController::class, 'destroy'])->name('admin.digitalsolution.gambards.destroy');

        Route::get('textds', [TextdsController::class, 'index'])->name('admin.digitalsolution.textds.index');
        Route::post('textds/store', [TextdsController::class, 'store'])->name('admin.digitalsolution.textds.store');
        Route::put('textds/update/{id}', [TextdsController::class, 'update'])->name('admin.digitalsolution.textds.update');
        Route::delete('textds/destroy/{id}', [TextdsController::class, 'destroy'])->name('admin.digitalsolution.textds.destroy');
    });
});

// Facility Management page route
Route::get('/facility-management', [FacilityManagementController::class, 'index'])->name('facility-management');

Route::get('/swasegar', [SwasegarController::class, 'index'])->name('swasegar');
Route::get('/swatour', [SwatourorganizerController::class, 'index'])->name('swatour');
Route::get('/digitalsolution', [SwatourorganizerController::class, 'index'])->name('digitalsolution');

// Routes untuk Auth (Login, Register, Logout)
Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('auth/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'register']);