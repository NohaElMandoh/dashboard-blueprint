
 <!-- Favicon -->
   <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ url('front/lib/animate/animate.min.css')}}" rel="stylesheet">
<link href="{{ url('front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ url('front/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ url('front/css/style.css')}}" rel="stylesheet">

<style >
  .custom-photo-size {
    width: 100%;
    height: 300px; /* Set the desired height */
    object-fit: cover; /* Ensures images cover the entire space without distortion */
}
</style>
<style>
  
    .modal {
        z-index: 20000; /* Ensure modal is above the navbar */
    }
    #chat-widget-container {
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-end;
}

#chat-widget {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
.btn {
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    border-radius: 20px; /* Rounded edges */
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .auth-buttons-container {
        margin-left: 0 !important; /* Remove margin on smaller screens */
        flex-direction: column; /* Stack buttons vertically */
        gap: 1rem; /* Space between buttons */
    }

    .auth-buttons-container .btn {
        width: 100%; /* Full-width buttons on smaller screens */
    }
}
/* Additional styling for custom button-like links */
.custom-auth-btn {
    text-decoration: none; /* Remove underline */
    padding: 0.4rem 1rem; /* Adjust padding for button size */
    font-size: 0.875rem; /* Slightly smaller text for a sleek look */
    border-radius: 20px; /* Rounded edges for button-like appearance */
    transition: all 0.3s ease; /* Smooth hover effects */
}

.custom-auth-btn:hover {
    opacity: 0.9; /* Subtle hover effect */
    text-decoration: none; /* Keep underline removed on hover */
}
</style>
