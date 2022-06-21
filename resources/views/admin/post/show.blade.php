@extends('layouts.admin')
@section('title')
{{ $post->title }}
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
							<td>{{ $post->id }}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Title</th>
							<td>
								{{ $post->title }}
							</td>
						</tr>
						<tr>
							<th>
								Category
							</th>
							<td>
								@if ($post->category)
								<a href="{{ route('admin.category.show',$post->category->id) }}">
									{{ $post->category->title }}
								</a>
								@else
								<p class="text-muted">Unknown</p>
								@endif
							</td>
						</tr>
						<tr>
							<th>Author</th>
							<td>
								@if ($post->user)
								<a href="{{ route('admin.user.show',$post->user->id) }}">
									{{ $post->user->name }}
								</a>
								@else
								<p class="text-muted">Unknown</p>
								@endif
							</td>
						</tr>
						<tr>
							<th>Tags</th>
							<td>
								@foreach ($post->tags as $tag)
									<a class="post-tag-block badge badge-info" href="{{ route('admin.tag.show',$tag->id) }}">
										{{ $tag->title }}
									</a>
								@endforeach
							</td>
						</tr>
						<tr>
							<th>Created at</th>
							<td>
								{{ $post->created_at }}
							</td>
						</tr>
						<tr>
							<th>Last updated at</th>
							<td>
								{{ $post->updated_at }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<form action="{{ route('admin.post.delete',$post->id) }}" method="POST">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">{{ __('Delete') }}</button>
				</form>
				<a href="{{ route('admin.post.edit',$post->id) }}">{{ __('Edit') }}</a>
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
								location.replace("{{ route('admin.post.index') }}");
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