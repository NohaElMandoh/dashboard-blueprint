@extends('front.layouts.app')

@section('content')

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-start mt-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100 custom-photo-size" src="{{ url($repository->main_photo) }}">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">

                <h1 class="mb-4">$ {{ $repository->price ?? '1000' }}</h1>

                <h1 class="mb-4">{{ Str::limit(json_decode($repository->name, true)['en'], 100) }}</h1>
                <p class="mb-4">{{ json_decode($repository->description)->en ?? 'N/A' }}</p>
                <p><i class="fa fa-check text-primary me-3"></i>{{ json_decode($repository->type->name)->en ?? 'N/A' }}</p>
                <p><i class="fa fa-check text-primary me-3"></i>{{ $repository->status ?? 'N/A' }}</p>
                <p><i class="fa fa-check text-primary me-3"></i>{{ json_decode($repository->location)->en ?? 'N/A' }}</p>

            </div>
        </div>
    </div>
</div>
<!-- Property List Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Additional Photos</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
                </div>
            </div>

        </div>

        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach($repository->additional_photos_urls as $key=>$photo)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{$key+1}}s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a href=""><img class="img-fluid  custom-photo-size" src="{{ url($photo->path) }}" alt=""></a>
                            </div>


                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Property List End -->
<!-- About End -->
{{--
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-12">
                <div class="text-start">
                    <h1 class="mb-3"> {{ json_decode($repository->name)->en ?? 'N/A' }}</h1>
</div>
</div>
</div>
<div class="row g-0 gx-5 align-items-stretch mt-4">
    <!-- Description -->
    <div class="col-lg-6 d-flex align-items-center">
        <div class="text-start">
            <p class="mb-0">{{ json_decode($repository->description)->en ?? 'N/A' }}</p>
        </div>
    </div>
    <!-- Photo with Status and Type -->
    <div class="col-lg-6 position-relative">
        <!-- Status Badge (Left Side) -->
        <div class="bg-primary text-white rounded position-absolute top-0 start-0 ms-5 py-1 px-3">
            {{ $repository->status ?? 'N/A' }}
        </div>
        <!-- Type Badge (Right Side) -->
        <div class="bg-white text-primary rounded-top position-absolute bottom-0 end-0 me-5 py-1 px-3">
            {{ json_decode($repository->type->name)->en ?? 'N/A' }}
        </div>
        <!-- Image -->
        <img class="img-fluid rounded w-100" src="{{ url($repository->main_photo) }}" alt="Main Photo">
    </div>
</div>

<!-- Additional Photos Section -->
<div class="row g-4 mt-5">
    <h3 class="text-start mb-4">Additional Photos</h3>
    @foreach($repository->additional_photos_urls as $photo)
    <div class="col-md-4">
        <div class="position-relative">
            <img class="img-fluid rounded custom-photo-size" src="{{ url($photo->path) }}" alt="Additional Photo">
        </div>
    </div>
    @endforeach
</div>
</div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start col-xs-8 col-md-4">
                    <h3>Address: {{ $repository->address }}</h3>
                </div>
            </div>
        </div>
        <div class="row g-0 gx-5 align-items-end mt-4">
            <div class="col-lg-6">
                <div class="text-start col-xs-8 col-md-4">
                    <h3>Price: {{ $repository->price }}</h3>
                </div>

            </div>
        </div>
        <div class="row g-0 gx-5 align-items-end mt-4">
            <div class="col-lg-6">
                <div class="text-start col-xs-8 col-md-4">
                    <h3>Phone: {{ $repository->phone }}</h3>
                </div>

            </div>
        </div>
        <div class="row g-0 gx-5 align-items-end mt-4">
            <div class="col-lg-6">
                <div class="text-start
                col-xs-8 col-md-4">
                    <h3>Email: {{ $repository->email }}</h3>
                </div>
            </div>
        </div>
    </div>

</div>
--}}





<!-- Property Start -->
<!-- Call to Action Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="bg-light rounded p-3">
            <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid rounded w-100" src="{{ url('front/img/call-to-action.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="mb-4">
                            <h1 class="mb-3">Contact With Our Certified Agent</h1>
                            <p>Eirmod sed ipsum dolor sit rebum magna erat. Tempor lorem kasd vero ipsum sit sit diam justo sed vero dolor duo.</p>
                        </div>
                        <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                        <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

@endsection