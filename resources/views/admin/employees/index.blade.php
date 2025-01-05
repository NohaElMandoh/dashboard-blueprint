@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">EMPLOYEES</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">EMPLOYEES</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
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
                                <th> Employee </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Position </th>
                                  <!--  <th> Role </th>
                             <th> Permissions </th> -->
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td class="py-1">
                                    <img src="{{ url('dashboard/assets/images/faces/face28.png')}}" alt="Photo" width="50">
                                </td>
                                <td> {{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->position }}</td>
                            
                            {{--    <td>{{ $employee->role->name ?? '' }}</td>
                                <td>
                                    @foreach ($employee->permissions as $permission)
                                        <span class="badge badge-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>--}}
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>                              </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $employees->links('pagination::bootstrap-4') }}
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
                    text: 'The employee has been deleted.',
                    timer: 3000,
                    showConfirmButton: false
                    }).then(() => {
                    location.reload();
                    });
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error deleting the employee.',
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