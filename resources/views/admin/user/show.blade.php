@extends('layouts.admin')
@section('name')
{{ $user->name }}
@endsection
@section('content')
<div class="row">
	<div class="col-10">
		<div class="card">
			<div class="card-header">
				<h3 class="card-name">DataTable with minimal features & hover style</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="index-table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<td>{{ $user->id }}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Username</th>
							<td>
								{{ $user->name }}
							</td>
						</tr>
						<tr>
							<th>
								Created Posts
							</th>
							<td>
								@if ($user->posts)
								<a class='text-dark' href="{{ route('admin.post.index') }}?author={{ $user->id }}">
									{{ $user->posts->count() }}
								</a>
								@else
								0
								@endif
							</td>
						</tr>
						<tr>
							<th>Created at</th>
							<td>
								{{ $user->created_at }}
							</td>
						</tr>
						<tr>
							<th>Last updated at</th>
							<td>
								{{ $user->updated_at }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<form action="{{ route('admin.user.delete',$user->id) }}" method="POST">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">{{ __('Delete') }}</button>
				</form>
				<a href="{{ route('admin.user.edit',$user->id) }}">{{ __('Edit') }}</a>
			</div>
			<script type="text/javascript">
				var ax=null;
			</script>
			<script src='{{ asset('js/axios_as_ax.js') }}'></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('form').click(function(e){
						e.preventDefault();
						ax.delete($(this).attr('action')).then(res=>{
							console.log(res);
							if(res.data.action='reload'){
								location.replace("{{ route('admin.user.index') }}");
							}
						}).catch(err=>{
							console.log(err);
						});
					});
				});
			</script>
		</div>
	</div>
</div>
@endsection