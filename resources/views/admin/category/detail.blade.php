@extends('admin.layout.main')
@section('title','Detal Category')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('category.index')}}" title="Danh mục">Brand</a></li>
		<li class="breadcrumb-item active">Detail</li>
	</ol>
</div>
<div class="card mt-3">
	<div class="card-body col-md-12">
		<p><b>Tên nhãn hiệu : </b>{{$category->name}}</p>
		<p style="width: 1000px;"><b>Mô tả : </b>{{$category->description}}</p>
	</div>
</div>
@endsection
