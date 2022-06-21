@extends('layouts.admin')
@section('title')
Create Tag
@endsection
@section('content')
<div class="row">
	<div class="col-6">
		<form class="" action="{{ route('admin.tag.store') }}" method="POST">
			@csrf
			<div class="form-group mb-3">
				<label for="tag-title">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="tag-title" name='title' value="{{old('title')}}">
				@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
				
		</form>
	</div>
	
</div>
@endsection