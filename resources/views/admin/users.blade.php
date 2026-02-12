<div class="container-fluid py-5 w-100">

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-1 mb-3">

        <!-- Filter Form -->
        <form method="GET" action="{{ route('users.index') }}"
            class="d-flex flex-wrap align-items-end gap-2 flex-grow-1">

            <!-- Search -->
            <div style="min-width:450px;">
                <input type="text" name="search" class="form-control" placeholder="Search name or email"
                    value="{{ request('search') }}">
            </div>

            <!-- Department -->
            <div style="min-width:450px;">
                <select name="department" class="form-select">
                    <option value="">All Departments</option>
                    <option value="Design" {{ request('department') == 'Design' ? 'selected' : '' }}>Design</option>
                    <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Engineering" {{ request('department') == 'Engineering' ? 'selected' : '' }}>Engineering
                    </option>
                </select>
            </div>

            <!-- Filter Button -->
            <div >
                <button style="min-width:250px;" class="btn btn-primary">Filter</button>
            </div>

        </form>

        <!-- Export Button -->
        <button style="min-width:250px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
            Export
        </button>

    </div>


<<<<<<< HEAD
        <div class="col-md-3">
            <select name="department" class="form-select">
                <option value="">All Departments</option>
                <option value="Design" {{ request('department') == 'Design' ? 'selected' : '' }}>Design</option>
                <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing
                </option>
                <option value="Engineering" {{ request('department') == 'Engineering' ? 'selected' : '' }}>Engineering
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Export </button>
        </div>
    </form>
=======
>>>>>>> 174c52b (custome_validation message)

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
                                    @forelse((array) $data->department as $dept)
                                        <span class="badge bg-info">{{ $dept }}</span>
                                    @empty
                                        <span class="text-muted">No Department</span>
                                    @endforelse
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
<<<<<<< HEAD
                                    @forelse((array) $data->images as $img)
                                        <img src="{{ asset('storage/'.$img) }}" width="50" height="50"
                                            style="object-fit:cover; border-radius:6px; margin:2px;">
                                    @empty
=======
                                    @php
                                        $images = [];
                                        if (!empty($data->images)) {
                                            $images = is_array($data->images)
                                                ? $data->images
                                                : json_decode($data->images, true) ?? [$data->images];
                                        }
                                    @endphp

                                    @if (count($images))
                                        @foreach ($images as $img)
                                            <img src="{{ asset('storage/' . $img) }}" width="50" height="50"
                                                style="object-fit:cover; border-radius:6px; margin:2px;">
                                        @endforeach
                                    @else
>>>>>>> 174c52b (custome_validation message)
                                        <span class="text-muted">No Image</span>
                                    @endforelse
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
<<<<<<< HEAD
                                        <a href="{{ route('users.edit', $data->id) }}"
                                            class="btn btn-warning btn-sm px-3">Edit</a>

                                        <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm px-3"
                                                onclick="return confirm('Delete this user?')">Delete</button>
                                        </form>
=======
                                        <button class="btn btn-danger btn-sm px-3" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $data->id }}"> Delete </button>
>>>>>>> 174c52b (custome_validation message)
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


@foreach ($users as $data)
    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are Want to Delete this users??
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="exportModal" tabindex="-3">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Select Export Format</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                <a href="{{ route('users.export.csv') }}" class="btn btn-success m-2 px-4">
                    Export CSV
                </a>

                <a href="{{ route('users.export.pdf') }}" class="btn btn-danger m-2 px-4">
                    Export PDF
                </a>

            </div>

        </div>
    </div>
</div>


