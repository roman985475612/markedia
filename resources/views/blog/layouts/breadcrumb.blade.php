<div class="page-title db">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>{{ $category_title }}
                    @if (!empty($small_title)) 
                        <small class="hidden-xs-down hidden-sm-down">{{ $small_title }}</small>
                    @endif
                </h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    @if (isset($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (isset($breadcrumb[1]))
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb[1] }}">{{ $breadcrumb[0] }}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{ $breadcrumb[0] }}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->
