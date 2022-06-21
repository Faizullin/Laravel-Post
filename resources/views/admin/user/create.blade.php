@extends('layouts.admin')
@section('title')
Create User
@endsection
@section('content')
<div class="row">
	<div class="col-6">
		<form class="" action="{{ route('admin.user.store') }}" method="POST">
			@csrf
			<div class="form-group mb-3">
				<label for="user-name">{{ __('Name') }}</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="user-name" name='name' value="{{old('name')}}" required autocomplete="name" autofocus>
				@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="form-group mb-3">
				<label for="user-email">{{ __('Email Address') }}</label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="user-email" name='email' value="{{old('email')}}" required autocomplete="email">
				@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="form-group mb-3">
				<label for="user-password">{{ __('Password') }}</label>
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="user-password" name='password' value="{{old('password')}}" required autocomplete="new-password">
				@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="form-group mb-3">
				<label for="password-confirm">{{ __('Confirm Password') }}</label>
				<input type="password" class="form-control" id="password-confirm" name='password_confirmation'>
				@error('password_confirmation')
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