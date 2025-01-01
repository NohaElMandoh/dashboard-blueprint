@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">CITIES</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">CITIES</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('cities.create') }}" class="btn btn-primary">Add City</a>
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
                            @foreach ($cities as $key=>$city)
                            <tr>
                                <td>
                                  {{ $key + 1 }}
                                </td>
                                <td> {{ json_decode($city->name)->en ?? 'N/A' }}</td>
                                <td> {{ json_decode($city->name)->ar ?? 'N/A' }}</td>
                               
                                <td>
                                    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline;">
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
                        {{ $cities->links('pagination::bootstrap-4') }}
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
                    text: 'The city has been deleted.',
                    timer: 3000,
                    showConfirmButton: false
                    }).then(() => {
                    location.reload();
                    });
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error deleting the city.',
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
