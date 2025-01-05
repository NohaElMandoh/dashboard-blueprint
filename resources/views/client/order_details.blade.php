@extends('front.layouts.app')

@section('content')
<!-- Repository Details Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Repository Image -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid rounded w-100" src="{{ url($repository->main_photo) }}" alt="Repository Image">
            </div>

            <!-- Repository Information -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="card border-0 shadow p-4">
                    <h1 class="card-title text-primary mb-3">{{ json_decode($repository->name)->en ?? 'Repository Name' }}</h1>
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

        <!-- Additional Details Section -->
        <div class="row g-5 mt-5">
            <div class="col-lg-12">
                <div class="card border-0 shadow p-4">
                    <h2 class="text-primary">Additional Information</h2>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fa fa-check text-primary me-2"></i> Feature 1
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-check text-primary me-2"></i> Feature 2
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-check text-primary me-2"></i> Feature 3
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Repository Details End -->
@endsection
