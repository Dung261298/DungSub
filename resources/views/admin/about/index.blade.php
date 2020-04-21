@extends('admin.layout.main')
@section('title','Index')
@section('content')
<div class="page-header">
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="">Admin</a></li>
	<li class="breadcrumb-item active">About</li>
</ol>
<!-- <h1 style=" font-family: 'Open Sans', sans-serif; font-size: 50px; font-weight: 300; text-transform: uppercase;">About</h1> -->
</div>
<div class="row ml-1">
@if (Session::has('message'))
<p class="alert alert-success">{{ Session::get('message')}}</p> 
@elseif(Session::has('err'))    
<p class="alert alert-danger">{{ Session::get('err')}}</p>
@endif
</div>
<div class="card">
<div class="card-body ">
	<div class="row">
		<div class="col-md-9">
			<a href="{{route('about.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{{ Form::open(['route' => ['about.index' ],'method' => 'get']) }}
				{{ Form::text('seachtitle','',['class'=>'form-control ','style'=>'float: left','placeholder'=>'Search Title']) }}
			</div>
			{{ Form::close() }}
		</div>
	</div>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th >STT</th>
				<th >Title</th>
				<th >Phone Number</th>
				<th >Content</th>
				<th >Email</th>
				<th >Logo</th>
				<th colspan="5">#</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($abouts as $key => $about)
				<tr>
					<td >{{ ++$key }}</td>
					<td><a href="{{route('about.show',$about->id)}}" style="text-decoration: none;color: black;">{{$about->title}}</td>
						<td>{{$about->phone}}</td>
						<td>{{$about->content}}</td>
						<td>{{$about->email}}</td>
						<td><img src="{{ asset('images/'.$about->logo) }}" width="80" height=></img>
						</td>
						<td colspan="5">
							<!-- Button trigger modal -->
							<!-- Tạo data-id để chưa giá trị id -->
							<button type="button" class="fa fa-trash deleteUser text-danger btn" data-id="{{$about->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
							</button>
							<a href="{{route('about.edit',$about->id)}}" class="ml-1 btn" style="width:40px; padding: 5px;"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
{{Form::open(['route' => 'about_delete_modal', 'method' => 'POST', 'class'=>'col-md-5'])}}
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