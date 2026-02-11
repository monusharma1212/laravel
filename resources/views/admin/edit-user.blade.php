@extends('main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">✏️ Edit User</h4>
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Back</a>
                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password (leave blank if no change)</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Birth Date</label>
                                    <input type="date" name="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob', $user->dob) }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Experience</label>
                                    <input type="number" name="experience"
                                        class="form-control @error('experience') is-invalid @enderror"
                                        value="{{ old('experience', $user->experience) }}">
                                    @error('experience')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Department --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Department</label>
                                    @php
                                        $selectedDepartments = old(
                                            'department',
                                            is_array($user->department)
                                                ? $user->department
                                                : json_decode($user->department, true) ?? [$user->department],
                                        );
                                    @endphp
                                    <select name="department[]" multiple class="form-select">
                                        <option value="Engineering"
                                            {{ in_array('Engineering', $selectedDepartments) ? 'selected' : '' }}>
                                            Engineering
                                        </option>
                                        <option value="Design"
                                            {{ in_array('Design', $selectedDepartments) ? 'selected' : '' }}>
                                            Design</option>
                                        <option value="Marketing"
                                            {{ in_array('Marketing', $selectedDepartments) ? 'selected' : '' }}>Marketing
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Skill Level</label>
                                    <input type="range" name="skill_level" min="1" max="10"
                                        value="{{ old('skill_level', $user->skill_level) }}" class="form-range">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Shift</label>
                                    <select name="shift" class="form-select">
                                        <option value="day" {{ $user->shift == 'day' ? 'selected' : '' }}>Day</option>
                                        <option value="night" {{ $user->shift == 'night' ? 'selected' : '' }}>Night
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Theme Color</label>
                                    <input type="color" name="theme_color"
                                        value="{{ old('theme_color', $user->theme_color) }}"
                                        class="form-control form-control-color w-100">
                                </div>

                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" name="newsletter" value="1"
                                            {{ $user->newsletter ? 'checked' : '' }}>
                                        <label class="form-check-label">Newsletter</label>
                                    </div>
                                </div>

                                {{-- Images --}}
                                <div class="col-md-6">
                                    <label class="form-label">Upload Images</label>
                                    <input type="file" name="images[]" multiple
                                        class="form-control @error('images.*') is-invalid @enderror">
                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    @php
                                        $images = [];

                                        if (!empty($user->images)) {
                                            $images = is_array($user->images)
                                                ? $user->images
                                                : json_decode($user->images, true) ?? [$user->images];
                                        }
                                    @endphp

                                    @if (count($images))
                                        <div class="mt-2">
                                            @foreach ($images as $img)
                                                <div style="display:inline-block; margin:5px; text-align:center;">
                                                    <img src="{{ asset('storage/' . $img) }}" width="70" height="70"
                                                        style="object-fit:cover; border-radius:6px;"><br>
                                                    <input type="checkbox" name="delete_images[]"
                                                        value="{{ $img }}">
                                                    <small class="text-danger">Delete</small>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Bio</label>
                                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 text-center mt-4">
                                    <button class="btn btn-warning px-5">Update User</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
