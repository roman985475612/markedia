<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Recent Posts</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                @foreach ($recentPosts as $post)
                    <a href="{{ route('article', $post->slug) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <img src="{{ $post->getThumbnail() }}" alt="" class="img-fluid float-left">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <small>{{ $post->getDate() }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->

    <div class="widget">
        <h2 class="widget-title">Popular Categories</h2>
        <div class="link-widget">
            <ul>
                @foreach ($popularCategories as $category)
                    <li><a href="{{ route('category', $category->slug) }}">{{ $category->title }} <span>({{ $category->posts_count }})</span></a></li>                
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->
