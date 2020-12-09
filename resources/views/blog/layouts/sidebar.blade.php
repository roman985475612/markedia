<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="marketing-index.html"><img src="{{ asset('front/images/version/market-logo.png')}}" alt=""></a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="marketing-index.html">Home</a>
            </li>

            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                </li>                
            @endforeach

            <li class="nav-item">
                <a class="nav-link" href="marketing-blog.html">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="marketing-contact.html">Contact Us</a>
            </li>
        </ul>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="text" placeholder="How may I help?">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>