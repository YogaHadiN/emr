@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Edig Staf

@stop
@section('page-title') 
<h2>
	Online Electronic Medical Record | Edig Staf
</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/stafs')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>

@stop
@section('content') 
{!! Form::model($staf, [
		'url'     => 'home/stafs/' . $staf->id,
		"files"   => "true",
		'enctype' => 'multipart/form-data',
		'method'  => 'put'
]) !!}
	@include('stafs.form')
{!! Form::close() !!}
{!! Form::open(['url' => 'home/stafs/' . $staf->id, 'method' => 'delete']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<button class="btn btn-warning btn-block" onclick="return confirm('Anda yakin ingin menghapus {{ $staf->id }} - {{  $staf->nama  }} ?')" type="submit">Delete</button>
		</div>
	</div>
{!! Form::close() !!}
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop

