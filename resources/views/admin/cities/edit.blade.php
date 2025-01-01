@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit City </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Cities</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit City </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" action="{{ route('cities.update', $city->id) }}" method="POST">
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
                            <label for="exampleInputName1">Name EN</label>
                            <input type="text" class="form-control" name='name_en' id="name_en" value="{{ json_decode($city->name)->en }}" placeholder="Name En">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Name AR</label>
                            <input type="text" class="form-control" name='name_ar' id="name_ar" value="{{ json_decode($city->name)->ar }}" placeholder="Name AR">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      
                    <a href="{{ route('cities.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
