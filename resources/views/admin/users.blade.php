<div class="container-fluid py-5 w-100">

    <form method="GET" action="{{ route('users.index') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search name or email"
                value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="department" class="form-select">
                <option value="">All Departments</option>
                <option value="Design" {{ request('department') == 'Design' ? 'selected' : '' }}>Design</option>
                <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="Engineering" {{ request('department') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h4 class="mb-0">👥 Users Management</h4>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">+ Create User</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Experience</th>
                            <th>Skill</th>
                            <th>Shift</th>
                            <th>DOB</th>
                            <th>Role</th>
                            <th>Theme</th>
                            <th>Images</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                                <td class="fw-semibold">{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>

                                <td>
                                    {{ is_array($data->department) ? implode(', ', $data->department) : $data->department }}
                                </td>

                                <td><span class="badge bg-info text-dark">{{ $data->experience }} yrs</span></td>
                                <td>{{ $data->skill_level }}</td>
                                <td>{{ $data->shift }}</td>
                                <td>{{ $data->dob }}</td>
                                <td>{{ $data->role }}</td>

                                <td>
                                    <span class="badge" style="background-color: {{ $data->theme_color }}">
                                        {{ $data->theme_color }}
                                    </span>
                                </td>

                                <td>
                                    @php
                                        $images = [];
                                        if (!empty($data->images)) {
                                            $images = is_array($data->images)
                                                ? $data->images
                                                : (json_decode($data->images, true) ?? [$data->images]);
                                        }
                                    @endphp

                                    @if(count($images))
                                        @foreach ($images as $img)
                                            <img src="{{ asset('storage/'.$img) }}" width="50" height="50"
                                                 style="object-fit:cover; border-radius:6px; margin:2px;">
                                        @endforeach
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.edit', $data->id) }}" class="btn btn-warning btn-sm px-3">Edit</a>

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

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
