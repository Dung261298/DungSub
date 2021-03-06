@extends('admin.layout.main')
@section('title','Category')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active" >Category</li>
	</ol>
</div>
<div class="row ml-1 col-md-12">
	@if (Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger">{{ Session::get('err')}}</p>
	@endif
</div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-9">
				<a href="{{route('category.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ Form::open(['route' => ['category.index' ],'method' => 'get']) }}
					{{ Form::text('seachname','',['class'=>'form-control ','style'=>'float: left','placeholder'=>'Search Name']) }}
				</div>
				{{ Form::close() }}	
			</div>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th >STT</th>
					<th >Name</th>
					<th>Slug</th>
					<th >#</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($categories as $key => $category)
					<tr>
						<td >{{ ++$key }}</td>
						<td ><a href="{{route('category.show',$category->id)}}" style="text-decoration: none;color: black;">{{ $category->name }}</a> </td>
						<td>{{$category->slug}}</td>
						<td colspan="5">
							<!-- Button trigger modal -->
							<!-- Tạo data-id để chưa giá trị id -->
							<button type="button" class="fa fa-trash deleteUser text-danger btn" data-id="{{$category->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
							</button>
							<a href="{{route('category.edit',$category->id)}}" class="ml-1 btn" style="width:40px; padding: 5px;"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
{{Form::open(['route' => 'category_delete_modal', 'method' => 'POST', 'class'=>'col-md-5'])}}
{{ method_field('DELETE') }}
{{ csrf_field() }}
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure want to Delete?
				<!-- Nhận giá trị của hàng được gắn -->
				<input type="hidden" name="id" id="id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
				<button type="submit" class="btn btn-danger">Yes, Delete</button>
			</div>
		</div>
	</div>
</div> 
{{ Form::close() }}
<!-- lấy id của hàng dc cho gắn vào form modal -->
<script type="text/javascript">
	$(document).on('click','.deleteUser',function(){
		var userID=$(this).attr('data-id');
		$('#id').val(userID);
	});
</script>
@endsection