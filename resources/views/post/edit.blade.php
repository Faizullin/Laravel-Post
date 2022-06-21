@extends('layouts.app')
@section('title')
Edit Post
@endsection
@section('content')
<div class="container">
    <form action="{{ route('post.update',$post->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <label for="post_title"></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="post_title" name='title' placeholder="Enter title" value="{{ $post->title }}">
            @error('title')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description"></label>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name='description' placeholder="Enter description" >
            {{ $post->description }}
            </textarea>
            @error('description')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="body"></label>
            <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="body" placeholder="Enter text" name="body">
            {{ $post->body }}
            </textarea>
            @error('body')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="category" class="col-md-4 col-form-label text-md-end">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id='category'>
                <option selected value=' '>Choose Category</option>
                @isset($categories)
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{  ($cat->id === $post->category_id) ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
                @endisset
            </select>
            @error('category_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select class="form-control select2 select2-danger @error('tag_ids[]') is-invalid @enderror" data-dropdown-css-class="select2-danger" {{-- tabindex="-1"  --}}aria-hidden="true" id='tags'  multiple="multiple" name="tag_ids[]">
                
                @foreach ($tags as $tag)
                <option {{-- data-select2-id="{{ $tag->id }}" --}} value="{{ $tag->id }}"
                    @foreach ($post->tags as $postTag)
                    {{ $postTag->id===$tag->id ? 'selected=selected' : '' }}
                    @endforeach
                    >
                    {{ $tag->title }}
                </option>
                @endforeach
            </select>
            @error('tag_ids[]')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>
</div>
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<script type="text/javascript" src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#tags').select2();
});
</script>
<style type="text/css">
.select2-results__option[aria-selected=true] {
display: none;
}
</style>
@endsection