@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Manage Facility Management Carousel</h1>
    <button class="btn btn-primary" id="addCarouselBtn" data-bs-toggle="modal" data-bs-target="#carouselModal">Add Image</button>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carousels as $carousel)
            <tr>
                <td><img src="{{ asset('images/' . $carousel->image) }}" width="100" height="50" /></td>
                <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $carousel->id }}" data-image="{{ asset('images/' . $carousel->image) }}" data-bs-toggle="modal" data-bs-target="#carouselModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-id="{{ $carousel->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="carouselModal" tabindex="-1" aria-labelledby="carouselModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="carouselForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="POST"> <!-- Ini default untuk store -->
                <input type="hidden" id="id" name="id"> <!-- Untuk menyimpan ID jika mengedit -->
                <div class="modal-header">
                    <h5 class="modal-title" id="carouselModalLabel">Add/Edit Carousel Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
    document.getElementById('addCarouselBtn').addEventListener('click', function() {
        document.getElementById('carouselForm').reset();
        document.getElementById('carouselModalLabel').textContent = 'Add Carousel Image';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var image = this.getAttribute('data-image');

            document.getElementById('carouselModalLabel').textContent = 'Edit Carousel Image';
            document.getElementById('id').value = id;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';

            // Ubah metode menjadi PUT saat mengedit
            document.querySelector('input[name="_method"]').value = 'PUT';
        });
    });

    document.getElementById('carouselForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var id = document.getElementById('id').value;
    var form = document.getElementById('carouselForm');
    var formData = new FormData(form);
    
    // Tentukan URL dan metode HTTP
    var url = id ? `{{ route('admin.facilitymanagement.carouselFM.update', '') }}/${id}` : `{{ route('admin.facilitymanagement.carouselFM.store') }}`;
    var method = id ? 'POST' : 'POST'; // Laravel akan menangani PUT via POST dengan spoofing
    
    if (id) {
        formData.append('_method', 'PUT'); // Spoofing metode PUT untuk update
    }

    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            var modal = bootstrap.Modal.getInstance(document.getElementById('carouselModal'));
            modal.hide();
            
            Swal.fire({
                title: 'Success!',
                text: 'Carousel image saved successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload();
            });
        } else {
            throw new Error(data.message || 'Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: error.message || 'An unexpected error occurred.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.facilitymanagement.carouselFM.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });
    });

    document.getElementById('image').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewImage').style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
