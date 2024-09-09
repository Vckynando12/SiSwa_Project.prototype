@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Sekilas Perusahaan</h2>
    
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Sekilas Perusahaan</button>
    
    <table class="table table-bordered">
        <tr>
            <th>Deskripsi</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->maintext }}</td>
            <td>
                <button class="btn btn-warning editBtn" data-id="{{ $item->Id_sekilas }}" data-maintext="{{ $item->maintext }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                <button class="btn btn-danger deleteBtn" data-id="{{ $item->Id_sekilas }}">Hapus</button>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Sekilas Perusahaan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        @csrf

                        <div class="form-group">
                            <label for="maintext">Deskripsi:</label>
                            <textarea class="form-control" id="maintext" name="maintext" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Sekilas Perusahaan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Ensure this is PUT or PATCH -->
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editMaintext">Deskripsi:</label>
                            <textarea class="form-control" id="editMaintext" name="maintext" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var maintext = this.getAttribute('data-maintext');

            document.getElementById('editForm').reset();
            document.getElementById('editModalLabel').textContent = 'Edit Sekilas Perusahaan';
            document.getElementById('editId').value = id;
            document.getElementById('editMaintext').value = maintext;
        });
    });

    document.getElementById('addForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = document.getElementById('addForm');
        var formData = new FormData(form);

        fetch(`{{ route('admin.landingpage.sekilas.store') }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
                modal.hide();
                
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
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

    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var id = document.getElementById('editId').value;
        var form = document.getElementById('editForm');
        var formData = new FormData(form);

        fetch(`{{ route('admin.landingpage.sekilas.update', '') }}/${id}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.text()) // Change to .text() to see the raw response
        .then(text => {
            console.log('Raw response:', text); // Log the raw response
            return JSON.parse(text); // Parse the JSON manually
        })
        .then(data => {
            if (data.success) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                modal.hide();
                
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
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
                    fetch(`{{ route('admin.landingpage.sekilas.destroy', '') }}/${id}`, {
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
                                data.message,
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to delete');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            error.message || 'An unexpected error occurred.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script>
@endsection
