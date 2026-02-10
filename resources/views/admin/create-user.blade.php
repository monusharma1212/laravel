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
                        @if(isset($user)) @method('PUT') @endif
                        <h1 class="text-center  text-red-600">Create Users</h1>

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name ?? '') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email ?? '') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Password {{ isset($user) ? '(leave blank if no change)' : '' }}
                                </label>
                                <input type="password" name="password"
                                value="{{ old('dob', $user->password ?? '') }}"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- DOB --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Birth Date</label>
                                <input type="date" name="dob"
                                       class="form-control @error('dob') is-invalid @enderror"
                                       value="{{ old('dob', $user->dob ?? '') }}">
                                @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Experience --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Experience (Years)</label>
                                <input type="number" name="experience"
                                    class="form-control @error('experience') is-invalid @enderror"
                                    value="{{ old('experience', $user->experience ?? '') }}">
                                @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Department --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Department</label>
                            
                                <select name="department[]" multiple
                                    class="form-select @error('department') is-invalid @enderror">
                            
                                    @php
                                        $selectedDepartments = old('department', isset($user) ? (array)$user->department : []);
                                    @endphp
                            
                                    <option value="Engineering" {{ in_array('Engineering', $selectedDepartments) ? 'selected' : '' }}>Engineering</option>
                                    <option value="Design" {{ in_array('Design', $selectedDepartments) ? 'selected' : '' }}>Design</option>
                                    <option value="Marketing" {{ in_array('Marketing', $selectedDepartments) ? 'selected' : '' }}>Marketing</option>
                                </select>
                            
                                @error('department') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            

                            {{-- Images --}}
                            <div class="col-md-6">
                                <label class="form-label">Upload Images</label>
                                <input type="file" name="images[]" multiple
                                       class="form-control @error('images.*') is-invalid @enderror">
                                @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            {{-- Theme --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Theme Color</label>
                                <input type="color" name="theme_color"
                                       class="form-control form-control-color w-100 @error('theme_color') is-invalid @enderror"
                                       value="{{ old('theme_color', $user->theme_color ?? '#000000') }}">
                                @error('theme_color') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            {{-- Skill --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Skill Level</label>
                                <input type="range" name="skill_level" min="1" max="10"
                                       class="form-range @error('skill_level') is-invalid @enderror"
                                       value="{{ old('skill_level', $user->skill_level ?? 5) }}">
                                @error('skill_level') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Shift --}}
                            <div class="col-md-6">
                                <label class="fw-semibold d-block">Shift</label>
                                <input type="radio" name="shift" value="day"
                                    {{ old('shift',$user->shift ?? '')=='day'?'checked':'' }}> Day
                                <input type="radio" name="shift" value="night"
                                    {{ old('shift',$user->shift ?? '')=='night'?'checked':'' }}> Night
                                @error('shift') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>

                            {{-- Bio --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Bio</label>
                                <textarea name="bio" value="{{ old('bio', $user->bio ?? '') }}"
                                class="form-control @error('bio') is-invalid @enderror">{{ old('bio',$user->bio ?? '') }}</textarea>
                                @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button class="btn btn-success px-5">
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
