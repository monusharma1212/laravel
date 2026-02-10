@extends('main')

@section('title','Product')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Products</h1>
        <p class="text-muted">Explore our latest offerings</p>
    </div>

    <div class="row g-4">

        <!-- Product 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSEDaMEoX0Tkzqw74YSBab3HI2czZ14hUpGxq1Wuko5h6hGPVhF" class="card-img-top" alt="Product 1">
                <div class="card-body text-center">
                    <h5 class="card-title">Web Application</h5>
                    <p class="card-text">Modern Laravel based business system.</p>
                    <button class="btn btn-dark btn-sm">View Details</button>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSEDaMEoX0Tkzqw74YSBab3HI2czZ14hUpGxq1Wuko5h6hGPVhF" class="card-img-top" alt="Product 2">
                <div class="card-body text-center">
                    <h5 class="card-title">E-Commerce System</h5>
                    <p class="card-text">Complete online store solution.</p>
                    <button class="btn btn-dark btn-sm">View Details</button>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSEDaMEoX0Tkzqw74YSBab3HI2czZ14hUpGxq1Wuko5h6hGPVhF" class="card-img-top" alt="Product 3">
                <div class="card-body text-center">
                    <h5 class="card-title">Admin Dashboard</h5>
                    <p class="card-text">Powerful admin control panel.</p>
                    <button class="btn btn-dark btn-sm">View Details</button>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection