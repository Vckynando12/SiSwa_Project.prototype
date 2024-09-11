@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Manage Academy Images</h1>

    <div class="row">
        @foreach(['gambar1', 'gambar2'] as $gambar)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ ucfirst($gambar) }}</h5>
                </div>
                <div class="card-body">
                    @if($gambarAcademy && $gambarAcademy->$gambar)
                        <img src="{{ asset('storage/' . $gambarAcademy->$gambar) }}" class="img-fluid mb-2" alt="{{ ucfirst($gambar) }}">
                        <div>
                            <button class="btn btn-warning editBtn" data-id="{{ $gambarAcademy->id }}" data-gambar="{{ $gambar }}" data-image="{{ asset('storage/' . $gambarAcademy->$gambar) }}" data-bs-toggle="modal" data-bs-target="#imageModal">Edit</button>
                            <button class="btn btn-danger deleteBtn" data-id="{{ $gambarAcademy->id }}" data-gambar="{{ $gambar }}">Delete</button>
                        </div>
                    @else
                        <p>No image uploaded</p>
                        <button class="btn btn-primary addBtn" data-gambar="{{ $gambar }}" data-bs-toggle="modal" data-bs-target="#imageModal">Add Image</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="imageForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Add/Edit Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="{{ $gambarAcademy ? $gambarAcademy->id : '' }}">
                    <input type="hidden" id="gambarType" name="gambarType">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img id="previewImage" src="#" alt="Image Preview" style="width: 100%; margin-top: 10px; display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // ... existing JavaScript code for handling modal and image upload ...
    // Add event listeners for add, edit, and delete buttons
</script>
@endsection