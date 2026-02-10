<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        overflow: hidden;
    }
    #side {
        position: fixed;
        top: 0;
        left: 0;
        width: 16.666667%; /* col-md-2 width */
        height: 100vh;
        background: #212529;
        overflow: hidden;
        z-index: 1000;
    }
    .content-area {
        margin-left: 16.666667%;
        height: 100vh;
        overflow-y: auto;
    }
</style>


<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-2 text-white p-3" id="side">

            <a class="navbar-brand fw-bold text-white d-block mb-4" href="{{ url('/') }}">MyBrand</a>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('profile') }}"class="btn btn-primary btn-sm w-100 mb-2">My Profile</a>
                </li>
            </ul>   

            <hr class="bg-light">

            <div class="mt-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm w-100 mb-2">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light btn-sm w-100">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm w-100 mb-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm w-100">Register</a>
                @endguest
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-10 p-4 content-area">
            @yield('content')
        </div>

    </div>
</div>
