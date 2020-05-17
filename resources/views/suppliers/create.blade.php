@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Buat Supplier

@stop
@section('page-title') 
<h2>Buat Supplier</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
		  <a href="{{ url('home/suppliers')}}">Supplier</a>
	  </li>
	  <li class="active">
		  <strong>Buat Supplier</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/suppliers', 'method' => 'post']) !!}
		@include('suppliers.form')
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
