@extends('front.layouts.app')

@section('content')
<!-- Payment Form Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-center">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                    <h1 class="mb-3">Payment Form</h1>
                    <p>Please provide the required details to complete your payment securely.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="bg-light rounded p-4 shadow">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter cardholder's name" required>
                            <div class="invalid-feedback">Please enter the cardholder's name.</div>
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                            <div class="invalid-feedback">Please enter a valid card number.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiryDate" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
                                <div class="invalid-feedback">Please enter the expiry date.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                                <div class="invalid-feedback">Please enter the CVV code.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="$99.99" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Payment Form End -->

<!-- Call to Action Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="bg-light rounded p-3">
            <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid rounded w-100" src="{{ url('front/img/call-to-action.jpg') }}" alt="Call to Action">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="mb-4">
                            <h1 class="mb-3">Need Assistance?</h1>
                            <p>If you encounter any issues with the payment, feel free to reach out to our support team.</p>
                        </div>
                        <a href="tel:+1234567890" class="btn btn-primary py-3 px-4 me-2">
                            <i class="fa fa-phone-alt me-2"></i>Contact Support
                        </a>
                        <a href="mailto:support@example.com" class="btn btn-dark py-3 px-4">
                            <i class="fa fa-envelope me-2"></i>Email Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<script>
    // Form validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection
