@extends('admin.dashboard')
@section('content')
<div class="container">
    <h2>Manage Texts</h2>
    
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add New Text</button>
    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Text</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($texts as $text)
        <tr>
            <td>{{ $text->id }}</td>
            <td>{{ $text->text }}</td>
            <td>
                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $text->id }}">Edit</button>
                <button class="btn btn-danger" onclick="confirmDelete('{{ route('admin.digitalsolution.textds.destroy', $text->id) }}')">Delete</button>
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
                        <form action="{{ route('admin.digitalsolution.textds.update', $text->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="text{{ $text->id }}">Text:</label>
                                <textarea class="form-control" id="text{{ $text->id }}" name="text" rows="4" required>{{ $text->text }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                    <form action="{{ route('admin.digitalsolution.textds.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea class="form-control" id="text" name="text" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

<script>
    function confirmDelete(url) {
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
    }
</script>
@endsection