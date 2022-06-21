@extends('layouts.app')
@section('title')
{{ $post->title }}
@endsection
@section('content')
<section class="main">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{ $post_created_at->translatedFormat("F") }},{{ $post_created_at->year }},{{ $post_created_at->day }}
                        </div>
                        <!-- Post categories-->{{-- January 1, 2022 by Start Bootstrap --}}
                        @foreach ($post->tags as $tag)
                        <a class="badge bg-secondary text-decoration-none link-light" href="{{ route('tag.index',$tag->slug) }}">{{ $tag->title }}</a>
                        @endforeach
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4">
                        <img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." />
                    </figure>
                    <h4>Category:
                    @if ($post->category)
                    <a href="{{ route('category.index',$post->category->slug) }}" class="text-dark">{{ $post->category->title }}</a>
                    @else
                    <span class="text-muted">Unknown</span>
                    @endif
                    </h4>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">
                            {{ $post->body }}
                        </p>
                    </section>
                </article>
                <div>
                    <button id='like-btn' type="button" @if (auth()->user())
                        @if ($post->likeByUser(auth()->user()->id)->first())
                            class="btn m-0 p-0 text-danger" isLike='liked'
                        @else
                            class="btn m-0 p-0 text-secondary" isLike='unliked'
                        @endif
                    @else
                        class="btn m-0 p-0 text-secondary" isLike='unliked' 
                    @endif
                    href="#">
                        <i class="fa fa-heart"></i>
                    </button><span id='like-count'>{{ $post->likes()->count() }}</span>
                    
                </div>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <form id="add-comment-form" class='mb-4' method="POST" action='{{ route('comment.store') }}'>
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="form-group">
                                    <h4>Leave a comment</h4>
                                    <label for="comment-message">Message</label>
                                    <textarea name="message" id="comment-message" msg cols="30" rows="5" class="bg-light form-control" placeholder="Join the discussion and leave a comment!"></textarea>
                                    @error ('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <button type="button" id="post" class="btn btn-dark" onclick="CommentTask.addComment(this)">Post Comment</button>
                                </div>
                            </form>
                            <!-- Comment with nested comments-->
                            <ul id='comments-ul' class='p-0'>
                                @foreach ($post->comments()->orderBy('id','DESC')->get() as $comment)
                                <li class="d-flex mb-4" id='comment-{{ $comment->id }}'>
                                    <div class="flex-shrink-0">
                                        <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold">
                                            {{ $comment->user->name }}
                                        </div>
                                        {{ $comment->message }}
                                        <div class="d-flex justify-content-start">
                                            <button class="btn btn-link text-dark reply-comment-btn" onclick="CommentTask.listenReplyComment(this)" href='{{ route('comment.store') }}' comment_id={{ $comment->id }}>Reply</button>
                                            @guest
                                            @else
                                                @if (auth()->user()->id === $comment->user->id)
                                                    <button type="button" class="btn btn-link text-danger delete-btn" href='{{ route('comment.delete',$comment->id) }}'>
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                        <ul class='p-0 repliedComments-ul'>
                                        @if ($comment->replies)
                                            @foreach ($comment->replies as $comment_reply)
                                            <li class="d-flex mt-4" id='comment-{{ $comment_reply->id }}'>
                                                <div class="flex-shrink-0">
                                                    <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                                                </div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">{{ $comment_reply->user->name }}</div>
                                                    {{ $comment_reply->message }}
                                                    <div class="d-flex justify-content-start">
                                                        @guest
                                                        @else
                                                            @if (auth()->user()->id === $comment_reply->user->id)
                                                                <button type="button" class="btn btn-link text-danger delete-btn" href='{{ route('comment.delete',$comment_reply->id) }}'>
                                                                <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        @endif
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            @include('includes.sidebar')
        </div>
    </div>
    <div>
        <div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id='modal-close' class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id='modal-send' class="btn btn-primary" onclick="CommentTask.addReplyComment()">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

<script type="text/javascript">
    URL['storeComment']="{{ route('comment.store') }}";
    URL['like'] = "{{ route('post.like',$post->id) }}";
    console.log(URL)
    const POST_ID = {{ $post->id }};
class CommentTask{
    static addComment(el=null){
        const text = $('#add-comment-form textarea').val();
        if(!text){
            return;
        }
        console.log(text);
        var self=this;
        $.ajax({
            url: URL.storeComment,
            type: "POST",
            dataType: 'json',
            data:{
                '_method':'post',
                'message':text,
                'post_id':POST_ID
            },
        }).done((resp)=> {
            console.log("success",resp);
            if(resp && resp.action && resp.action==='update' &&resp.comment){
                this.makeAddComment(resp.comment,"#comments-ul");
            }
        }).fail(function(err) {
            console.log("error",err);
            alert('Could not delete (error occured)!');
        }).always(function() {
            console.log("complete");
        });
    }
    static makeAddReplyComment(comment,comments_list){
        const content =`<li class="d-flex mt-4" id='comment-${comment.id}'><div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div><div class="ms-3"><div class="fw-bold">${comment.username}</div>${ comment.message }<div class="d-flex justify-content-start"><button type="button" class="btn btn-link text-danger delete-btn" href=\"{{ route('comment.delete','') }}/${comment.id}\" onclick=\"deleteBtn(this)\""><i class="fa fa-trash"></i></button></div></div></li>`;
        console.log(comments_list)
        $(comments_list).prepend(content);
    }
    static makeAddComment(comment,comments_list){
        const content =`<li class="d-flex mt-4" id='comment-${ comment.id }'><div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div><div class="ms-3"><div class="fw-bold">${comment.username}</div>${ comment.message }<div class="d-flex justify-content-start"><button class="btn btn-link text-dark reply-comment-btn" onclick="CommentTask.listenReplyComment(this);" href='{{ route('comment.store') }}' comment_id=${ comment.id }>Reply</button><button type="button" class="btn btn-link text-danger delete-btn" href=\"{{ route('comment.delete','') }}/${comment.id}\" onclick=\"deleteBtn(this)\""><i class="fa fa-trash"></i></button></div><ul class='p-0 repliedComments-ul'></ul></div></li>`;
        $(comments_list).prepend(content);
    }
    static listenReplyComment(el){
        $('#comment-modal').modal('show');  
        $('#comment-modal button#modal-send').attr('parent_id',$(el).attr('comment_id'));
    }
    static addReplyComment(){
        $('#comment-modal').modal('hide');   
        const text = $('#comment-modal textarea').val();
        const parent_id = $('#comment-modal button#modal-send').attr('parent_id');
        if(!text || !parent_id){return;}
        const self=this;
        $.ajax({
            url: URL.storeComment,
            type: "POST",
            dataType: 'json',
            data:{
                '_method':'post',
                'message':text,
                'post_id':POST_ID,
                'parent_id':parent_id
            },
        }).done((resp)=> {
            console.log("success",resp);
            if(resp && resp.action && resp.action==='update' &&resp.comment){
                self.makeAddReplyComment(resp.comment,`#comment-${parent_id} .repliedComments-ul`);
            }
        }).fail(function(err) {
            console.log("error",err);
            alert('Could not delete (error occured)!');
        }).always(function() {
            console.log("complete");
        });
        
    }
    static deleteReplyComment(href){
        $.ajax({
            url: href,
            type: "POST",
            dataType: 'json',
            data:{
                '_method':'delete'
            },
        })
        .done(function(resp) {
            console.log("success",resp);
            if(resp.action && resp.action === 'update' && resp.id){
                console.log(resp.id);
                $('#comment-'+resp.id).remove();
            }
        })
        .fail(function(err) {
            console.log("error",err);
            alert('Could not delete (error occured)!');
        })
        .always(function() {
            console.log("complete");
        });
    }
}
function deleteBtn(e){
    console.log('delete click');
    var href = $(e).attr('href');
    console.log(href);
    CommentTask.deleteReplyComment(href);
}
$(document).ready(function() {

    $('#modal-close').click(()=>{
        $('#comment-modal').modal('hide')
    });
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $('.delete-btn').on('click',function() {
        deleteBtn(this);
    });
    $('#like-btn').click(function(e){
        e.preventDefault();
        e=$(this);
        const isLike = e.attr('isLike');
        console.log('like',isLike);
        e.prop('disabled',true)
        $.ajax({
            url: URL.like,
            type: "POST",
            dataType: 'json',
            data:{
                'isLike':isLike,
                 '_method':'post',
                 'post_id':POST_ID,
            },
        }).done(function(resp) {
            console.log("success",resp);
            if(resp.action && resp.action === 'update'){
                console.log(resp.liked)
                const like_count = $('#like-count');
                var count = like_count.text();
                count=parseInt(count);
                if(resp.liked===true){
                    e.addClass('text-danger').removeClass('text-secondary');
                    e.attr('isLike','liked');
                    count++;
                }else{
                    e.addClass('text-secondary').removeClass('text-danger');
                    e.attr('isLike','unliked');
                    count--;
                }
                like_count.text(count);
            }
        }).fail(function(err) {
            console.log(err)
        }).always(function() {
            e.prop('disabled',false)
            console.log('end')
        });
    });
    
});
</script>
@endsection