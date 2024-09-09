@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Manage Text Swa Tour & Organizer</h1>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add New Text</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($texts as $text)
            <tr>
                <td>{{ $text->id }}</td>
                <td>{{ $text->content }}</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $text->id }}">Edit</button>
                    <button class="btn btn-danger" onclick="confirmDelete('{{ route('admin.swatour.textteo.destroy', $text->id) }}')">Delete</button>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $text->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $text->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $text->id }}">Edit Text</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.swatour.textteo.update', $text->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="content{{ $text->id }}">Text:</label>
                                    <textarea class="form-control" id="content{{ $text->id }}" name="content" rows="4" required>{{ $text->content }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Text</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.swatour.textteo.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">New Text:</label>
                            <textarea class="form-control" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Text</button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
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
                $('#deleteForm').attr('action', url);
                $('#deleteForm').submit();
            }
        });
    }
</script>
@endsection
