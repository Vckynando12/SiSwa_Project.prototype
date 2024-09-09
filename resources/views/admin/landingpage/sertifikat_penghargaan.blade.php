@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Manage Sertifikat & Penghargaan</h1>
    <button class="btn btn-primary" id="addCertificateBtn" data-bs-toggle="modal" data-bs-target="#certificateModal">Add Sertifikat/Penghargaan</button>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td><img src="{{ asset('images/' . $item->image) }}" width="100" height="50" /></td>
                <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $item->id }}" data-image="{{ asset('images/' . $item->image) }}" data-bs-toggle="modal" data-bs-target="#certificateModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-id="{{ $item->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="certificateForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                @method('PUT') <!-- Menentukan method PUT untuk update -->
                <div class="modal-header">
                    <h5 class="modal-title" id="certificateModalLabel">Add/Edit Sertifikat/Penghargaan</h5>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('addCertificateBtn').addEventListener('click', function() {
        document.getElementById('certificateForm').reset();
        document.getElementById('certificateModalLabel').textContent = 'Add Sertifikat/Penghargaan';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var image = this.getAttribute('data-image');

            document.getElementById('certificateModalLabel').textContent = 'Edit Sertifikat/Penghargaan';
            document.getElementById('id').value = id;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';
        });
    });

    document.getElementById('certificateForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var id = document.getElementById('id').value;
        var form = document.getElementById('certificateForm');
        var formData = new FormData(form);
        var url = id ? `/admin/sertifikat-penghargaan/update/${id}` : `{{ route('admin.landingpage.sertifikat-penghargaan.store') }}`;
        var method = id ? 'POST' : 'POST';

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': id ? 'PUT' : 'POST'
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
                var modal = bootstrap.Modal.getInstance(document.getElementById('certificateModal'));
                modal.hide();
                Swal.fire({
                    title: 'Success!',
                    text: data.message || 'Sertifikat/Penghargaan saved successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'An error occurred');
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
                    fetch(`/admin/sertifikat-penghargaan/delete/${id}`, {
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
