@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="page-header">
        <h3 class="page-title"> Add Repository </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Repositories</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Repository </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" action="{{ route('repositories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                            <input type="text" class="form-control" name='name_en' id="name_en" placeholder="Name En">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Name AR</label>
                            <input type="text" class="form-control" name='name_ar' id="name_ar" placeholder="Name AR">
                        </div>
                        <div class="form-group">
                            <label for="description">Description EN</label>
                            <textarea class="form-control" rows="7" name="description_en" id="description_en" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description AR</label>
                            <textarea class="form-control" rows="7" name="description_ar" id="description_ar" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select class="form-control" name="city_id" id="city_id">
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ json_decode($city->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select class="form-control" name="type_id" id="type_id">
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ json_decode($type->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required style="background-color: white;">
                                <option value="" disabled selected>Select Status</option>
                                <option value="rent" {{ old('status') == 'rent' ? 'selected' : '' }}>Rent</option>
                                <option value="sale" {{ old('status') == 'sale' ? 'selected' : '' }}>Sale</option>
                            </select>
                           
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="verified">Verified</label>
                            <input type="checkbox" name="verified" id="verified">
                        </div>
                        <!-- <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status">
                        </div> -->
                        <div class="form-group">
                            <label for="location">Location EN</label>
                            <textarea class="form-control" name="location_en" id="location_en" placeholder="Location"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="location">Location AR</label>
                            <textarea class="form-control" name="location_ar" id="location_ar" placeholder="Location"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="map">Map URL</label>
                            <input type="text" class="form-control" name="map" id="map" placeholder="Map">
                        </div>
                        <div class="form-group">
                            <label for="main_photo">Main Photo</label>
                            <input type="file" class="form-control" name="main_photo" id="main_photo" onchange="previewPhoto(event)">
                        </div>
                        <div class="form-group">
                            <img id="photo_preview" src="#" alt="Photo Preview" style="display: none; max-width: 200px; max-height: 200px;" />
                        </div>
                        <div class="form-group">
                            <label for="additional_photos">Additional Photos</label>
                            <input type="file" class="form-control" name="additional_photos[]" id="additional_photos" multiple onchange="previewAdditionalPhotos(event)">
                        </div>
                        <div class="form-group" id="additional_photos_preview" style="display: flex; flex-wrap: wrap;"></div>

                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <input type="file" class="form-control" name="attachments[]" id="attachments" multiple>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" name="area" id="area" placeholder="Area">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('repositories.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPhoto(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('photo_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script>
    function previewAdditionalPhotos(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('additional_photos_preview');
        previewContainer.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                img.style.margin = '5px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    }
</script>
@endsection