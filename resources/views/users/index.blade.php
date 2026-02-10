@extends('main')

@section('title','Profile')
@section('content')
<div class="container py-5">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        {{-- Header --}}
        <div class="bg-dark text-white text-center p-4" style="background: linear-gradient(135deg, #1f1f1f, #0d6efd); {{ $data->theme_color }});">
            <h2 class="fw-bold mb-1">{{ $data->name }}</h2>
            <span class="badge bg-light text-dark px-3 py-2">{{ ucfirst($data->role) }}</span>
        </div>

        <div class="card-body p-5">
            <div class="row g-4">

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">📧 Email</small>
                        <h6 class="fw-semibold">{{ $data->email }}</h6>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">🏢 Department</small>
                        <h6 class="fw-semibold">{{ $data->department }}</h6>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">💼 Experience</small>
                        <h6 class="fw-semibold">{{ $data->experience }} Years</h6>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">🎂 Date of Birth</small>
                        <h6 class="fw-semibold">{{ $data->dob }}</h6>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">🌙 Shift</small>
                        <h6 class="fw-semibold text-capitalize">{{ $data->shift }}</h6>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded-3 h-100">
                        <small class="text-muted">⚡ Skill Level</small>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{ $data->skill_level * 10 }}%; background-color: {{ $data->theme_color }};">
                            </div>
                        </div>
                        <small>{{ $data->skill_level }}/10</small>
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 border rounded-3">
                        <small class="text-muted">📝 Bio</small>
                        <p class="mb-0">{{ $data->bio }}</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="card-footer bg-light text-end">
            <a href="{{ asset('storage/'.$data->resume) }}" class="btn btn-sm btn-primary" target="_blank">📄 View Resume</a>
            <a href="#" class="btn btn-sm btn-outline-dark">✏ Edit Profile</a>
        </div>

    </div>

</div>
@endsection
