@extends('layouts.frontapp')

@section('content')
    @foreach ($posts as $post)
        <article class="post-item">
                @if($post->image_url)
                    <div class="post-item-image">
                        <a href="{{ route('show.post', ['post'=>$post->slug]) }}">
                            <img src="{{ $post->image_url }}" alt="">
                        </a>
                    </div>
                @endif
                <div class="post-item-body">
                    <div class="padding-10">
                        <h2><a href="{{ route('show.post', ['post'=>$post->slug]) }}">{{ $post->title }}</a></h2>
                        <p>{{ substr($post->body, 0, 200).'...' }}</p>
                    </div>

                    <div class="post-meta padding-10 clearfix">
                        <div class="pull-left">
                            <ul class="post-meta-group">
                                <li><i class="fa fa-user"></i><a href="#"> {{ $post->author->name }}</a></li>
                                <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                <li><i class="fa fa-tags"></i>
                                    <a href="{{ route('category.search', ['category' => $post->category->slug]) }}"> {{ $post->category->title }}</a>
                                </li>
                                <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('show.post', ['post'=>$post->slug]) }}">Continue Reading &raquo;</a>
                        </div>
                    </div>
                </div>
        </article>
    @endforeach

    <nav class="text-center">
        {{ $posts->links() }}
    </nav>
@endsection