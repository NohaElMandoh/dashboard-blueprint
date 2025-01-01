@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">REPOSITORIES</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">REPOSITORIES</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                  {{--  <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('repositories.create') }}" class="btn btn-primary">Add Repository</a>
                    </div>--}}
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
                                <th> Name </th>
                              
                                <th> Type ID </th>
                                <th> Verified </th>
                                <th> Status </th>
                                <th> Main Photo </th>
                              
                                <th> Area </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($repositories as $key=>$repository)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ Str::limit(json_decode($repository->name, true)['en'], 30) }}</td>
                                <td>shadded</td>
                                <td>{{ $repository->verified ? 'Yes' : 'No' }}</td>
                                <td>{{ $repository->status }}</td>
                                <td><img src="{{ url($repository->main_photo) }}" alt="Main Photo" style="width: 100%; border-radius: 0;"></td>
                                <!-- m<sup>2</sup> -->
                                <td>{{ $repository->area }} </td>
                                <td>
                                    <a href="{{ route('repositories.edit', $repository->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('repositories.destroy', $repository->id) }}" method="POST" style="display:inline;">
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
                        {{ $repositories->links('pagination::bootstrap-4') }}
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
                    text: 'The repository has been deleted.',
                    timer: 3000,
                    showConfirmButton: false
                    }).then(() => {
                    location.reload();
                    });
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error deleting the repository.',
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
