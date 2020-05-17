@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Edit Pendaftaran

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
		  <a href="{{ url('home/daftars')}}">Nurse Station</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>
@stop
@section('content') 
	<h1>{{ $nurse_station->pasien->nama }}</h1>
	{!! Form::model($nurse_station,['url' => 'home/nurse_stations/' .  $nurse_station->id, 'method' => 'put']) !!}
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
