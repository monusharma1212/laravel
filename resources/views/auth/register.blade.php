@extends('main')

@section('hideHeader') {{-- this hides header --}} @endsection

@section('title', 'Registration Page')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 shadow p-4 rounded bg-white">

                <h3 class="text-center mb-4">Create Your Account</h3>

                <form id="registerForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger error-text password_error"></span>
                        </div>

                        {{-- Birth Date --}}
                        <div class="col-md-6">
                            <label class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" class="form-control">
                            <span class="text-danger error-text birth_date_error"></span>
                        </div>

                        {{-- Experience --}}
                        <div class="col-md-6">
                            <label class="form-label">Experience</label>
                            <input type="number" name="experience" class="form-control">
                            <span class="text-danger error-text experience_error"></span>
                        </div>

                        {{-- Department --}}
                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <select name="department[]" multiple class="form-select">
                                <option value="Engineering">Engineering</option>
                                <option value="Design">Design</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                            <span class="text-danger error-text department_error"></span>
                        </div>

                        {{-- Images --}}
                        <div class="col-md-6">
                            <label class="form-label">Upload Images</label>
                            <input type="file" name="images[]" multiple class="form-control">
                            <span class="text-danger error-text images_error"></span>
                        </div>

                        {{-- Theme Color --}}
                        <div class="col-md-6">
                            <label class="form-label">Theme Color</label>
                            <input type="color" name="color" class="form-control form-control-color w-100">
                            <span class="text-danger error-text color_error"></span>
                        </div>

                        {{-- Skill --}}
                        <div class="col-md-6">
                            <label class="form-label">Skill Level</label>
                            <input type="range" name="skill_level" min="1" max="10" class="form-range">
                            <span class="text-danger error-text skill_level_error"></span>
                        </div>

                        {{-- Shift --}}
                        <div class="col-md-6">
                            <label class="d-block">Shift</label>

                            <input type="radio" name="shift" value="day"> Day
                            <input type="radio" name="shift" value="night"> Night

                            <span class="text-danger error-text shift_error"></span>
                        </div>

                        {{-- Bio --}}
                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control"></textarea>
                            <span class="text-danger error-text bio_error"></span>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                Register
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {

            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            // clear old errors
            document.querySelectorAll('.error-text').forEach(el => el.innerHTML = '');

            fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => {

                    if (response.status === 422) {

                        return response.json().then(data => {

                            Object.keys(data.errors).forEach(field => {

                                let errorSpan = document.querySelector('.' + field + '_error');

                                if (errorSpan) {
                                    errorSpan.innerHTML = data.errors[field][0];
                                }

                            });

                        });

                    } else if (response.status === 200) {

                        window.location.href = "{{ route('dashboard') }}";

                        form.reset();

                    }

                })
                .catch(error => {
                    console.log(error);
                });

        });
    </script>
@endsection
