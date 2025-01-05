@extends('front.layouts.app')

@section('content')
<!-- Repository Details Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Repository Image -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="{{ url($repository->main_photo)}}">
                </div>
            </div>
            <!-- Repository Information -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="card border-0 shadow p-4">
                    <h1 class="card-title text-primary mb-3">{{ Str::limit(json_decode($repository->name, true)['en'] ?? 'Repository Name' , 100)  }}</h1>
                    <p class="mb-4">{{ json_decode($repository->description)->en ?? 'Repository description goes here...' }}</p>

                    <div class="mb-3">
                        <strong>Price:</strong> ${{ $repository->price ?? '1000' }}
                    </div>
                    <div class="mb-3">
                        <strong>Type:</strong> {{ json_decode($repository->type->name)->en ?? 'N/A' }}
                    </div>
                    <div class="mb-3">
                        <strong>Status:</strong> {{ $repository->status }}
                    </div>
                    <div class="mb-3">
                        <strong>Location:</strong> {{ json_decode($repository->location)->en ?? 'N/A' }}
                    </div>
                    <div class="mb-3">
                        <strong>Vendor:</strong> {{ $repository->vendor->name ?? 'Unknown' }}
                    </div>

                    <div class="d-grid mt-4">
                        <a href="{{ route('buy-now') }}" class="btn btn-primary py-3">
                            <i class="fa fa-shopping-cart me-2"></i>Buy Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

   
    </div>
</div>
<!-- Repository Details End -->
@endsection
