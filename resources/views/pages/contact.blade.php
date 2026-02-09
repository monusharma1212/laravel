@extends('main')

@section('title','Contact Us')

@section('content')

<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Contact Us</h1>
        <p class="text-muted">We would love to hear from you</p>
    </div>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-6">
            <h4 class="mb-3">Send a Message</h4>

            <form>
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" class="form-control" placeholder="Enter name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" placeholder="Subject">
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="4" placeholder="Write your message..."></textarea>
                </div>

                <button class="btn btn-dark">Send Message</button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
            <h4 class="mb-3">Our Contact Details</h4>

            <p><strong>📍 Address:</strong> 123 Business Street, Delhi, India</p>
            <p><strong>📞 Phone:</strong> +91 98765 43210</p>
            <p><strong>📧 Email:</strong> support@mycompany.com</p>

            <div class="mt-4">
                <h5>Business Hours</h5>
                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                <p>Saturday: 10:00 AM - 2:00 PM</p>
                <p>Sunday: Closed</p>
            </div>
        </div>
    </div>
</div>
@endsection
