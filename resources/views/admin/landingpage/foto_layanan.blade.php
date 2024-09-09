@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Manage Foto Layanan</h1>
    <button class="btn btn-primary" id="addFotoLayananBtn" data-bs-toggle="modal" data-bs-target="#fotoLayananModal">Add Foto Layanan</button>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fotoLayanans as $fotoLayanan)
            <tr>
                <td>
                    @if($fotoLayanan->image1)
                    <img src="{{ asset('storage/' . $fotoLayanan->image1) }}" width="100" height="50" />
                    @endif
                </td>
                <td>
                    @if($fotoLayanan->image2)
                    <img src="{{ asset('storage/' . $fotoLayanan->image2) }}" width="100" height="50" />
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $fotoLayanan->id }}" data-image1="{{ $fotoLayanan->image1 }}" data-image2="{{ $fotoLayanan->image2 }}" data-bs-toggle="modal" data-bs-target="#fotoLayananModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" data-id="{{ $fotoLayanan->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="fotoLayananModal" tabindex="-1" aria-labelledby="fotoLayananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fotoLayananForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                <input type="hidden" name="_method" value="PUT" id="method">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoLayananModalLabel">Add/Edit Foto Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image1">Image 1</label>
                        <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
                        <img id="previewImage1" src="#" alt="Image 1 Preview" style="width: 100%; margin-top: 10px; display: none;">
                    </div>
                    <div class="form-group">
                        <label for="image2">Image 2</label>
                        <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
                        <img id="previewImage2" src="#" alt="Image 2 Preview" style="width: 100%; margin-top: 10px; display: none;">
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('addFotoLayananBtn').addEventListener('click', function() {
            document.getElementById('fotoLayananForm').reset();
            document.getElementById('fotoLayananModalLabel').textContent = 'Add Foto Layanan';
            document.getElementById('previewImage1').style.display = 'none';
            document.getElementById('previewImage2').style.display = 'none';
            document.getElementById('id').value = '';
        });

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('fotoLayananModalLabel').textContent = 'Edit Foto Layanan';
                document.getElementById('id').value = this.getAttribute('data-id');
                document.getElementById('previewImage1').src = this.getAttribute('data-image1') ? "{{ asset('storage') }}/" + this.getAttribute('data-image1') : '';
                document.getElementById('previewImage1').style.display = this.getAttribute('data-image1') ? 'block' : 'none';
                document.getElementById('previewImage2').src = this.getAttribute('data-image2') ? "{{ asset('storage') }}/" + this.getAttribute('data-image2') : '';
                document.getElementById('previewImage2').style.display = this.getAttribute('data-image2') ? 'block' : 'none';
            });
        });

        document.getElementById('fotoLayananForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var id = document.getElementById('id').value;
            var url = id ? `/admin/foto-layanan/update/${id}` : '/admin/foto-layanan/store';
            var method = id ? 'PUT' : 'POST'; // Use PUT for update

            if (id) {
                document.getElementById('method').value = 'PUT';
            } else {
                document.getElementById('method').value = 'POST';
            }

            fetch(url, {
                method: 'POST', // Always use POST for form submission
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Success!',
                        'Data has been saved.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'There was an issue saving the data.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error!',
                    'An unexpected error occurred.',
                    'error'
                );
            });
        });

        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/foto-layanan/destroy/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
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
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the data.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An unexpected error occurred.',
                                'error'
                            );
                        });
                    }
                });
            });
        });

        document.getElementById('image1').addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewImage1 = document.getElementById('previewImage1');
                previewImage1.src = e.target.result;
                previewImage1.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        });

        document.getElementById('image2').addEventListener('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewImage2 = document.getElementById('previewImage2');
                previewImage2.src = e.target.result;
                previewImage2.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection