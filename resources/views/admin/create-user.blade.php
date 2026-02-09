@extends('main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-4">


                <div class="card-body p-4">

                    <form action="{{ isset($user) ? route('users.update',$user->id) : route('users.store') }}"
                          method="POST" enctype="multipart/form-data">

                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $user->name ?? '') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $user->email ?? '') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Password {{ isset($user) ? '(leave blank if no change)' : '' }}
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Birth Date</label>
                                <input type="date" name="dob" class="form-control"
                                       value="{{ old('dob', $user->dob ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Experience (Years)</label>
                                <input type="number" name="experience" class="form-control"
                                       value="{{ old('experience', $user->experience ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Department</label>
                                <select name="department" class="form-select">
                                    <option value="">Choose...</option>
                                    <option {{ old('department',$user->department ?? '')=='Engineering'?'selected':'' }}>Engineering</option>
                                    <option {{ old('department',$user->department ?? '')=='Design'?'selected':'' }}>Design</option>
                                    <option {{ old('department',$user->department ?? '')=='Marketing'?'selected':'' }}>Marketing</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Resume (PDF)</label>
                                <input type="file" name="resume" class="form-control" accept=".pdf">
                                @if(isset($user) && $user->resume)
                                    <small class="text-muted">Current:
                                        <a href="{{ asset('storage/'.$user->resume) }}" target="_blank">View</a>
                                    </small>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Theme Color</label>
                                <input type="color" name="theme_color"
                                       value="{{ old('theme_color', $user->theme_color ?? '#000000') }}"
                                       class="form-control form-control-color w-100">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Skill Level</label>
                                <input type="range" name="skill_level" min="1" max="10"
                                       value="{{ old('skill_level', $user->skill_level ?? 5) }}"
                                       class="form-range">
                            </div>

                            <div class="col-md-6">
                                <label class="d-block fw-semibold mb-2">Preferred Shift</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="shift" value="day"
                                        {{ old('shift',$user->shift ?? '')=='day'?'checked':'' }}
                                        class="form-check-input">
                                    <label class="form-check-label">Day</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="shift" value="night"
                                        {{ old('shift',$user->shift ?? '')=='night'?'checked':'' }}
                                        class="form-check-input">
                                    <label class="form-check-label">Night</label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="newsletter" value="1"
                                        {{ old('newsletter',$user->newsletter ?? false)?'checked':'' }}>
                                    <label class="form-check-label">Subscribe to Newsletter</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Role</label>
                                <select name="role" class="form-select">
                                    <option value="user" {{ old('role',$user->role ?? '')=='user'?'selected':'' }}>User</option>
                                    <option value="admin" {{ old('role',$user->role ?? '')=='admin'?'selected':'' }}>Admin</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Bio</label>
                                <textarea name="bio" class="form-control" rows="3">{{ old('bio',$user->bio ?? '') }}</textarea>
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button class="btn btn-success px-5 py-2">
                                    {{ isset($user) ? 'Update User' : 'Create User' }}
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
