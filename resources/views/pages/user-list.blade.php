@extends('main')

@section('title','FAQ')

@section('form')
<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- Card Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h4 class="mb-0">👥 Users Management</h4>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">+ Create User</a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Experience</th>
                            <th>Skill</th>
                            <th>Shift</th>
                            <th>DOB</th>
                            <th>Theme</th>
                            <th>Role</th>
                            <th>Resume</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $data)
                        <tr>
                            <td class="fw-semibold">{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->department }}</td>
                            <td><span class="badge bg-info text-dark">{{ $data->experience }} yrs</span></td>
                            <td>{{ $data->skill_level }}</td>
                            <td>{{ $data->shift }}</td>
                            <td>{{ $data->dob }}</td>

                            <td>
                                <span class="badge" style="background-color: {{ $data->theme_color }}">
                                    {{ $data->theme_color }}
                                </span>
                            </td>

                            <td>
                                <span class="badge {{ $data->role == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ ucfirst($data->role) }}
                                </span>
                            </td>

                            <td>
                                @if ($data->resume)
                                    <a href="{{ asset('storage/' . $data->resume) }}" target="_blank"
                                       class="btn btn-sm btn-outline-info">View</a>
                                @else
                                    <span class="text-muted">No File</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.edit', $data->id) }}"
                                       class="btn btn-warning btn-sm px-3">Edit</a>

                                    <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-3"
                                            onclick="return confirm('Delete this user?')">Delete</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
