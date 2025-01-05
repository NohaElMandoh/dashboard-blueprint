@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Employee </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Employees</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit Employee </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $employee->name }}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $employee->email }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                        <label for="position">Position</label>
                            <select class="form-control @error('position') is-invalid @enderror" id="position" name="position" required style="background-color: white;">
                                <option value="" disabled selected>Select position</option>
                                <option value="admin" {{ $employee->position == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="sub_admin" {{ $employee->position == 'sub_admin' ? 'selected' : '' }}>Sub Admin</option>
                            </select>
                           
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                            @if ($employee->photo)
                                <div class="mt-2">
                                    <img src="{{ url( $employee->photo) }}" alt="Employee Photo" width="100">
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
