@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Contact Us Messages</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contacts</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name</th>
                                <th>Email </th>
                                <th>Subject </th>
                                <th>Message </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $key=>$contact)
                            <tr>
                                <td>
                                  {{ $key + 1 }}
                                </td>
                                <td> {{$contact->name ?? 'N/A' }}</td>
                                <td> {{$contact->email ?? 'N/A' }}</td>
                                <td> {{$contact->subject ?? 'N/A' }}</td>
                                <td> {{$contact->message ?? 'N/A' }}</td>
                               
                                <td>
                                    <a href="{{route('show_contact',$contact->id)}}" class="btn btn-warning">show</a>
                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $contacts->links('pagination::bootstrap-4') }}
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
