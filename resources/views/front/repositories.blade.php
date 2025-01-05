@extends('front.layouts.app')

@section('content')
<!-- Property List Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Repositories Listing</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
                </div>
            </div>
            <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sale</a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">

                    @foreach($repositories as $repository)
                    @if($repositories)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative overflow-hidden">
                            
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid custom-photo-size" src="{{ $repository->main_photo }}" height="300px" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                            <h5 class="text-primary mb-3">$ {{ $repository->price ?? '1000' }}</h5>
                                <h5 class="text-primary mb-3">BY : {{ $repository->vendor->name ?? '' }}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>
                            <!-- <div class="d-flex border-top">
    <button class="btn btn-primary flex-fill text-center py-2 buy-now-button">
        <i class="fa fa-shopping-cart me-2"></i>Subscripe
    </button>
</div> -->

<div class="d-flex border-top">
    <a href="{{ route('order_details', ['id' => $repository->id]) }}" class="btn btn-primary flex-fill text-center py-2">
        <i class="fa fa-shopping-cart me-2"></i>Buy Now
    </a>
</div>

                        </div>
                    </div>
                    {{-- @else
                        <p style="text-align: center;">No Repository Avaliable</p>--}}
                    @endif
                    @endforeach

                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex justify-content-center">
                            {{ $repositories->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane fade show p-0">
                <div class="row g-4">
                    
                @foreach($repositories as $repository)
                @if( $repository->status=='sale')
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid custom-photo-size" src="{{ $repository->main_photo }}" height="300px" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                            <h5 class="text-primary mb-3">$ {{ $repository->price ?? '1000' }}</h5>
                                <h5 class="text-primary mb-3">BY : {{ $repository->vendor->name ?? '' }}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>

                                  <div class="d-flex border-top">
                                     <small class="flex-fill text-center py-2"><i class="fa fa-shopping-cart text-primary me-2"></i>By Now</small>
                                </div>
                        </div>
                    </div>
                    {{-- @else
                        <p style="text-align: center;">No Repository Avaliable</p>--}}
                    @endif
                    @endforeach

                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex justify-content-center">
                            {{ $repositories->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-3" class="tab-pane fade show p-0">
                <div class="row g-4">
                @foreach($repositories as $repository)
                @if( $repository->status=='rent')
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid custom-photo-size" src="{{ $repository->main_photo }}" height="300px" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                            <h5 class="text-primary mb-3">$ {{ $repository->price ?? '1000' }}</h5>
                                <h5 class="text-primary mb-3">BY : {{ $repository->vendor->name ?? '' }}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>
                            <div class="d-flex border-top">
                                     <small class="flex-fill text-center py-2"><i class="fa fa-shopping-cart text-primary me-2"></i>By Now</small>
                                </div>
                        </div>
                    </div>
                    {{-- @else
                        <p style="text-align: center;">No Repository Avaliable</p>--}}
                    @endif
                    @endforeach

                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex justify-content-center">
                            {{ $repositories->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Property List End -->


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
<!-- User Data Form Modal -->

<!-- Modal -->
<div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDataModalLabel">Enter Your Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userDataForm">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="userPhone" name="userPhone" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Message Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your details have been submitted successfully!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

document.addEventListener('DOMContentLoaded', function () {
        const buyNowButtons = document.querySelectorAll('.buy-now-button');
        const userDataForm = document.getElementById('userDataForm');
        const priceDisplay = document.getElementById('priceDisplay');
        const priceValue = document.getElementById('priceValue');

        buyNowButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userDataModal = new bootstrap.Modal(document.getElementById('userDataModal'));
                userDataModal.show();
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const buyNowButtons = document.querySelectorAll('.buy-now-button');
    

        // Mock price value
        const productPrice = 99.99;

        // Handle form submission
        // Handle form submission
        userDataForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Hide the form modal
            const userDataModal = bootstrap.Modal.getInstance(document.getElementById('userDataModal'));
            userDataModal.hide();

            // Show the success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    });
</script>

@endsection