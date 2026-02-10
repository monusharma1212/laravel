@extends('main')

@section('title', 'Welcome')

@section('content')

    <!-- 🔹 HERO SECTION -->
    <div class="text-center py-5">
        <h1 class="display-4 fw-bold mb-3">Welcome to My Website</h1>
        <p class="lead text-muted mb-4">
            We build modern, secure and scalable web applications to help businesses grow digitally.
        </p>
        <a href="{{ route('about') }}" class="btn btn-dark btn-lg">Learn More</a>
    </div>

    <hr class="my-5">

    <!-- 🔹 FEATURES -->
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
                <p>Reliable solutions and support for clients worldwide.</p>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <!-- 🔹 ABOUT PREVIEW -->
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3 class="fw-semibold">Who We Are</h3>
            <p>
                We are a passionate team of developers creating high-quality digital products.
                Our goal is to deliver user-friendly, secure, and scalable applications.
            </p>
            <a href="{{ route('about') }}" class="btn btn-outline-dark">Read More</a>
        </div>

        <div class="col-md-6 text-center">
            <img src="https://thumbs.dreamstime.com/b/autumn-nature-landscape-colorful-forest-autumn-nature-landscape-colorful-forest-morning-sunlight-131400332.jpg"
                class="img-fluid rounded shadow" alt="Home Image">
        </div>
    </div>

    <hr class="my-5">

    <!-- 🔹 CALL TO ACTION -->
    <div class="text-center py-5 bg-dark text-white rounded">
        <h3 class="mb-3">Ready to start your project?</h3>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Contact Us</a>
    </div>

@endsection
