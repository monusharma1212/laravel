@extends('main')

@section('title', 'My Profile')

@section('content')
    <div class="container py-5">

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="text-white text-center p-5"
                style="background: linear-gradient(135deg, #1f1f1f, {{ $data->theme_color }});">
                <h2 class="fw-bold mb-1">{{ $data->name }}</h2>
                <span class="badge bg-light text-dark px-3 py-2 fs-6">
                    {{ ucfirst($data->role) }}
                </span>
            </div>

            {{-- USER IMAGE GALLERY --}}
            @if (!empty($data->images))
                @php
                    $images = is_array($data->images) ? $data->images : json_decode($data->images, true) ?? [];
                @endphp

                <div class="text-center mt-4">
                    <h5 class="fw-semibold mb-3">📸 Photo Gallery</h5>

                    <div class="profile-gallery d-flex flex-wrap justify-content-center gap-3">
                        @foreach ($images as $img)
                            <div class="gallery-box">
                                <img src="{{ asset('storage/' . $img) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- BODY --}}
            <div class="card-body p-5">
                <div class="row g-4">

                    @php
                        $department = is_array($data->department)
                            ? implode(', ', $data->department)
                            : $data->department;

                        $items = [
                            ['📧 Email', $data->email],
                            ['🏢 Department', $department],
                            ['💼 Experience', $data->experience . ' Years'],
                            ['🎂 Date of Birth', $data->dob],
                            ['🌙 Shift', ucfirst($data->shift)],
                        ];
                    @endphp

                    @foreach ($items as $item)
                        <div class="col-md-6">
                            <div class="bg-light p-4 rounded-3 shadow-sm h-100">
                                <small class="text-muted d-block mb-1">{{ $item[0] }}</small>
                                <h6 class="fw-semibold mb-0">{{ $item[1] }}</h6>
                            </div>
                        </div>
                    @endforeach

                    {{-- Skill --}}
                    <div class="col-md-6">
                        <div class="bg-light p-4 rounded-3 shadow-sm h-100">
                            <small class="text-muted d-block mb-1">⚡ Skill Level</small>
                            <div class="progress" style="height: 12px;">
                                <div class="progress-bar rounded-pill"
                                    style="width: {{ $data->skill_level * 10 }}%;
                                        background-color: {{ $data->theme_color }};">
                                </div>
                            </div>
                            <small class="fw-semibold">{{ $data->skill_level }}/10</small>
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div class="col-12">
                        <div class="bg-light p-4 rounded-3 shadow-sm">
                            <small class="text-muted d-block mb-1">📝 Bio</small>
                            <p class="mb-0">{{ $data->bio }}</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="card-footer bg-white text-end p-4 border-0">
                <a href="{{ route('profilEdit') }}" class="btn btn-outline-dark btn-sm px-4">
                    ✏ Edit Profile
                </a>
            </div>

        </div>
    </div>

    {{-- STYLES --}}
    <style>
        .profile-gallery .gallery-box {
            width: 110px;
            height: 110px;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: 0.3s;
        }

        .profile-gallery .gallery-box:hover {
            transform: scale(1.05);
        }

        .profile-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

@endsection
