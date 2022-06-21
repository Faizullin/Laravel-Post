@extends('layouts.admin')
@section('title')
{{ $tag->title }}
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
							<td>{{ $tag->id }}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Title</th>
							<td>
								{{ $tag->title }}
							</td>
						</tr>
						<tr>
							<th>
								Posts
							</th>
							<td>
								<a href="{{ route('admin.post.index') }}?tag={{ $tag->id }}">
									{{ $tag->posts->count() }}
								</a>
							</td>
						</tr>
						<tr>
							<th>Created at</th>
							<td>
								{{ $tag->created_at }}
							</td>
						</tr>
						<tr>
							<th>Last updated at</th>
							<td>
								{{ $tag->updated_at }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<form action="{{ route('admin.tag.delete',$tag->id) }}" method="POST">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">{{ __('Delete') }}</button>
				</form>
				<a href="{{ route('admin.tag.edit', $tag->id) }}">{{ __('Edit') }}</a>
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
								location.replace("{{ route('admin.tag.index') }}");
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