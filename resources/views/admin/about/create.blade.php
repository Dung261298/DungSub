@extends('admin.layout.main')
@section('title','Create About')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('about.index')}}" title="Danh mục">About</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ol>
</div>
<div class="">
	<div class="card">
		<div class="card-header">
			<h4 class="font-weight-bold">Create about</h4>
		</div>
		<div class="card-body">
			{{ Form::open(['url' => 'admin/about', 'method' => 'post','enctype '=>'multipart/form-data']) }}
			<div class="row ">
				<div class="col-md-6 row">
					<div class="form-group col-md-12 {{ $errors->has('title') ?'has-error':'' }}">
						{{ Form::label('title','Title : ')}}
						{{ Form::text('title','',['class'=>'form-control'])}}
						<span class="text-danger">{{ $errors->first('title')}}</span>
					</div>
					<div class="form-group col-md-12 {{ $errors->has('content') ?'has-error':'' }}">
						{{ Form::label('content','Content: ')}}
						<br>
						<textarea name=content id="editor" cols="" rows="10" class="col-md-8"></textarea>
						<br>
						<span class="text-danger">{{ $errors->first('content')}}</span>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="form-group col-md-12 {{ $errors->has('phone') ?'has-error':'' }}">
						{{ Form::label('phone','Phone Number : ')}}
						{{ Form::text('phone','',['class'=>'form-control'])}}
						<span class="text-danger">{{ $errors->first('phone')}}</span>
					</div>
					<div class="form-group col-md-12 {{ $errors->has('email') ?'has-error':'' }}">
						{{ Form::label('email','Email : ')}}
						{{ Form::text('email','',['class'=>'form-control'])}}
						<span class="text-danger">{{ $errors->first('email')}}</span>
					</div>
					<div class="form-group col-md-12 ">
						{{Form::label('Logo:')}}
						<input multiple="multiple" name="logo" type="file" class="form-control">
						<span class="text-danger">{{ $errors->first('logo')}}</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				{{ Form::submit('Save',['class'=>'btn btn-success']) }}
				<a class="btn btn-danger" href="{{route('about.index')}}">Back</a>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection