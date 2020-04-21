@extends('admin.layout.main')
@section('title','Product')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('product.index')}}" title="Sản phẩm">Product</a></li>
		<li class="breadcrumb-item active">Create</li>
	</ol>
</div>
<div class="card">
	<div class="card-body">
		{{ Form::open(['url' => 'admin/product', 'method' => 'post','enctype '=>'multipart/form-data']) }}
		<div class="row">
			<div class="col-8">
				<div class="form-group">
					{{ Form::label('Product Code : ')}}
					{{ Form::text('product_code',uniqid(),['class'=>'form-control', 'readonly'=>'readonly'])}}
					<span class="text-danger">{{ $errors->first('product_code')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Product name : ')}}
					{{ Form::text('name','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('name')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Descriptione : ')}}
						<br>
						<textarea name=description id="editor" cols="" rows="10" class="col-md-8"></textarea>
						<br>
					<span class="text-danger">{{ $errors->first('description')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Image:') }} <br/>
					{{ Form::file('image',['class' => 'form-control', 'id' => 'filename']) }}
					<span class="text-danger">{{ $errors->first('image')}}<br> </span>
				</div>	
			</div>
			<div class="col-4">
				<div class="form-group">
					{{ Form::label('Price : ')}}
					{{ Form::number('price','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('price')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Quantity : ')}}
					{{ Form::text('quantity','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('quantity')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Promotion : ')}}
					{{ Form::number('promotion','',['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('promotion')}}</span>
				</div>
				<div class="form-group">
					{{Form::label('Brand:')}}
					{{Form::select('brand_id',$brand,null,['class' => " form-control",'placeholder'=>'Choose a manufacturer'])}}
					@if ($errors->has('brand_id'))
					<div class="text-danger">{{ $errors->first('brand_id') }}</div>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('Category:')}}
					{{Form::select('category_id',$category,null,['class' => " form-control",'placeholder'=>'Choose a category'])}}
					@if ($errors->has('category_id'))
					<div class="text-danger">{{ $errors->first('category_id') }}</div>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::submit('Save',['class'=>'btn btn-success']) }}
			<a class="btn btn-danger" href="{{route('product.index')}}">Back</a>
		</div>
		{{ Form::close() }}
	</div>
</div> 
@endsection