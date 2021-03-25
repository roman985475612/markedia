@extends('blog.layouts.layout')

@section('content')
    <div class="page-wrapper">
        <div class="blog-title-area">
            <span class="color-yellow"><a href="{{ route('category', $post->category->slug) }}" title="">{{ $post->category->title }}</a></span>

            <h3>{{ $post->title }}</h3>

            <div class="blog-meta big-meta">
                <small><a href="#" title="">{{ $post->getDate() }}</a></small>
                <small><a href="{{ route('user.posts', $post->user->id) }}" title="">by {{ $post->user->name }}</a></small>
                <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $post->views }}</a></small>
            </div><!-- end meta -->

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{ $post->getThumbnail() }}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">  
            <div class="pp">
                {!! $post->content !!}
            </div><!-- end pp -->
        </div><!-- end content -->

        <div class="blog-title-area">
            @if ($post->tags->count())
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach ($post->tags as $tag)
                        <small><a href="{{ route('tag', $tag->slug) }}" title="">{{ $tag->title }}</a></small>                
                    @endforeach
                </div><!-- end meta -->
            @endif

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <hr class="invis1">

        <div class="custombox authorbox clearfix">
            <h4 class="small-title">About author</h4>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <img src="{{ $post->user->getThumbnail() }}" alt="" class="img-fluid rounded-circle"> 
                </div><!-- end col -->

                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <h4><a href="{{ route('user.posts', $post->user->id) }}">{{ $post->user->name }}</a></h4>
                    <p>{{ $post->user->description }}</p>

                    <div class="topsocial">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                    </div><!-- end social -->

                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end author-box -->

        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title">You may also like</h4>
            <div class="row">
                @if ($post->hasPrev())
                    <div class="col-lg-6">
                        <div class="blog-box">
                            <div class="post-media">
                                <a href="{{ route('article', $prevPost->slug) }}" title="">
                                    <img src="{{ $prevPost->getThumbnail() }}" alt="" class="img-fluid">
                                    <div class="hovereffect">
                                        <span class=""></span>
                                    </div><!-- end hover -->
                                </a>
                            </div><!-- end media -->
                            <div class="blog-meta">
                                <h4><a href="{{ route('article', $prevPost->slug) }}" title="">{{ $prevPost->title }}</a></h4>
                                <small><a href="{{ route('category', $prevPost->category->slug) }}" title="">{{ $prevPost->category->title }}</a></small>
                                <small><a href="{{ route('category', $prevPost->category->slug) }}" title="">{{ $prevPost->getDate() }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                    </div><!-- end col -->
                @endif
                @if ($post->hasNext())
                    <div class="col-lg-6">
                        <div class="blog-box">
                            <div class="post-media">
                                <a href="{{ route('article', $nextPost->slug) }}" title="">
                                    <img src="{{ $nextPost->getThumbnail() }}" alt="" class="img-fluid">
                                    <div class="hovereffect">
                                        <span class=""></span>
                                    </div><!-- end hover -->
                                </a>
                            </div><!-- end media -->
                            <div class="blog-meta">
                                <h4><a href="{{ route('article', $nextPost->slug) }}" title="">{{ $nextPost->title }}</a></h4>
                                <small><a href="{{ route('category', $nextPost->category->slug) }}" title="">{{ $nextPost->category->title }}</a></small>
                                <small><a href="{{ route('category', $nextPost->category->slug) }}" title="">{{ $nextPost->getDate() }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                    </div><!-- end col -->
                @endif
            </div><!-- end row -->
        </div><!-- end custom-box -->

        <hr class="invis1">

        @if ($post->hasComments())
            <div class="custombox clearfix">
                <h4 class="small-title">{{ $post->countComments() }} Comments</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="comments-list">
                            @foreach ($post->getComments() as $comment)
                                <div class="media">
                                    <a class="media-left" href="#!">
                                        <img src="{{ $comment->author->getThumbnail() }}" alt="" class="rounded-circle">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading user_name">{{ $comment->author->name }} <small>{{ $comment->getDate() }}</small></h4>
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end custom-box -->

            <hr class="invis1">
            
        @endif

        @auth
            <div class="custombox clearfix">
                <h4 class="small-title">Leave a Reply</h4>
                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::open([
                            'method'=> 'post',
                            'route' => ['article.add_comment', $post->slug], 
                            'class' => 'form-wrapper'
                        ]) !!}
                            {{ Form::hidden('post_id', $post->id) }}
                            {{ Form::textarea('text', null, [
                                'class'       => 'form-control', 
                                'placeholder' => 'Your comment',
                                'required'    => true
                            ]) }}
                            {{ Form::submit('Submit Comment', ['class' => 'btn btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>           
        @endauth

    </div><!-- end page-wrapper -->
@endsection