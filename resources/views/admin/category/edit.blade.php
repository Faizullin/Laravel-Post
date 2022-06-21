@extends('layouts.admin')
@section('title')
Edit Category
@endsection
@section('content')
<div class="row">
	<div class="col-6">
		<form class="" action="{{ route('admin.category.update', $category->id) }}" method="POST">
			@csrf
			@method('PATCH')
			<input type="hidden" name="id" value="{{ $category->id }}">
			<div class="form-group mb-3">
				<label for="category-title">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="category-title" name='title' value="{{ $category->title }}">
				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
				
		</form>
	</div>
	
</div>
@endsection