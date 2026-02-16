@extends('main')

@section('content')

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h4>Edit User</h4>
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Back</a>
            </div>

            <div class="card-body">

                <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- NAME --}}
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            <span class="text-danger error-text name_error"></span>
                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                            <span class="text-danger error-text email_error"></span>
                        </div>


                        {{-- PASSWORD --}}
                        <div class="col-md-6">
                            <label>Password (optional)</label>
                            <input type="password" name="password" class="form-control">
                            <span class="text-danger error-text password_error"></span>
                        </div>


                        {{-- DOB --}}
                        <div class="col-md-6">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
                            <span class="text-danger error-text dob_error"></span>
                        </div>


                        {{-- EXPERIENCE --}}
                        <div class="col-md-6">
                            <label>Experience</label>
                            <input type="number" name="experience" class="form-control"
                                value="{{ old('experience', $user->experience) }}">
                            <span class="text-danger error-text experience_error"></span>
                        </div>


                        {{-- DEPARTMENT --}}
                        <div class="col-md-6">

                            <label>Department</label>

                            @php

                                $departments = old(
                                    'department',
                                    is_array($user->department)
                                        ? $user->department
                                        : json_decode($user->department, true),
                                );

                            @endphp

                            <select name="department[]" multiple class="form-control">

                                <option value="Engineering" {{ in_array('Engineering', $departments ?? []) ? 'selected' : '' }}>
                                    Engineering
                                </option>

                                <option value="Design" {{ in_array('Design', $departments ?? []) ? 'selected' : '' }}>
                                    Design
                                </option>

                                <option value="Marketing" {{ in_array('Marketing', $departments ?? []) ? 'selected' : '' }}>
                                    Marketing
                                </option>

                            </select>

                            <span class="text-danger error-text department_error"></span>

                        </div>


                        {{-- IMAGES --}}
                        <div class="col-md-6">

                            <label>Add New Images</label>

                            <input type="file" name="images[]" multiple class="form-control">

                            <span class="text-danger error-text images_error"></span>


                            {{-- OLD IMAGES --}}
                            @php

                                $images = is_array($user->images) ? $user->images : json_decode($user->images, true);

                            @endphp

                            @if ($images)
                                <div class="mt-2">

                                    <label>Old Images</label>

                                    <br>

                                    @foreach ($images as $img)
                                        <div style="display:inline-block;margin:5px">

                                            <img src="{{ asset('storage/' . $img) }}" width="80" height="80">

                                            <br>

                                            <input type="checkbox" name="delete_images[]" value="{{ $img }}">

                                            Delete

                                        </div>
                                    @endforeach

                                </div>
                            @endif

                        </div>


                        {{-- COLOR --}}
                        <div class="col-md-6">

                            <label>Theme Color</label>

                            <input type="color" name="theme_color" value="{{ old('theme_color', $user->theme_color) }}"
                                class="form-control">

                        </div>


                        {{-- SKILL --}}
                        <div class="col-md-6">

                            <label>Skill</label>

                            <input type="range" name="skill_level" value="{{ old('skill_level', $user->skill_level) }}"
                                class="form-control">

                        </div>


                        {{-- SHIFT --}}
                        <div class="col-md-6">

                            <label>Shift</label>

                            <select name="shift" class="form-control">

                                <option value="day" {{ $user->shift == 'day' ? 'selected' : '' }}>
                                    Day
                                </option>

                                <option value="night" {{ $user->shift == 'night' ? 'selected' : '' }}>
                                    Night
                                </option>

                            </select>

                        </div>


                        {{-- BIO --}}
                        <div class="col-md-12">

                            <label>Bio</label>

                            <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-md-12 text-center">

                            <button class="btn btn-warning">
                                Update User
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
        document.addEventListener("DOMContentLoaded", function() {

            let form = document.getElementById("editUserForm");

            form.addEventListener("submit", function(e) {

                e.preventDefault(); // STOP refresh

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

                                let el = document.querySelector('.' + field + '_error');

                                if (el) {
                                    el.innerHTML = data.errors[field][0];
                                }

                            });

                        } else {

                            // SUCCESS REDIRECT
                            window.location.href = data.redirect;

                        }

                    })
                    .catch(error => {

                        console.error(error);

                    });

            });

        });
    </script>
@endsection
