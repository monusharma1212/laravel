@extends('main')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">✏️ Edit User</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">Back</a>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name',$user->name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email',$user->email) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password (leave blank if no change)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Birth Date</label>
                                <input type="date" name="dob" class="form-control"
                                       value="{{ old('dob',$user->dob) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Experience</label>
                                <input type="number" name="experience" class="form-control"
                                       value="{{ old('experience',$user->experience) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Department</label>
                                <input type="text" name="department" class="form-control"
                                       value="{{ old('department',$user->department) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Skill Level</label>
                                <input type="range" name="skill_level" min="1" max="10"
                                       value="{{ old('skill_level',$user->skill_level) }}"
                                       class="form-range">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Shift</label>
                                <select name="shift" class="form-select">
                                    <option value="day" {{ $user->shift=='day'?'selected':'' }}>Day</option>
                                    <option value="night" {{ $user->shift=='night'?'selected':'' }}>Night</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Theme Color</label>
                                <input type="color" name="theme_color"
                                       value="{{ old('theme_color',$user->theme_color) }}"
                                       class="form-control form-control-color w-100">
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="newsletter" value="1"
                                           {{ $user->newsletter ? 'checked' : '' }}>
                                    <label class="form-check-label">Newsletter</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Role</label>
                                <select name="role" class="form-select">
                                    <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Resume</label>
                                <input type="file" name="resume" class="form-control">
                                @if($user->resume)
                                    <small>Current: 
                                        <a href="{{ asset('storage/'.$user->resume) }}" target="_blank">View</a>
                                    </small>
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Bio</label>
                                <textarea name="bio" class="form-control">{{ $user->bio }}</textarea>
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