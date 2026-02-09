@extends('main')

@section('title','Our Location')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Location</h1>
        <p class="text-muted">Find us easily on the map</p>
    </div>

    <div class="row align-items-center">
        <!-- Address Info -->
        <div class="col-md-5">
            <h4>Office Address</h4>
            <p><strong>Company Name:</strong> My Company Pvt. Ltd.</p>
            <p><strong>Address:</strong> 123 Business Street, Delhi, India</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Email:</strong> support@mycompany.com</p>

            <div class="mt-4">
                <h5>Working Hours</h5>
                <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
                <p>Sat: 10:00 AM - 2:00 PM</p>
                <p>Sun: Closed</p>
            </div>
        </div>

        <!-- Google Map -->
        <div class="col-md-7">
            <div class="ratio ratio-16x9 shadow rounded">
                <iframe 
                    src="https://maps.google.com/maps?q=Delhi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection