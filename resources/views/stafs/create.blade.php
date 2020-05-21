@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Buat Staf

@stop
@section('page-title') 
<h2>
	Online Electronic Medical Record | Buat Staf
</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/stafs')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Create</strong>
	  </li>
</ol>

@stop
@section('content') 
{!! Form::open([
		'url'     => 'home/stafs',
		"files"   => "true",
		'enctype' => 'multipart/form-data',
		'method'  => 'post',
]) !!}
	@include('stafs.form')
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

