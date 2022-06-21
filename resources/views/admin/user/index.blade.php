@extends('layouts.admin');
@section('title')
Users
@endsection
@section('content')
<div class="col-md-8 col-12">
	<div class="table-block">
		<div class="card overflow-auto">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h3>users table</h3>
					<a href="{{ route('admin.user.create') }}" class="btn btn-primary">Add User</a>
					
				</div>
			</div>
			<div class="card-body">
				<table id="data-table" class="table table-borderless table-hover ">
					<thead>
						<tr>
							<th class=""></th>
							<th class="">ID</th>
							<th class="">Name</th>
							<th class="">Email</th>
							<th class="">Posts</th>
							<th class=""></th>
							<th class=""></th>
						</tr>
					</thead>
					<tbody class="">
						@foreach ($users as $user)
						<tr>
							<td>
								<input type="checkbox" name="category_ids[]" value={{ $user->id }} />
								
							</td>
							<td>
								<a class='text-dark' href="{{ route('admin.user.show',$user->id) }}">
									{{ $user->id }}
								</a>
							</td>
							<td>
								<a class='text-dark' href="{{ route('admin.user.show',$user->id) }}">{{ $user->name }}</a>
							</td>
							<td>
								<a class='text-dark' href="{{ route('admin.user.show',$user->id) }}">{{ $user->email }}</a>
							</td>
							<td >
								@if ($user->posts)
								<a class='text-dark' href="{{ route('admin.post.index') }}?author={{ $user->id }}">
									{{ $user->posts->count() }}
								</a>
								@else
									0
								@endif
							</td>
							
							<td class="text-center">
								<a class='' href="{{ route('admin.user.edit',$user->id) }}">
									<i class="fa fa-pen"></i>
								</a>
							</td>
							<td class="text-center">
								<span class='text-danger table-delete-box' href="{{ route('admin.user.delete',$user->id) }}" delete-id="{{ $user->id }}">
									<i class="fa fa-trash"></i>
								</span>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<div class="card-footer">
				<div class="d-flex align-items-center">
					<span id='select-all-btn' class="link text-primary cursor" href="">{{ __("Select All") }}</span>
					<input type="button" id='delete-btn' class="btn btn-danger" value="{{ __('Delete') }}">
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script type="">
	function deleteItem(el){
		console.log(el);
	}
	const URL={
		multidelete:"{{ route('admin.user.multidelete') }}"
	};
	var ax=null;
</script>
<script src='{{ asset('js/axios_as_ax.js') }}'></script>
<script type="text/javascript">
	function confirmDelete(text) {
		return confirm(text);
	}
	$(document).ready(function(){
		console.log("loaded");
		var table = $("#data-table").DataTable({
			"responsive": true,
			"autoWidth": false,
			"lengthChange": false,
			"buttons": ["copy","excel","print"],
			//"scrollX":true
		});
		var checkAllState = false;
		table.buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
		$("#select-all-btn").click(function(){
			var rows = table.rows().nodes();
			checkAllState = !checkAllState;
			$('input[type=checkbox]',rows).prop('checked',checkAllState);
		});
		$('span.table-delete-box').click(function() {
			console.log('table-delete-box');
			if(!confirmDelete("Are you sure to delete")){
				return;
			}
			ax.delete($(this).attr('href')).then(res=>{
				console.log(res);
				if(res.data.action==='reload'){
					location.reload();
				}
			}).catch((err)=>{
				console.log(err);
			});
		});
		$('#delete-btn').click(function(){
			var ddata = [];
			var rows = table.rows().nodes();
			$('input[type=checkbox]:checked',rows).each(function(){
				ddata.push(parseInt(this.value));
			});
			console.log(ddata);
			if(ddata.length==0){
				alert("{{ __('Please Choose Items') }}");
				return;
			}
			if(!confirmDelete("Are you sure to delete")){
				return;
			}
			ax.delete(URL.multidelete,{
				data: {
					'ids[]':ddata
				}
			}).then(res=>{
				console.log(res);
				if(res.data.action==='reload'){
					location.reload();
				}
			}).catch((err)=>{
				console.log(err);
			});
		});
	});
</script>
<style type="text/css">
	.table-delete-box{
		cursor: pointer;
	}
	#select-all-btn{
		margin-right: 30px;
		cursor: pointer;
	}
</style>
@endsection