@extends('main')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">
                            {{ isset($user) ? 'Update User' : 'Create User' }}
                        </h3>

                        <form id="userForm"
                            action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @if (isset($user))
                                @method('PUT')
                            @endif

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $user->name ?? '' }}">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $user->email ?? '' }}">
                                    <span class="text-danger error-text email_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <span class="text-danger error-text password_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control"
                                        value="{{ $user->dob ?? '' }}">
                                    <span class="text-danger error-text dob_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Experience</label>
                                    <input type="number" name="experience" class="form-control"
                                        value="{{ $user->experience ?? '' }}">
                                    <span class="text-danger error-text experience_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Department</label>
                                    <select name="department[]" multiple class="form-control">
                                        <option value="Engineering">Engineering</option>
                                        <option value="Design">Design</option>
                                        <option value="Marketing">Marketing</option>
                                    </select>
                                    <span class="text-danger error-text department_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Images</label>
                                    <input type="file" name="images[]" multiple class="form-control">
                                    <span class="text-danger error-text images_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Theme Color</label>
                                    <input type="color" name="theme_color" value="{{ $user->theme_color ?? '#000000' }}"
                                        class="form-control">
                                    <span class="text-danger error-text theme_color_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Skill</label>
                                    <input type="range" name="skill_level" value="{{ $user->skill_level ?? 5 }}"
                                        class="form-control">
                                    <span class="text-danger error-text skill_level_error"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Shift</label><br>
                                    <input type="radio" name="shift" value="day"> Day
                                    <input type="radio" name="shift" value="night"> Night
                                    <span class="text-danger error-text shift_error"></span>
                                </div>

                                <div class="col-md-12">
                                    <label>Bio</label>
                                    <textarea name="bio" class="form-control">{{ $user->bio ?? '' }}</textarea>
                                    <span class="text-danger error-text bio_error"></span>
                                </div>

                                <div class="col-md-12 text-center mt-3">
                                    <button class="btn btn-success">
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


@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let form = document.getElementById("userForm");

            form.addEventListener("submit", function(e) {

                e.preventDefault(); // STOP REFRESH

                let formData = new FormData(form);

                document.querySelectorAll('.error-text')
                    .forEach(el => el.innerHTML = '');

                fetch(form.action, {

                        method: "POST",

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

                                let el =
                                    document.querySelector('.' + field + '_error');

                                if (el) {
                                    el.innerHTML = data.errors[field][0];
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
