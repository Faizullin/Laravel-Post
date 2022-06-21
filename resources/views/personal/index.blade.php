@extends('layouts.app')
@section('title')
Personal
@endsection
@section('content')
<section class="main h-100">
    <div class="container">
        <div class="row">
            <aside class="col-3">
                <ul class='list-group'>
                    <li class='list-group-item'>
                        <div class="">
                            <p>{{ $user->name}}</p>
                        </div>
                    </li>
                </ul>
            </aside>
            <div class="col-9 ">
                <div class="user-posts-block ">
                    <div class="user-posts-block-inner">
                        <p>Number of posts: <span>{{ $user_posts->count() }}</span> </p>
                        <ul>
                            @if($user_posts)
                            @foreach($user_posts as $post)
                            <li class="card mb-4">
                                <div class="card-body">
                                    <a href="{{ route('post.show', $post->id) }}">
                                        <h5 class="card-title">{{ $post->title}}</h5>
                                    </a>
                                    <p class="card-text">{{$post->description}}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="d-flex justify-content-between">
                                                <a class='mr-5' href="{{ route('post.edit',$post->id) }}">Edit</a>
                                                <form action="{{ route('post.delete',$post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit' class="btn btn-danger">Delete</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @else
                            <p>Empty</p>
                            @endif
                        </ul>
                        <div>
                            {{ $user_posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .main{
        margin: 50px 0 30px 0;
       min-height: 400px;
    }

    @media(max-width: 400px){
        .main{
            min-height:200px ;
        }
    }

</style>
@endsection