@extends('frontend.layout.master')
@section('Page_title', 'Welcome')
@section('banner')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Post Details</h4>
                            <h2>Single blog post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('content')

    <div class="col-lg-12">
        <div class="blog-post">
            <div class="blog-thumb">
                <img src="{{ url('image/post/Original/'.$post->photo) }}" alt="{{ $post->title }}">
            </div>
            <div class="down-content">
                <span>{{ $post->category?->name }} <sub class="text-warning">{{ $post->sub_category?->name }}</sub></span>
                <a href="{{ route('Front.single', $post->slug) }}">
                    <h4>{{ $post->title }}</h4>
                </a>
                <ul class="post-info">
                    <li><a href="#">{{ $post->user?->name }}</a></li>
                    <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                    <li><a href="#">12 Comments</a></li>
                </ul>
                <div class="post_description">
                    <p>{!! $post->discription !!}</p>
                </div>
                <div class="post-options">
                    <div class="row">
                        <div class="col-6">
                            <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                @foreach ($post->tag as $tag)
                                <li><a href="{{ route('Front.tag', $tag->slug) }}">{{ $tag->name }}</a>,</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="post-share">
                                <li><i class="fa fa-share-alt"></i></li>
                                <li><a href="#">Facebook</a>,</li>
                                <li><a href="#"> Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item comments">
            <div class="sidebar-heading">
                <h2>4 comments</h2>
            </div>
            <div class="content">
                <ul>
                    @foreach ($post->comment as $comment )
                       <li>
                        <div class="author-thumb">
                            <img src="{{ asset('frontend') }}/assets/images/comment-author-01.jpg" alt="">
                        </div>
                        <div class="right-content">
                            <h4>{{ $comment->user?->name }}<span>{{ $comment->created_at->format('M d, Y') }}</span></h4>
                            <p>{{ $comment->comment }}</p>
                            <h4 class="mt-2">Reply Comment</h4>
                            {!! Form::open(['method'=>'post','route'=>'comment.store']) !!}
                            {!! Form::text('comment', null, ['class'=>'form-control form-control-sm mt-2', 'placeholder'=>'Write Your Reply Here']) !!}
                            {!! Form::hidden('comment_id', $comment->id) !!}
                            {!! Form::hidden('post_id', $post->id) !!}
                            {!! Form::button('Reply',['class'=>'btn btn-outline-warning mt-2','type'=>'submit']) !!}
                            {!! Form::close() !!}
                            </div>
                        </li>
                        @foreach ($comment->reply as $reply)
                        <li class="replied">
                            <div class="author-thumb">
                                <img src="{{ asset('frontend') }}/assets/images/comment-author-02.jpg" alt="">
                            </div>
                            <div class="right-content">
                                <h4>{{ $reply->user?->name }}<span>{{ $reply->created_at->format('M d, Y') }}</span></h4>
                                <p>{{ $reply->comment }}</p>
                            </div>
                        </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="sidebar-item submit-comment">
            <div class="sidebar-heading">
                <h2>Your comment</h2>
            </div>
            <div class="content">
                <form method="post" action="{{ route('comment.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                                <input name="post_id" type="hidden" value="{{ $post->id }}">
                                <textarea name="comment" rows="6" id="message" placeholder="Type your comment"></textarea>
                                <button type="submit" class="main-button">Submit </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@if(session('msg'))
    @push('js')
        <script>
            $('.delete').on('click', function() {
                let id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit()
                    }
                })
            })
        </script>
    @endpush
@endif
