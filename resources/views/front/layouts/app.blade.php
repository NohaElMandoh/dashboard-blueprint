<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Makaan - Real Estate HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('front.layouts.styles')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">

            <!-- <div id="chat-widget" style="position: fixed; bottom: 10px; right: 10px; width: 300px; height: 400px; border: 1px solid #ccc; border-radius: 10px; background: #fff;">
    <div id="chat-header" style="background: #007bff; color: white; padding: 10px;">Chatbot</div>
    <div id="chat-body" style="height: 80%; overflow-y: auto; padding: 10px;"></div>
    <div id="chat-footer" style="padding: 10px;">
        <input type="text" id="chat-input" style="width: 80%; padding: 5px;">
        <button id="chat-send" style="width: 18%; padding: 5px; background: #007bff; color: white;">Send</button>
    </div>
</div> -->
            <div id="chat-widget-container" style="position: fixed; bottom: 10px; right: 10px; z-index: 1000;">
                <!-- Chat Icon -->
                <div id="chat-icon" style="cursor: pointer; background: #00B98E; border-radius: 50%; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; color: white; font-size: 24px;">
                    💬
                </div>

                <!-- Chat Widget -->
                <div id="chat-widget" style="display: none; width: 300px; height: 400px; border: 1px solid #ccc; border-radius: 10px; background: #fff; flex-direction: column; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <div id="chat-header" style="background: #00B98E; color: white; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>Chatbot</span>
                        <span id="chat-close" style="cursor: pointer;">✖</span>
                    </div>
                    <div id="chat-body" style="flex-grow: 1; overflow-y: auto; padding: 10px;"></div>
                    <div id="chat-footer" style="padding: 10px; display: flex; gap: 10px;">
                        <input type="text" id="chat-input" style="flex-grow: 1; padding: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        <button id="chat-send" style="padding: 5px 10px; background: #00B98E; color: white; border: none; border-radius: 5px;">Send</button>
                    </div>
                </div>
            </div>

            <script>
                const chatIcon = document.getElementById('chat-icon');
                const chatWidget = document.getElementById('chat-widget');
                const chatClose = document.getElementById('chat-close');

                // Show the chat widget when the icon is clicked
                chatIcon.addEventListener('click', () => {
                    chatWidget.style.display = 'flex'; // Show the widget
                    chatIcon.style.display = 'none'; // Hide the icon
                });

                // Hide the chat widget and show the icon when the close button is clicked
                chatClose.addEventListener('click', () => {
                    chatWidget.style.display = 'none'; // Hide the widget
                    chatIcon.style.display = 'flex'; // Show the icon
                });
                const chatbotUrl = "{{ url('/chatbot') }}";
                document.getElementById('chat-send').addEventListener('click', function() {
                    const input = document.getElementById('chat-input');
                    const message = input.value.trim();
                    if (message) {
                        fetch(chatbotUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    message
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                const chatBody = document.getElementById('chat-body');
                                chatBody.innerHTML += `<div><b>You:</b> ${message}</div>`;
                                chatBody.innerHTML += `<div><b>Bot:</b> ${data.reply}</div>`;
                                input.value = '';
                            });
                    }
                });
            </script>

            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4" style="z-index: 1030;">
                <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="{{ url('front/img/icon-deal.png')}}" alt="Icon" style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">LOGO</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{route('about')}}" class="nav-item nav-link">About</a>
                        <a href="{{route('repositories')}}" class="nav-item nav-link">Repositories</a>
                        <a href="{{route('contact_us')}}" class="nav-item nav-link">Contact</a>


                    </div>
                    @if(auth('client')->guest() && auth('vendor')->guest())
                    
                    <!-- Client Login and Register Buttons -->
                    <a href="{{ route('client.login') }}" class="btn btn-primary btn-sm mx-2 custom-auth-btn">
                        Login
                    </a>
                    <a href="{{ route('client.register') }}" class="btn btn-success btn-sm mx-2 custom-auth-btn">
                        Register
                    </a>
                  
                    @else
                    @auth('vendor')
                    <span class="text-muted mx-2">Hi, {{ auth('vendor')->user()->name }} </span>

                    <a href="{{ route('vendor.logout') }}" class="btn btn-danger btn-sm mx-2 custom-auth-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout 
                    </a>
                    <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    @auth('client')
                    <span class="text-muted mx-2">Hi, {{ auth('client')->user()->name }} </span>
      
                    <a href="{{ route('client.logout') }}" class="btn btn-danger btn-sm mx-2 custom-auth-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout 
                    </a>
                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endauth
                    @endauth
                    <!-- Client Logout Button -->
                   
                    @endif
                   
                </div>
            </nav>
        </div>
        <!-- Navbar End -->



        @yield('content')
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-1.jpg')}}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-2.jpg')}}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-3.jpg')}}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-4.jpg')}}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-5.jpg')}}" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="{{url('front/img/property-6.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">MonoSoft Solution</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('front.layouts.scripts')
</body>

</html>