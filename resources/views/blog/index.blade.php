@extends('blog.layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">
            @forelse ($posts as $post)
                <div class="blog-box wow fadeIn">
                    <div class="post-media">
                        <a href="{{ route('article', $post->slug) }}" title="">
                            <img src="{{ $post->getThumbnail() }}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span></span>
                            </div>
                            <!-- end hover -->
                        </a>
                    </div>
                    <!-- end media -->
                    <div class="blog-meta big-meta text-center">
                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                        <h4><a href="{{ route('article', $post->slug) }}" title="">{{ $post->title }}</a></h4>
                        <p>{!! $post->description !!}</p>
                        <small><a href="{{ route('category', $post->category->slug) }}" title="">{{ $post->category->title }}</a></small>
                        <small><a href="{{ route('article', $post->slug) }}" title="">{{ $post->getDate() }}</a></small>
                        <small><a href="{{ route('user.posts', $post->user->id) }}" title="">by {{ $post->user->name }}</a></small>
                        <small><a><i class="fa fa-eye"></i> {{ $post->views }}</a></small>
                    </div><!-- end meta -->
                </div><!-- end blog-box -->
            @empty
                <p>По Вашему запросу ничего не найдено...</p>
            @endforelse
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            {{ $posts->links('vendor.pagination.blog-pagination') }}
        </div><!-- end col -->
    </div>
@endsection
