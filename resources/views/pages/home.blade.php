@extends('main')

@section('title','Home')

@section('content')

<!-- 🔹 HERO SECTION -->
<div class="text-center py-5">
    <h1 class="display-4 fw-bold">Welcome to Our Website</h1>
    <p class="lead text-muted">
        We build modern, secure and scalable web applications using the latest technologies.
    </p>
    <a href="{{ route('about') }}" class="btn btn-dark btn-lg mt-3">Learn More</a>
</div>

<hr class="my-5">

<!-- 🔹 FEATURES SECTION -->
<div class="row text-center g-4">
    <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-white h-100">
            <h4 class="fw-bold">⚡ Fast Performance</h4>
            <p>Optimized systems ensuring smooth and fast user experience.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-white h-100">
            <h4 class="fw-bold">🔒 Secure System</h4>
            <p>Advanced authentication and data protection techniques.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 shadow-sm rounded bg-white h-100">
            <h4 class="fw-bold">🌍 Global Support</h4>
            <p>Reliable support and scalable solutions for worldwide clients.</p>
        </div>
    </div>
</div>

<hr class="my-5">

<!-- 🔹 ABOUT PREVIEW -->
<div class="row align-items-center">
    <div class="col-md-6">
        <h3 class="fw-semibold">Who We Are</h3>
        <p>
            We are a dedicated team of developers building high-quality digital products.
            Our focus is to provide user-friendly and secure applications for businesses.
        </p>
        <a href="{{ route('about') }}" class="btn btn-outline-dark">Read More</a>
    </div>

    <div class="col-md-6 text-center">
        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSEDaMEoX0Tkzqw74YSBab3HI2czZ14hUpGxq1Wuko5h6hGPVhF" class="img-fluid rounded shadow" alt="Home Image">
    </div>
</div>

<hr class="my-5">

<!-- 🔹 CALL TO ACTION -->
<div class="text-center py-4 bg-dark text-white rounded">
    <h3 class="mb-3">Ready to get started?</h3>
    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Contact Us</a>
</div>

@endsection
