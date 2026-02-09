<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">MyBrand</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('location') ? 'active' : '' }}" href="{{ route('location') }}">Location</a>
                </li>
                   {{-- Admin Special Menu --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="{{ route('users.index') }}">
                                Users List
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex gap-2">

                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                        Dashboard
                    </a>
            
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            
            
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        Login
                    </a>
            
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        Register
                    </a>
                @endguest
            
            </div>
            
        </div>
    </div>
</nav>
