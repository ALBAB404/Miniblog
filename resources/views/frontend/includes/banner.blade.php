<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach ($banner_posts as $banner_post )
            <div class="item">
                <img src="{{ url('image/post/Original/'.$banner_post->photo) }}" alt="{{ $banner_post->title }}">
                <div class="item-content">
                    <div class="main-content">
                        <div class="meta-category">
                            <span>{{ $banner_post->category?->name }}</span>
                        </div>
                        <a href="{{ route('Front.single', $banner_post->slug) }}">
                            <h4>{{ $banner_post->title }}</h4>
                        </a>
                        <ul class="post-info">
                            <li><a href="#">{{ $banner_post->user?->name }}</a></li>
                            <li><a href="#">{{ $banner_post->created_at->format('M d, Y') }}</a></li>
                            <li><a href="#">12 Comments</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
