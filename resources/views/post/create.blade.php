@extends('layouts.app')
@section('title')
Create Post
@endsection
@section('content')
<div class="container">
    <div class="row">
    <div class="col-6 m-auto">
        <form class="" action="{{ route('post.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" value="{{ old('title') }}" name="title">
                @error('title')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">{{ __('Description') }}</label>
                <textarea type="text" class="form-control" id="description" name='description' placeholder="Enter description" value="{{ old('description') }}"></textarea>
                @error('description')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">{{ __('Body') }}</label>
                <textarea type="text" class="form-control" id="body" name="body" placeholder="Enter text" value="{{ old('body') }}"></textarea>
                @error('body')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                <select id='category' class="form-select @error('category_id') is-invalid @enderror" name="category_id" >
                    <option selected value=' '>Choose Category</option>
                    
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control select2 select2-primary @error('tag_ids[]') is-invalid @enderror" data-dropdown-css-class="select2-primary" {{-- tabindex="-1"  --}}aria-hidden="true" id='tags'  multiple="multiple" name="tag_ids[]">
                    
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">
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
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </form>
    </div>
</div>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
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