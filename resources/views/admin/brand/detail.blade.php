@extends('admin.layout.main')
@section('title','Detal Brand')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('brand.index')}}" title="Danh mục">Brand</a></li>
		<li class="breadcrumb-item active">Detail</li>
	</ol>
</div>
<div class="card">
	<div class="card-body col-md-12">
		<p><b>Tên nhãn hiệu : </b>{{$brand->name}}</p>
		<p style="width: 1000px;"><b>Mô tả : </b>{{$brand->description}}</p>
	</div>
</div>
@endsection
