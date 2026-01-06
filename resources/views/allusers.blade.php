<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All User Data</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">All User Data</h1>

    <a href="/addData" class="btn btn-outline-primary">Add New</a>
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    User List
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>age</th>
                                <th>gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>View</th>
                                <th>Delete</th>
                                <th>update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $id => $user)
                                <tr class="text-center">
                                    <td>{{ $id }}</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>{{ $user->lname }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td><a href={{ route('view.user',$user->id) }}>view</a></td>
                                    <td><a href={{ route('view.user',$user->id) }}>Delete</a></td>
                                    <td><a href={{ route('view.user',$user->id) }}>Update</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
