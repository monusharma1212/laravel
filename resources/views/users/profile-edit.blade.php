@extends('main')
@section('title', 'Edit Profile')

@section('content')

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4">

            <h3 class="fw-bold mb-4 text-center">Edit Profile</h3>

            <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data" id="userForm">
                @csrf

                <div class="row g-3">

                    {{-- NAME --}}
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $data->name) }}">
                        <span class="text-danger error-text name_error"></span>


                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $data->email) }}">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    {{-- EXPERIENCE --}}
                    <div class="col-md-6">
                        <label>Experience</label>
                        <input type="number" name="experience"
                            class="form-control @error('experience') is-invalid @enderror"
                            value="{{ old('experience', $data->experience) }}">
                        <span class="text-danger error-text experience_error"></span>
                    </div>

                    {{-- DEPARTMENT --}}
                    <div class="col-md-6">
                        <label>Department</label>

                        @php
                            $departments = old('department', $data->department ?? []);
                        @endphp

                        <select name="department[]" multiple class="form-select">

                            @foreach (['Engineering', 'Design', 'Marketing'] as $dept)
                                <option value="{{ $dept }}" {{ in_array($dept, $departments) ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach

                        </select>
                        <span class="text-danger error-text department_error"></span>


                    </div>

                    {{-- SKILL --}}
                    <div class="col-md-6">
                        <label>Skill Level</label>
                        <input type="range" name="skill_level" min="1" max="10"
                            value="{{ old('skill_level', $data->skill_level) }}"
                            class="form-range @error('skill_level') is-invalid @enderror">
                        <span class="text-danger error-text skill_level_error"></span>
                    </div>

                    {{-- SHIFT --}}
                    <div class="col-md-6">
                        <label>Shift</label><br>
                        <input type="radio" name="shift" value="day"
                            {{ old('shift', $data->shift) == 'day' ? 'checked' : '' }}> Day
                        <input type="radio" name="shift" value="night"
                            {{ old('shift', $data->shift) == 'night' ? 'checked' : '' }}> Night
                        <span class="text-danger error-text shift_error"></span>
                    </div>

                    {{-- COLOR --}}
                    <div class="col-md-6">
                        <label>Theme Color</label>
                        <input type="color" name="theme_color" value="{{ old('theme_color', $data->theme_color) }}"
                            class="form-control form-control-color @error('theme_color') is-invalid @enderror">
                        @error('theme_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="col-md-6">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password_confirmation" class="form-control mt-2"
                            placeholder="Confirm Password">
                    </div>

                    {{-- IMAGES --}}
                    <div class="col-12">
                        <label>Upload New Images</label>
                        <input type="file" name="images[]" multiple
                            class="form-control @error('images.*') is-invalid @enderror">
                        <span class="text-danger error-text images_error"></span>
                    </div>

                    {{-- EXISTING IMAGES --}}
                    @if (!empty($data->images))
                        @php
                            $images = is_array($data->images) ? $data->images : json_decode($data->images, true) ?? [];
                        @endphp
                        <div class="col-12 mt-3">
                            <label>Existing Images</label>
                            <div class="d-flex flex-wrap gap-3 mt-2">
                                @foreach ($images as $img)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $img) }}" width="90" height="90"
                                            style="object-fit:cover;border-radius:8px;"><br>
                                        <input type="checkbox" name="delete_images[]" value="{{ $img }}">
                                        <small class="text-danger">Delete</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- BIO --}}
                    <div class="col-12">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $data->bio) }}</textarea>
                        <span class="text-danger error-text bio_error"></span>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button class="btn btn-success px-5">Update Profile</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let form = document.getElementById("userForm");

            form.addEventListener("submit", function(e) {

                e.preventDefault();

                let formData = new FormData(form);

                document.querySelectorAll('.error-text')
                    .forEach(el => el.innerHTML = '');

                fetch(form.action, {
                        method: "POST", // 👈 PUT ki jagah POST
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(async response => {

                        let data = await response.json();

                        if (response.status === 422) {

                            Object.keys(data.errors).forEach(field => {

                                let errorElement = document.querySelector('.' + field +
                                    '_error');

                                if (errorElement) {
                                    errorElement.innerHTML = data.errors[field][0];
                                }

                            });

                        } else if (response.ok) {

                            window.location.href = data.redirect;

                        }

                    });

            });

        });
    </script>
@endsection
