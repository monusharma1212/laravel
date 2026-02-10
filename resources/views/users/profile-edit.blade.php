@extends('main')
@section('title','Edit Profile')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">

        <h3 class="fw-bold mb-4 text-center">Edit Profile</h3>

        <form action="{{ route('profileUpdate') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name',$data->name) }}">
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email',$data->email) }}">
                </div>

                <div class="col-md-6">
                    <label>Experience</label>
                    <input type="number" name="experience" class="form-control"
                        value="{{ old('experience',$data->experience) }}">
                </div>

                <div class="col-md-6">
                    <label>Department</label>
                    @php
                        $departments = old('department');

                        if (!$departments) {
                            $departments = is_array($data->department)
                                ? $data->department
                                : (json_decode($data->department, true) ?? [$data->department]);
                        }
                    @endphp

                    <select name="department[]" multiple class="form-select">
                        <option value="Engineering" {{ in_array('Engineering',$departments)?'selected':'' }}>Engineering</option>
                        <option value="Design" {{ in_array('Design',$departments)?'selected':'' }}>Design</option>
                        <option value="Marketing" {{ in_array('Marketing',$departments)?'selected':'' }}>Marketing</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Skill Level</label>
                    <input type="range" name="skill_level" min="1" max="10"
                        value="{{ $data->skill_level }}" class="form-range">
                </div>

                <div class="col-md-6">
                    <label>Shift</label><br>
                    <input type="radio" name="shift" value="day" {{ $data->shift=='day'?'checked':'' }}> Day
                    <input type="radio" name="shift" value="night" {{ $data->shift=='night'?'checked':'' }}> Night
                </div>

                <div class="col-md-6">
                    <label>Theme Color</label>
                    <input type="color" name="theme_color" value="{{ $data->theme_color }}" class="form-control form-control-color">
                </div>

                <div class="col-md-6">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-12">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control">{{ $data->bio }}</textarea>
                </div>

                <div class="col-12 text-center mt-3">
                    <button class="btn btn-success px-5">Update Profile</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
