@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Visi Misi dan Budaya</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-4">
            <form action="{{ route('admin.landingpage.visimisi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="visi">Visi:</label>
                    <textarea class="form-control" name="visi" rows="3">{{ isset($editVisiMisiBudaya) ? $editVisiMisiBudaya->visi : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="misi">Misi:</label>
                    <textarea class="form-control" name="misi" rows="3">{{ isset($editVisiMisiBudaya) ? $editVisiMisiBudaya->misi : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="budaya">Budaya:</label>
                    <textarea class="form-control" name="budaya" rows="3">{{ isset($editVisiMisiBudaya) ? $editVisiMisiBudaya->budaya : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ isset($editVisiMisiBudaya) ? 'Update' : 'Submit' }}
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        @foreach ($data as $item)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    @if($item->visi)
                        <h5 class="card-title">Visi</h5>
                        <p class="card-text">{{ $item->visi }}</p>
                    @endif

                    @if($item->misi)
                        <h5 class="card-title">Misi</h5>
                        <p class="card-text">{{ $item->misi }}</p>
                    @endif

                    @if($item->budaya)
                        <h5 class="card-title">Budaya</h5>
                        <p class="card-text">{{ $item->budaya }}</p>
                    @endif

                    <a href="{{ route('admin.landingpage.visimisi.index') }}?edit={{ $item->id }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.landingpage.visimisi.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
