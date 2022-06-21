@extends('layouts.admin')
@section('title')
Create User
@endsection
@section('content')
<div class="row">
	<div class="col-8">
		<form class="" action="{{ route('admin.user.update',$user->id) }}" method="POST">
			@csrf
			@method('PATCH')
			<input type="hidden" name="user_id" value="{{ $user->id }}">
			<div class="form-group mb-3">
				<label for="user-name">{{ __('Name') }}</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="user-name" name='name' value="{{ $user->name }}" required autofocus>
				@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="form-group mb-3">
				<label for="user-email">{{ __('Email Address') }}</label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="user-email" name='email' value="{{ $user->email }}" required>
				@error('email')
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