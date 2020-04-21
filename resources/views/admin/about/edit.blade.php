@extends('admin.layout.main')
@section('title','Edit About')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('about.index')}}" title="Danh mục">About</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
</div>
<div class="card">
	<div class="card-body ">
		{{Form::model($about,['route'=>['about.update',$about->id],'method'=>'put','enctype '=>'multipart/form-data']) }}
		<div class="row ">
			<div class="col-8 row">
				<div class="form-group {{ $errors->has('title') ?'has-error':'' }}">
					{{ Form::label('title','Title : ')}}
					{{ Form::text('title',$about->title,['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('title')}}</span>
				</div>
				<div class="form-group ">
					{{ Form::label('content','Content: ')}}
					<br>
					<textarea name=content id="editor" cols="" rows="10" class="col-md-8">{{ $about->content }}</textarea>
					<br>
					<span class="text-danger">{{ $errors->first('content')}}</span>
				</div>
			</div>
			<div class="form-group {{ $errors->has('phone') ?'has-error':'' }}">
				{{ Form::label('phone','Phone : ')}}
				{{ Form::text('phone',$about->phone,['class'=>'form-control'])}}
				<span class="text-danger">{{ $errors->first('phone')}}</span>
			</div>	
			<div class="form-group {{ $errors->has('email') ?'has-error':'' }}">
				{{ Form::label('email','Email : ')}}
				{{ Form::text('email',$about->email,['class'=>'form-control'])}}
				<span class="text-danger">{{ $errors->first('email')}}</span>
			</div>
			<div class="form-group col-6 {{ $errors->has('logo') ?'has-error':'' }}">
				{{ Form::label('Logo:','',['class'=>'']) }}
				{{ Form::file('logo',['class' => 'form-control', 'id' => 'filename']) }}
				{{ Form::hidden('logo',$about->logo) }}
				<p id="path">{{ $about->logo }}</p>
				<span class="text-danger">{{ $errors->first('logo')}}</span>		
			</div>
		</div>
		<div class="form-group">
			{{ Form::submit('Update',['class'=>'btn btn-success']) }}
			<a class="btn btn-danger" href="{{route('about.index')}}">Back</a>
		</div>
		{{ Form::close() }}
	</div>
</div>
<script type="text/javascript">
	$('#filename').on('change',function(e){               
		value = $(this).val();
		$.ajax({
			type: 'get',
			url: '{{ URL::to('setvalue') }}',
			data: {
				value: value
			},
			success:function(data){
				document.getElementById("image_file").value = data;
				$("#path").html(data);
			}
		});
	});
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection


