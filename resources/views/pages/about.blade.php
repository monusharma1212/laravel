@extends('main')

@section('title','About')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">About Our Company</h1>
        <p class="text-muted">Learn more about who we are and what we do</p>
    </div>

    <div class="row align-items-center">
        <div class="col-md-6">
            <h3 class="fw-semibold">Who We Are</h3>
            <p>
                We are a passionate team focused on building modern web applications 
                using technologies like Laravel, Bootstrap, and JavaScript. 
                Our mission is to create secure, fast, and user-friendly systems 
                that help businesses grow digitally.
            </p>
        </div>

        <div class="col-md-6 text-center">
            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSEDaMEoX0Tkzqw74YSBab3HI2czZ14hUpGxq1Wuko5h6hGPVhF" class="img-fluid rounded shadow" alt="About Image">
        </div>
    </div>

    <hr class="my-5">

    <div class="row text-center">
        <div class="col-md-4">
            <h4 class="fw-bold">🚀 Our Mission</h4>
            <p>To deliver high-quality, secure, and scalable web solutions.</p>
        </div>

        <div class="col-md-4">
            <h4 class="fw-bold">🎯 Our Vision</h4>
            <p>To become a trusted technology partner worldwide.</p>
        </div>

        <div class="col-md-4">
            <h4 class="fw-bold">💡 Our Values</h4>
            <p>Innovation, integrity, teamwork, and customer satisfaction.</p>
        </div>
    </div>

    <div class="mt-5 text-center">
        <a href="{{ route('contact') }}" class="btn btn-dark btn-lg">
            Contact Us
        </a>
    </div>
</div>
@endsection