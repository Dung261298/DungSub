@extends('admin.layout.main')
@section('title','Edit Brand')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('brand.index')}}" title="Danh mục">Brand</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
</div>
<div class="card">
	<div class="card-body col-md-12">
		{{Form::open(['route'=>['brand.update',$brand->id],'method'=>'put'])}}
		<input type="hidden" name="id" value="{{$brand->id}}" placeholder="">
		<div class="form-group col-12">
			{{ Form::label('name','Name : ')}}
			{{ Form::text('name',$brand->name,['class'=>'form-control col-md-8'])}}
			<span class="text-danger">{{ $errors->first('name')}}</span>
		</div>
		<div class="form-group col-12">
			{{ Form::label('description','Description : ')}}
			<br>
			<textarea name=description id="editor" cols="" rows="10" class="col-md-8">{{ $brand->description }}</textarea>
			<br>
			<span class="text-danger">{{ $errors->first('description')}}</span>
		</div>
		<div class="form-group col-md-12">
			{{ Form::submit('Update',['class'=>'btn btn-success']) }}
			<a class="btn btn-danger" href="{{route('brand.index')}}">Back</a>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection