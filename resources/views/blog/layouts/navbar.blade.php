<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('front/images/version/market-logo.png')}}" alt=""></a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>

            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                </li>                
            @endforeach

            @auth
                <li class="nav-item">
                    <a class="nav-link"
                        @if (auth()->user()->is_admin)
                            href="{{ route('admin.index') }}"
                        @endif
                    >{{ auth()->user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>               
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.create') }}">Register</a>
                </li>                
            @endguest

        </ul>
        <form action="{{ route('search') }}" method="GET" class="form-inline">
            <input name="s" class="form-control mr-sm-2" type="text" placeholder="How may I help?" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
