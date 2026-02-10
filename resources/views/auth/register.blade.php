@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@extends('main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 shadow p-4 rounded bg-white">
            <h3 class="text-center mb-4">Create Your Account</h3>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">   

                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Experience (Years)</label>
                        <input type="number" name="experience" class="form-control" min="0" max="50">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select name="department" class="form-select">
                            <option value="">Choose...</option>
                            <option>Engineering</option>
                            <option>Design</option>
                            <option>Marketing</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Upload Images</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Theme Color</label>
                        <input type="color" name="color" class="form-control form-control-color w-100">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Skill Level</label>
                        <input type="range" name="skill_level" class="form-range">
                    </div>

                    <div class="col-md-6">
                        <label class="d-block mb-2">Preferred Shift</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shift" value="day" checked>
                            <label class="form-check-label">Day</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shift" value="night">
                            <label class="form-check-label">Night</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="newsletter" value="1">
                            <label class="form-check-label">Subscribe to Newsletter</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">Agree to Terms</label>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-primary px-5">Register</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
