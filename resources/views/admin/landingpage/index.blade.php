@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Landing Page Management</h1>
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carousel</h5>
                    <a href="{{ route('admin.landingpage.carousel.index') }}" class="btn btn-primary">Manage Carousel</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Foto Layanan</h5>
                    <a href="{{ route('admin.landingpage.fotoLayanan.index') }}" class="btn btn-primary">Manage Foto Layanan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jejak Langkah</h5>
                    <a href="{{ route('admin.landingpage.jejaklangkah.index') }}" class="btn btn-primary">Manage Jejak Langkah</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sekilas Perusahaan</h5>
                    <a href="{{ route('admin.landingpage.sekilas.index') }}" class="btn btn-primary">Manage Sekilas Perusahaan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sertifikat & Penghargaan</h5>
                    <a href="{{ route('admin.landingpage.sertifikat-penghargaan.index') }}" class="btn btn-primary">Manage Sertifikat & Penghargaan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Visi Misi & Budaya</h5>
                    <a href="{{ route('admin.landingpage.visimisi.index') }}" class="btn btn-primary">Manage Visi Misi & Budaya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection