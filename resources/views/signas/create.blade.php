@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Buat Signa

@stop
@section('page-title') 
<h2>Pendaftaran</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
		  <a href="{{ url('home/signas')}}">Signa</a>
	  </li>

	  <li class="active">
		  <strong>Buat Signa</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/signas', 'method' => 'post']) !!}
		@include('signas.form')
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
