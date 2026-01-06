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
                                <th>Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Age</th>
                                <th>view</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $id => $user)
                                <tr class="text-center">
                                    <td>{{ $id+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td><a href={{ route('view.user',$user->id) }}>view</a></td>
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
