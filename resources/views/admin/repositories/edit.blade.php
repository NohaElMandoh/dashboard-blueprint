@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Repository </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Repositories</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit Repository </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form class="forms-sample" action="{{ route('repositories.update', $repository->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="name_en">Name EN</label>
                            <input type="text" class="form-control" name='name_en' id="name_en"
                                value="{{ json_decode($repository->name)->en ?? 'N/A' }}" placeholder="Name En">
                        </div>
                        <div class="form-group">
                            <label for="name_ar">Name AR</label>
                            <input type="text" class="form-control" name='name_ar' id="name_ar"
                                value="{{ json_decode($repository->name)->ar ?? 'N/A' }}" placeholder="Name AR">
                        </div>
                        <div class="form-group">
                            <label for="description_en">Description EN</label>
                            <textarea class="form-control" rows="7" name="description_en" id="description_en" placeholder="Description">{{ json_decode($repository->description)->en ?? 'N/A' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description_ar">Description AR</label>
                            <textarea class="form-control" rows="7" name="description_ar" id="description_ar" placeholder="Description">{{ json_decode($repository->description)->ar ?? 'N/A' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select class="form-control" name="city_id" id="city_id">
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $repository->city_id == $city->id ? 'selected' : '' }}>{{ json_decode($city->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select class="form-control" name="type_id" id="type_id">
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $repository->type_id == $type->id ? 'selected' : '' }}>{{ json_decode($type->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required style="background-color: white;">
                                <option value="" disabled selected>Select Status</option>
                                <option value="rent" {{ $repository->status == 'rent' ? 'selected' : '' }}>Rent</option>
                                <option value="sale" {{ $repository->status == 'sale' ? 'selected' : '' }}>Sale</option>
                            </select>
                           
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="verified">Verified</label>
                            <input type="checkbox" name="verified" id="verified" {{ $repository->verified ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="location_en">Location EN</label>
                            <textarea class="form-control" name="location_en" id="location_en" placeholder="Location">{{ json_decode($repository->location)->en ?? 'N/A' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="location_ar">Location AR</label>
                            <textarea class="form-control" name="location_ar" id="location_ar" placeholder="Location">{{ json_decode($repository->location)->ar ?? 'N/A' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="map">Map URL</label>
                            <input type="text" class="form-control" name="map" id="map" value="{{ $repository->map }}" placeholder="Map">
                        </div>
                        <div class="form-group">
                            <label for="main_photo">Main Photo</label>
                            <input type="file" class="form-control" name="main_photo" id="main_photo" onchange="previewPhoto(event)">
                        </div>
                        <div class="form-group">
                            <a href="{{ url($repository->main_photo) }}" target="_blank">
                                <img id="photo_preview" src="{{ url($repository->main_photo) }}" alt="Photo Preview" style="display: {{ $repository->main_photo ? 'block' : 'none' }}; max-width: 200px; max-height: 200px;" />
                            </a>
                        </div>
                        <div class="form-group">
                            <label for="additional_photos">Additional Photos</label>
                            <input type="file" class="form-control" name="additional_photos[]" id="additional_photos" multiple onchange="previewAdditionalPhotos(event)">
                        </div>
                        <div class="form-group" id="additional_photos_preview" style="display: flex; flex-wrap: wrap;">
                            @if($repository->additional_photos_urls)
                            @foreach($repository->additional_photos_urls as $photo_url)
                            <a href="{{ url($photo_url->path) }}" target="_blank">
                                <img src="{{ url($photo_url->path) }}" style="max-width: 200px; max-height: 200px; margin: 5px;">
                            </a>
                            @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <input type="file" class="form-control" name="attachments[]" id="attachments" multiple onchange="previewAttachments(event)">
                            @if($repository->attachments)
                            @foreach($repository->attachments as $attachment)
                            @if(in_array(pathinfo($attachment->path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <a href="{{ url($attachment->path) }}" target="_blank">
                                <img src="{{ url($attachment->path) }}" style="max-width: 200px; max-height: 200px; margin: 5px;">
                            </a>
                            @else

                            <a href="{{ url($attachment->path) }}" target="_blank" download>
                                <i class="fa fa-file" aria-hidden="true"></i> Download
                            </a>
                            <a href="{{ url($attachment->path) }}" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i> View
                            </a>


                            @endif
                            @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" class="form-control" name="area" id="area" value="{{ $repository->area }}" placeholder="Area">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
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