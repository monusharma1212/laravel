
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title', 'Join Us - Create Account')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>
<body>

    @include('layouts.header')
    <h1>This is the Dashboard</h1>
    Welcome {{ auth()->user()->name }}

    <main class="container my-5">
        @yield('content')
    </main>

    @include('layouts.footer')  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- @yield('script') --}}
</body>
</html>

