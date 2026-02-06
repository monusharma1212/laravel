<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0">Users List</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Theme Color</th>
                        <th>Role</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $data->theme_color }}">
                                {{ $data->theme_color }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $data->role == 'admin' ? 'danger' : 'secondary' }}">
                                {{ $data->role }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('users/edit/'.$data->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <a href="{{ url('users/delete/'.$data->id) }}" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

</body>
</html>
