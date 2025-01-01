@extends('front.layouts.app')

@section('content')
<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Upload Repository</h1>
            <p>Please fill out the form below to upload your repository details. Ensure all required fields are completed accurately.</p>
        </div>
        <div class="row g-4">


            <div class="col-md-12">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <p>Please fill out the form below to upload your repository details. Ensure all required fields are completed accurately.</p>
                 
                    <form action="{{ route('vendor.upload_repository') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                setTimeout(function() {
                                    var alertElements = document.querySelectorAll('.alert');
                                    alertElements.forEach(function(alert) {
                                        var bsAlert = new bootstrap.Alert(alert);
                                        bsAlert.close();
                                    });
                                }, 5000); // 5000 milliseconds = 5 seconds
                            });
                        </script>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name_en" placeholder="Name (English)" value="{{ old('name.en') }}" required>
                                    <label for="name_en">Name (English)</label>
                                    @error('name.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name_ar" placeholder="Name (Arabic)" value="{{ old('name.ar') }}" required>
                                    <label for="name_ar">Name (Arabic)</label>
                                    @error('name.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description_en" placeholder="Description (English)" style="height: 150px;" required>{{ old('description.en') }}</textarea>
                                    <label for="description_en">Description (English)</label>
                                    @error('description.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control @error('description.ar') is-invalid @enderror" id="description_ar" name="description_ar" placeholder="Description (Arabic)" style="height: 150px;" required>{{ old('description.ar') }}</textarea>
                                    <label for="description_ar">Description (Arabic)</label>
                                    @error('description.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required style="background-color: white;">
                                        <option value="" disabled selected>Select City</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ json_decode($city->name)->en ?? 'N/A' }}</option>
                                        @endforeach
                                    </select>
                                    <label for="city_id">City</label>
                                    @error('city_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control @error('type_id') is-invalid @enderror" id="type_id" name="type_id" required style="background-color: white;">
                                        <option value="" disabled selected>Select Type</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ json_decode($type->name)->en ?? 'N/A' }}</option>
                                        @endforeach
                                    </select>
                                    <label for="type_id">Type</label>
                                    @error('type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required style="background-color: white;">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="rent" {{ old('status') == 'rent' ? 'selected' : '' }}>Rent</option>
                                        <option value="sale" {{ old('status') == 'sale' ? 'selected' : '' }}>Sale</option>
                                    </select>
                                    <label for="status">Status</label>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('map') is-invalid @enderror" id="map" name="map" placeholder="Map" value="{{ old('map') }}" required>
                                    <label for="map">Map url</label>
                                    @error('map')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('location.en') is-invalid @enderror" id="location_en" name="location_en" placeholder="Location (English)" value="{{ old('location.en') }}" required>
                                    <label for="location_en">Location (English)</label>
                                    @error('location.en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('location.ar') is-invalid @enderror" id="location_ar" name="location_ar" placeholder="Location (Arabic)" value="{{ old('location.ar') }}" required>
                                    <label for="location_ar">Location (Arabic)</label>
                                    @error('location.ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('area') is-invalid @enderror" id="area" name="area" placeholder="Area" value="{{ old('area') }}" required>
                                    <label for="area">Area </label>
                                    @error('area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="main_photo">Main Photo</label>
                                <input type="file" class="form-control @error('main_photo') is-invalid @enderror" id="main_photo" name="main_photo" style="background-color: white;">
                                <img id="main_photo_preview" src="#" alt="Main Photo Preview" style="display: none; width: 300px; height: 200px; margin-top: 10px;">
                                @error('main_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="additional_photos">Additional Photos</label>
                                    <input type="file" class="form-control @error('additional_photos') is-invalid @enderror" name="additional_photos[]" id="additional_photos" multiple onchange="previewAdditionalPhotos(event)">
                                    @error('additional_photos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="additional_photos_preview" style="display: flex; flex-wrap: wrap;"></div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="attachments">Attachments</label>
                                    <input type="file" class="form-control @error('attachments') is-invalid @enderror" name="attachments[]" id="attachments" multiple onchange="previewAttachments(event)">
                                    @error('attachments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="attachments_preview" style="display: flex; flex-wrap: wrap;"></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<script>
    document.getElementById('main_photo').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('main_photo_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
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
<script>
    function previewAttachments(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('attachments_preview');
        previewContainer.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            (function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewElement;
                    if (file.type.startsWith('image/')) {
                        previewElement = document.createElement('img');
                        previewElement.src = e.target.result;
                        previewElement.style.maxWidth = '100px';
                        previewElement.style.maxHeight = '100px';
                    } else {
                        previewElement = document.createElement('i');
                        previewElement.className = 'fa fa-file';
                        previewElement.style.fontSize = '100px';
                    }
                    previewElement.style.margin = '5px';
                    previewContainer.appendChild(previewElement);
                };
                reader.readAsDataURL(file);
            })(files[i]);
        }
    }
</script>
@endsection