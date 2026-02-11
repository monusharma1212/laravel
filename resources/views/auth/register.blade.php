@extends('main')

@section('hideHeader')  {{-- this hides header --}} @endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 shadow p-4 rounded bg-white">
            <h3 class="text-center mb-4">Create Your Account</h3>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">   

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div class="col-md-6">
                        <label class="form-label">Birth Date</label>
                        <input type="date" name="birth_date"
                               class="form-control @error('birth_date') is-invalid @enderror">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Experience --}}
                    <div class="col-md-6">
                        <label class="form-label">Experience (Years)</label>
                        <input type="number" name="experience"
                               class="form-control @error('experience') is-invalid @enderror"
                               value="{{ old('experience') }}">
                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select name="department[]" multiple
                                class="form-select @error('department') is-invalid @enderror">
                            <option value="Engineering"
                                {{ collect(old('department'))->contains('Engineering') ? 'selected' : '' }}>
                                Engineering
                            </option>
                            <option value="Design"
                                {{ collect(old('department'))->contains('Design') ? 'selected' : '' }}>
                                Design
                            </option>
                            <option value="Marketing"
                                {{ collect(old('department'))->contains('Marketing') ? 'selected' : '' }}>
                                Marketing
                            </option>
                        </select>
                    
                        @error('department')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    {{-- Images --}}
                    <div class="col-md-6">
                        <label class="form-label">Upload Images</label>
                        <input type="file" name="images[]" multiple
                               class="form-control @error('images.*') is-invalid @enderror">
                        @error('images.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Theme Color --}}
                    <div class="col-md-6">
                        <label class="form-label">Theme Color</label>
                        <input type="color" name="color"
                               class="form-control form-control-color w-100 @error('color') is-invalid @enderror"
                               value="{{ old('color') }}">
                        @error('color')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Skill Level --}}
                    <div class="col-md-6">
                        <label class="form-label">Skill Level</label>
                        <input type="range" name="skill_level"
                               class="form-range @error('skill_level') is-invalid @enderror"
                               min="1" max="10" value="{{ old('skill_level',5) }}">
                        @error('skill_level')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Shift --}}
                    <div class="col-md-6">
                        <label class="d-block mb-2">Preferred Shift</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shift" value="day"
                                {{ old('shift','day')=='day'?'checked':'' }}>
                            <label class="form-check-label">Day</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shift" value="night"
                                {{ old('shift')=='night'?'checked':'' }}>
                            <label class="form-check-label">Night</label>
                        </div>
                        @error('shift')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div class="col-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio"
                                  class="form-control @error('bio') is-invalid @enderror">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-primary px-5">Register</button>
                    </div>
                    
                    <div class="col-12 text-center mt-3">
                        <p class="mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none">
                                Login Here
                            </a>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
