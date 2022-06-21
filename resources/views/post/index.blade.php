@extends('layouts.app')
@section('title')
Posts
@endsection
@section('content')
<section class="main">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="posts-block ">
                    <div class="posts-block-inner">
                        <ul>
                            @foreach($posts as $post)
                            <li class="card mb-3">
                                <div class="card-body">
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h5 class="card-title">{{ $post->title}}</h5>
                                    </a>
                                    @if ($post->user)
                                    <h6 class='card-subtitle mb-2 text-muted'>{{$post->user->name}}</h6>
                                    @else
                                    <h6 class='card-subtitle mb-2 text-muted'>Unknown</h6>
                                    @endif
                                    <p class="card-text">{{$post->description}}</p>
                                    @if ($post->category)
                                    <p class="card-text">Catgeory: {{$post->category->title}}</p>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="pagination-block">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
            @include('includes.sidebar')
        </div>
    </div>
</section>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection