@extends('front.layouts.app')

@section('content')
<!-- Header Start -->
<div class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <!-- Text Content -->
        <div class="col-md-6 p-5 mt-lg-5">
    <h1 class="display-5 animated fadeIn mb-4">Explore Our <span class="text-primary">Repositories</span></h1>
    <p class="animated fadeIn mb-4 pb-2">Discover a variety of projects and repositories that showcase our work and expertise. Dive into the code and see what we have to offer.</p>
    @auth('client')
    <!-- Display Message for Client Logged In -->
    <div class="alert alert-warning mt-4" role="alert">
        You are currently logged in as a client. Please log out first to register as a warehouse owner.
        <br>
        <a href="{{ route('client.logout') }}" class="btn btn-link text-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form-client').submit();">
            Click here to log out as a client
        </a>
    </div>
    <form id="logout-form-client" action="{{ route('client.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Disabled Sign Up Button -->
    <div class="mt-3">
        <button class="btn btn-success w-100 py-2" style="border-radius: 20px;" disabled>
            Sign up as Warehouse Owner
        </button>
    </div>
@elseauth('vendor')
    <!-- Auth Buttons (Logout and Upload for Vendor) -->
    <div class="mt-4 auth-buttons-container">
        <div class="mb-3">
            <a href="{{ route('vendor.logout') }}" class="btn btn-primary w-100 py-2"
               onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();">
               Logout
            </a>
        </div>
        <div class="mb-3">
            <a href="{{ route('vendor.upload_form') }}" class="btn btn-success w-100 py-2">Upload Repository</a>
        </div>
        <form id="logout-form-vendor" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@else
    <!-- Auth Buttons (Login and Register for Vendor) -->
    <div class="mt-4 auth-buttons-container">
        <div class="mb-3">
            <!-- Login Button -->
            <a href="{{ route('vendor.login') }}" class="btn btn-primary w-100 py-2" style="border-radius: 20px;">
                Login as Warehouse Owner
            </a>
        </div>
        <div class="mb-3">
            <!-- Register Button -->
            <a href="{{ route('vendor.register') }}" class="btn btn-success w-100 py-2" style="border-radius: 20px;">
                Sign up as Warehouse Owner
            </a>
        </div>
    </div>
@endauth

    <!-- Invite Us Button -->
    <div class="d-flex justify-content-center my-3">
        <button type="button" class="btn btn-secondary py-3 px-5 animated fadeIn" data-bs-toggle="modal" data-bs-target="#inviteUsModal">
            Invite Us for Bidding
        </button>
    </div>
</div>

        <!-- Carousel Section -->
        <div class="col-md-6 animated fadeIn">
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item">
                    <img class="img-fluid" src="{{ url('front/img/1.jpg')}}" alt="" style="height: 600px; object-fit: cover;">
                </div>
                <div class="owl-carousel-item">
                    <img class="img-fluid" src="{{ url('front/img/2.jpg')}}" alt="" style="height: 600px; object-fit: cover;">
                </div>
                <div class="owl-carousel-item">
                    <img class="img-fluid" src="{{ url('front/img/3.jpg')}}" alt="" style="height: 600px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Modal -->
<div class="modal fade" id="inviteUsModal" z-index=20000 tabindex="-1" aria-labelledby="inviteUsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="inviteUsModalLabel">About Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p>
                    We are a leading company specializing in providing innovative solutions to meet your business needs. Our team is committed to excellence, ensuring that every project we undertake exceeds expectations.
                </p>
                <p>
                    Whether you're looking for consultation, development, or partnership opportunities, we are here to help you succeed.
                </p>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <a href="{{ route('contact_us') }}" class="btn btn-primary">Contact Us</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



<!-- Search Start -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <form action="{{ route('search') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control border-0 py-3" placeholder="Search Keyword">
                        </div>
                        <div class="col-md-4">
                            <select name="type_id" class="form-select border-0 py-3">
                                <option selected value="0">Repositories Types</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}"> {{ json_decode($type->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="city_id" class="form-select border-0 py-3">
                                <option selected value="0">City</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ json_decode($city->name)->en ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Search End -->


<!-- Category Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Repository Types</h1>
            <p>Explore the different types of repositories we offer. Each type showcases our diverse range of projects and expertise in various domains.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($types as $type)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="cat-item d-block bg-light text-center rounded p-3">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            @if(strtolower(json_decode($type->name)->en ?? '') == 'cold')
                            <img class="img-fluid" src="{{ url('front/img/icon-condominium.png') }}" alt="Icon">
                            @elseif(strtolower(json_decode($type->name)->en ?? '') == 'shaded')
                            <img class="img-fluid" src="{{ url('front/img/icon-neighborhood.png') }}" alt="Icon">

                            @elseif(strtolower(json_decode($type->name)->en ?? '') == 'flat')
                            <img class="img-fluid" src="{{ url('front/img/icon-building.png') }}" alt="Icon">

                            @endif
                        </div>
                        <h6>{{ json_decode($type->name)->en ?? 'N/A' }}</h6>
                        <span>{{ $type->repositories_count }} Repositories</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Category End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="{{ url('front/img/about.jpg')}}">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4"> Place To Find The Perfect Property</h1>
                <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


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
                    @if($repositories)
                    @foreach($repositories as $repository)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden h-100 d-flex flex-column">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid" src="{{ $repository->main_photo }}" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                                <h5 class="text-primary mb-3">${{ $repository->price ?? 1000 }}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>
                            <div class="d-flex border-top">
    <a href="{{ route('order_details', ['id' => $repository->id]) }}" class="btn btn-primary flex-fill text-center py-2">
        <i class="fa fa-shopping-cart me-2"></i>Buy Now
    </a>
</div>
                        </div>
                    </div>

                    @endforeach
                    {{-- @else
                        <p style="text-align: center;">No Repository Avaliable</p>--}}
                    @endif

                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary py-3 px-5" href="{{route('repositories')}}">Browse More Property</a>
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
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid" src="{{ $repository->main_photo }}" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                                <h5 class="text-primary mb-3">${{ $repository->price ?? 1000 }}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>
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

                    <div class="col-12 text-center">
                        <a class="btn btn-primary py-3 px-5" href="{{route('repositories')}}">Browse More Property</a>
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
                                <a href="{{ route('repository', ['id' => $repository->id]) }}"><img class="img-fluid" src="{{ $repository->main_photo }}" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{ $repository->status }}</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ json_decode($repository->type->name)->en ?? 'N/A' }} </div>
                            </div>
                            <div class="p-4 pb-0 flex-grow-1 d-flex flex-column">
                                <h5 class="text-primary mb-3">${{ $repository->price ??1000}}</h5>
                                <a class="d-block h5 mb-2" href="{{ route('repository', ['id' => $repository->id]) }}">{{ Str::limit(json_decode($repository->name)->en ?? 'N/A', 50) }}</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{json_decode($repository->location)->en ?? 'N/A' }}</p>
                            </div>
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
                    <div class="col-12 text-center">
                        <a class="btn btn-primary py-3 px-5" href="{{route('repositories')}}">Browse More Property</a>
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


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Property Agents</h1>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('front/img/team-1.jpg')}}" alt="">
                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('front/img/team-2.jpg')}}" alt="">
                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('front/img/team-3.jpg')}}" alt="">
                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid" src="{{ url('front/img/team-4.jpg')}}" alt="">
                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Our Clients Say!</h1>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-light rounded p-3">
                <div class="bg-white border rounded p-4">
                    <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('front/img/testimonial-1.jpg')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Client Name</h6>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-3">
                <div class="bg-white border rounded p-4">
                    <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('front/img/testimonial-2.jpg')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Client Name</h6>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-item bg-light rounded p-3">
                <div class="bg-white border rounded p-4">
                    <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('front/img/testimonial-3.jpg')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Client Name</h6>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->


@endsection