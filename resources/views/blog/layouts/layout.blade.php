<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Markedia - Marketing Blog Template</title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="{{ asset('front/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('front/images/apple-touch-icon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet"> 
    
    <link href="{{ asset('front/css/front.css') }}" rel="stylesheet">

</head>
<body>
    <div id="wrapper">
        <header class="market-header header">
            <div class="container-fluid">
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
                            <li class="nav-item">
                                <a class="nav-link" href="marketing-category.html">Marketing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="marketing-category.html">Make Money</a>
                            </li>
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
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->

        @yield('hero')

        <section class="section lb @if (url()->current() != route('home')) m3rem @endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">

                        @yield('content')

                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ asset('front/upload/small_07.jpg')}}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">5 Beautiful buildings you need to before dying</h5>
                                                <small>12 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ asset('front/upload/small_08.jpg')}}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Let's make an introduction for creative life</h5>
                                                <small>11 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 last-item justify-content-between">
                                                <img src="{{ asset('front/upload/small_09.jpg')}}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Did you see the most beautiful sea in the world?</h5>
                                                <small>07 Jan, 2016</small>
                                            </div>
                                        </a>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                            <div id="" class="widget">
                                <h2 class="widget-title">Advertising</h2>
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="{{ asset('front/upload/banner_03.jpg')}}" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Instagram Feed</h2>
                                <div class="instagram-wrapper clearfix">
                                    <a class="" href="#"><img src="{{ asset('front/upload/small_09.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_01.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_02.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_03.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_04.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_05.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_06.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_07.jpg')}}" alt="" class="img-fluid"></a>
                                    <a href="#"><img src="{{ asset('front/upload/small_08.jpg')}}" alt="" class="img-fluid"></a>
                                </div><!-- end Instagram wrapper -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Popular Categories</h2>
                                <div class="link-widget">
                                    <ul>
                                        <li><a href="#">Marketing <span>(21)</span></a></li>
                                        <li><a href="#">SEO Service <span>(15)</span></a></li>
                                        <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                        <li><a href="#">Make Money <span>(22)</span></a></li>
                                        <li><a href="#">Blogging <span>(66)</span></a></li>
                                        <li><a href="#">Entertaintment <span>(11)</span></a></li>
                                        <li><a href="#">Video Tuts <span>(87)</span></a></li>
                                    </ul>
                                </div><!-- end link-widget -->
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Recent Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ asset('front/upload/small_04.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">5 Beautiful buildings you need to before dying</h5>
                                            <small>12 Jan, 2016</small>
                                        </div>
                                    </a>

                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ asset('front/upload/small_05.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">Let's make an introduction for creative life</h5>
                                            <small>11 Jan, 2016</small>
                                        </div>
                                    </a>

                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 last-item justify-content-between">
                                            <img src="{{ asset('front/upload/small_06.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">Did you see the most beautiful sea in the world?</h5>
                                            <small>07 Jan, 2016</small>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Posts</h2>
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ asset('front/upload/small_01.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">Banana-chip chocolate cake recipe with customs</h5>
                                            <span class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                    </a>

                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ asset('front/upload/small_02.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">10 practical ways to choose organic vegetables</h5>
                                            <span class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                    </a>

                                    <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 last-item justify-content-between">
                                            <img src="{{ asset('front/upload/small_03.jpg')}}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">We are making homemade ravioli, nice and good</h5>
                                            <span class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <h2 class="widget-title">Popular Categories</h2>
                            <div class="link-widget">
                                <ul>
                                    <li><a href="#">Marketing <span>(21)</span></a></li>
                                    <li><a href="#">SEO Service <span>(15)</span></a></li>
                                    <li><a href="#">Digital Agency <span>(31)</span></a></li>
                                    <li><a href="#">Make Money <span>(22)</span></a></li>
                                    <li><a href="#">Blogging <span>(66)</span></a></li>
                                    <li><a href="#">Entertaintment <span>(11)</span></a></li>
                                    <li><a href="#">Video Tuts <span>(87)</span></a></li>
                                </ul>
                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-md-12 text-center">
                        <br>
                        <br>
                        <div class="copyright">&copy; Markedia. Design: <a href="http://html.design">HTML Design</a>.</div>
                    </div>
                </div>
            </div><!-- end container -->
        </footer><!-- end footer -->

        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->

<script src="{{ asset('front/js/front.js') }}"></script>
</body>
</html>