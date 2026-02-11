@extends('main')
@section('title','Edit Profile')

@section('content')

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">

        <h3 class="fw-bold mb-4 text-center">Edit Profile</h3>

        <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- NAME --}}
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name',$data->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- EMAIL --}}
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email',$data->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- EXPERIENCE --}}
                <div class="col-md-6">
                    <label>Experience</label>
                    <input type="number" name="experience"
                        class="form-control @error('experience') is-invalid @enderror"
                        value="{{ old('experience',$data->experience) }}">
                    @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- DEPARTMENT --}}
                <div class="col-md-6">
                    <label>Department</label>
                    @php
                        $departments = old('department') ?: (is_array($data->department)
                            ? $data->department
                            : (json_decode($data->department, true) ?? []));
                    @endphp
                    <select name="department[]" multiple
                        class="form-select @error('department') is-invalid @enderror">
                        <option value="Engineering" {{ in_array('Engineering',$departments)?'selected':'' }}>Engineering</option>
                        <option value="Design" {{ in_array('Design',$departments)?'selected':'' }}>Design</option>
                        <option value="Marketing" {{ in_array('Marketing',$departments)?'selected':'' }}>Marketing</option>
                    </select>
                    @error('department') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                {{-- SKILL --}}
                <div class="col-md-6">
                    <label>Skill Level</label>
                    <input type="range" name="skill_level" min="1" max="10"
                        value="{{ old('skill_level',$data->skill_level) }}"
                        class="form-range @error('skill_level') is-invalid @enderror">
                    @error('skill_level') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- SHIFT --}}
                <div class="col-md-6">
                    <label>Shift</label><br>
                    <input type="radio" name="shift" value="day"
                        {{ old('shift',$data->shift)=='day'?'checked':'' }}> Day
                    <input type="radio" name="shift" value="night"
                        {{ old('shift',$data->shift)=='night'?'checked':'' }}> Night
                    @error('shift') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- COLOR --}}
                <div class="col-md-6">
                    <label>Theme Color</label>
                    <input type="color" name="theme_color"
                        value="{{ old('theme_color',$data->theme_color) }}"
                        class="form-control form-control-color @error('theme_color') is-invalid @enderror">
                    @error('theme_color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="col-md-6">
                    <label>New Password</label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <input type="password" name="password_confirmation"
                        class="form-control mt-2" placeholder="Confirm Password">
                </div>

                {{-- IMAGES --}}
                <div class="col-12">
                    <label>Upload New Images</label>
                    <input type="file" name="images[]" multiple
                        class="form-control @error('images.*') is-invalid @enderror">
                    @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                {{-- EXISTING IMAGES --}}
                @if(!empty($data->images))
                @php
                    $images = is_array($data->images)
                        ? $data->images
                        : (json_decode($data->images, true) ?? []);
                @endphp
                <div class="col-12 mt-3">
                    <label>Existing Images</label>
                    <div class="d-flex flex-wrap gap-3 mt-2">
                        @foreach($images as $img)
                        <div class="text-center">
                            <img src="{{ asset('storage/'.$img) }}" width="90" height="90"
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
                    <textarea name="bio"
                        class="form-control @error('bio') is-invalid @enderror">{{ old('bio',$data->bio) }}</textarea>
                    @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 text-center mt-4">
                    <button class="btn btn-success px-5">Update Profile</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
