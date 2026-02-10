@extends('main')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">

    <!-- Welcome -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold">Welcome, {{ auth()->user()->name }} 👋</h2>
        <p class="text-muted">Here’s an overview of your account and system activity.</p>
    </div>

    <!-- Stats -->
    <div class="row g-4">
        @if(auth()->user()->role === 'admin')
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <h5 class="text-muted">Total Users</h5>
                <h2 class="fw-bold text-primary">{{ \App\Models\User::whereRaw("LOWER(role) != 'admin'")->count() }}</h2>
            </div>
        </div>
        @endif

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

    <hr class="my-1">

    {{-- Users list --}}
    @if(auth()->user()->role === 'admin')
        @include('admin.users', ['users' => $users])
    @endif

</div>

@endsection
