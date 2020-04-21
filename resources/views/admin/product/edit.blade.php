@extends('admin.layout.main')
@section('title','Edit Product')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('product.index')}}" title="Sản phẩm">Product</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>
</div>
<div class="card">
	<div class="card-body ">
		{{Form::model($product,['route' => ['product.update',$product->id],'method' => 'put','enctype '=>'multipart/form-data'])}}
		<div class="row">
			<div class="col-8">
				<div class="form-group">
					{{ Form::label('product_code','Product Code : ')}}
					{{ Form::text('product_code',uniqid(),['class'=>'form-control', 'readonly'=>'readonly'])}}
					<span class="text-danger">{{ $errors->first('product_code')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('name','Sản phẩm : ')}}
					{{ Form::text('name',$product->name,['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('name')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('description','Mô tả : ')}}
					<br>
					<textarea name=description id="editor" cols="" rows="10" class="col-md-8">
						{{ $product->description }}
					</textarea>
					<br>
					<span class="text-danger">{{ $errors->first('description')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('Image:') }} <br/>
					{{ Form::file('imagee',['class' => 'form-control', 'id' => 'filename']) }}
					{{ Form::hidden('image', $product->image, ['class' => 'form-control','id' => 'image_file' ]) }}
					<p id="path">{{ $product->image }}</p>
					<span class="text-danger">{{ $errors->first('image')}}<br> </span>
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					{{ Form::label('price','Gía tiền : ')}}
					{{ Form::number('price',$product->price,['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('price')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('quantity','Chất lượng : ')}}
					{{ Form::text('quantity',$product->quantity,['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('quantity')}}</span>
				</div>
				<div class="form-group">
					{{ Form::label('promotion','Khuyến mãi : ')}}
					{{ Form::number('promotion',$product->promotion,['class'=>'form-control'])}}
					<span class="text-danger">{{ $errors->first('promotion')}}</span>
				</div>
				<div class="form-group">
					{{Form::label('Nhà sản xuất:')}}
					{{Form::select('brand_id',$brand,$product->brand_id,['class' => " form-control",'placeholder'=>'Choose a manufacturer'])}}
					@if ($errors->has('brand_id'))
					<div class="text-danger">{{ $errors->first('brand_id') }}</div>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('Thể loại:')}}
					{{Form::select('category_id',$category,$product->category_id,['class' => " form-control",'placeholder'=>'Choose a category'])}}
					@if ($errors->has('category_id'))
					<div class="text-danger">{{ $errors->first('category_id') }}</div>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::submit('Update',['class'=>'btn btn-success']) }}
			<a class="btn btn-danger" href="{{route('product.index')}}">Back</a>
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