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
                    <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing
                    </option>
                    <option value="Engineering" {{ request('department') == 'Engineering' ? 'selected' : '' }}>
                        Engineering
                    </option>
                </select>
            </div>

            <!-- Filter Button -->
            <div>
                <button style="min-width:250px;" class="btn btn-primary">Filter</button>
            </div>

        </form>

        <!-- Export Button -->
        <button style="min-width:250px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
            Export
        </button>

    </div>



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
                                            <img src="{{ asset('storage/' . $img) }}"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit:cover; border-radius:6px; margin:2px;">
                                        @endforeach
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $data->id) }}"
                                       class="btn btn-warning btn-sm px-2">
                                        Edit
                                    </a>
                                
                                    <button class="btn btn-danger btn-sm px-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $data->id }}">
                                        Delete
                                    </button>
                                </td>
                                
                                
                                @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>


<div class="d-flex justify-content-center mt-4" id="paginate">
    {{ $users->links('pagination::bootstrap-5') }}
</div>

<script>
    function closeExportModal() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
        modal.hide();
    }
</script>

<style>
    .pagination {
        gap: 5px;
    }
</style>