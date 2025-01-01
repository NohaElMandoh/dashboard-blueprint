@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">TYPES</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">TYPES</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('types.create') }}" class="btn btn-primary">Add Type</a>
                    </div>
                    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name (EN) </th>
                                <th> Name (AR) </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $key=>$type)
                            <tr>
                                <td >
                                  {{ $key + 1 }}
                                </td>
                                <td> {{ json_decode($type->name)->en ?? 'N/A' }}</td>
                                <td> {{ json_decode($type->name)->ar ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('types.destroy', $type->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $types->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
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
                fetch(event.target.closest('form').action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
                }).then(response => {
                if (response.ok) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The type has been deleted.',
                    timer: 3000,
                    showConfirmButton: false
                    }).then(() => {
                    location.reload();
                    });
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error deleting the type.',
                    timer: 3000,
                    showConfirmButton: false
                    });
                }
                });
            }
            });
        }
        </script>
    @endsection
