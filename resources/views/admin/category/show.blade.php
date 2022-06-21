@extends('layouts.admin')
@section('title')
{{ $category->title }}
@endsection
@section('content')
<div class="row">
	<div class="col-10">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">DataTable with minimal features & hover style</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="index-table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<td>{{ $category->id }}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Title</th>
							<td>
								{{ $category->title }}
							</td>
						</tr>
						<tr>
							<th>
								Posts
							</th>
							<td>
								<a href="{{ route('admin.post.index') }}?category={{ $category->id }}">
									{{ $category->posts->count() }}
								</a>
							</td>
						</tr>
						<tr>
							<th>Created at</th>
							<td>
								{{ $category->created_at }}
							</td>
						</tr>
						<tr>
							<th>Last updated at</th>
							<td>
								{{ $category->updated_at }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<form action="{{ route('admin.category.delete',$category->id) }}" method="POST">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">{{ __('Delete') }}</button>
				</form>
				<a href="{{ route('admin.category.edit',$category->id) }}">{{ __('Edit') }}</a>
			</div>
			<script type="text/javascript">
				var ax=null;
			</script>
			<script src="{{ asset('js/axios_as_ax.js') }}"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('form').click(function(e){
						e.preventDefault();
						ax.delete($(this).attr('action')).then(res=>{
							console.log(res);
							if(res.data.action='reload'){
								location.replace("{{ route('admin.category.index') }}");
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