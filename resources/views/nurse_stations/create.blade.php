@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Pemeriksaan Nurse Station

@stop
@section('page-title') 
<h2>Pemeriksaan Nurse Station</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
		  <a href="{{ url('home/daftars')}}">Nurse Station</a>
	  </li>
	  <li class="active">
		  <strong>Pemeriksaan</strong>
	  </li>
</ol>
@stop
@section('content') 
	<h1>{{ $daftar->pasien->nama }}</h1>
	{!! Form::open(['url' => 'home/nurse_stations', 'method' => 'post']) !!}
		@include('nurse_stations.form')
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
