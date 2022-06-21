@extends('layouts.admin')
@section('title')
Tags
@endsection
@section('content')
<div class="col-sm-8 col-12">
	<div class="table-block">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h3>Tags table</h3>
					<a href="{{ route('admin.tag.create') }}" class="btn btn-primary">Add Tag</a>
					
				</div>
			</div>
			<div class="card-body">

				<table id="data-table" class="table table-borderless table-hover">
					<thead>
						<tr>
							<th class="col-1"></th>
							<th class="col-1">ID</th>
							<th class="col-3">Title</th>
							<th class="col-1"></th>
							<th class="col-1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tags as $tag)
						<tr>
							<td>
								<input type="checkbox" name="tag_ids[]" value={{ $tag->id }} />
								
							</td>
							<td>
								<a class='text-dark' href="{{ route('admin.tag.show',$tag->id) }}">
									{{ $tag->id }}
								</a>
							</td>
							<td>
								<a class='text-dark' href="{{ route('admin.tag.show',$tag->id) }}">{{ $tag->title }}</a>
							</td>
							<td class="text-center">
								<a class='' href="{{ route('admin.tag.edit',$tag->id) }}">
									<i class="fa fa-pen"></i>
								</a>
							</td>
							<td class="text-center">
								<span class='text-danger table-delete-box' href="{{ route('admin.tag.delete',$tag->id) }}" delete-id="{{ $tag->id }}" onclick="deleteItem(this)">
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
		multidelete:"{{ route('admin.tag.multidelete') }}"
	};
	var ax=null;
</script>
<script src='{{ asset('js/axios_as_ax.js') }}'></script>
<script type="text/javascript">
	function confirmDelete(text) {
		return confirm(text) || true;
	}
	$(document).ready(function(){
		console.log("loaded");
		var table = $("#data-table").DataTable({
			"responsive": true,
			"autoWidth": false,
			"lengthChange": false,
			"buttons": ["copy","excel","print"],
		});
		var checkAllState = false;
		console.log(table.buttons(),table.buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)'));
		$("#select-all-btn").click(function(){
			var rows = table.rows().nodes();
			checkAllState = !checkAllState;
			$('input[type=checkbox]',rows).prop('checked',checkAllState);
		});
		$('.table-delete-box').click(function() {
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