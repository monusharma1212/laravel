@extends('main')

@section('title','Dashboard')

@section('content')

<div class="container">

    <!-- 🔹 Welcome Section -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold">Welcome, {{ auth()->user()->name }} 👋</h2>
        <p class="text-muted">Here’s an overview of your account and system activity.</p>
    </div>

    <!-- 🔹 Stats Cards -->
    <div class="row g-4">

        @auth
            @if(auth()->user()->role === 'admin')
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center p-4">
                    <h5 class="text-muted">Total Users</h5>
                    <h2 class="fw-bold text-primary">{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
            @endif
        @endauth

        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <h5 class="text-muted">Your Role</h5>
                <h2 class="fw-bold text-success">{{ ucfirst(auth()->user()->role) }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <h5 class="text-muted">Account Created</h5>
                <h2 class="fw-bold text-dark">{{ auth()->user()->created_at->format('d M Y') }}</h2>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <!-- 🔹 Quick Actions -->
    <div class="text-center">
        <h4 class="mb-3">Quick Actions</h4>

        <a href="{{ route('profile', auth()->user()->id) }}" class="btn btn-outline-dark m-2">
            My Profile
        </a>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}" class="btn btn-dark m-2">Manage Users</a>
        @endif

        <a href="{{ route('contact') }}" class="btn btn-outline-secondary m-2">Support</a>
    </div>

</div>

@endsection
