@extends('layout.master')

@section('title') 
	Online Electronic Medical Record | Resep {{ $antrian_apotek->periksa->pasien->nama }}
@stop
@section('page-title') 
<h2>Apotek</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
			<a href="{{ url('home/antrian_apoteks')}}">Antrian Apotek </a>
	  </li>
	  <li class="active">
		  <strong>Apotek Pasien {{ ucfirst( $antrian_apotek->periksa->pasien->nama ) }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open([
		'url' => 'home/antrian_apoteks', 
		'target' => '_blank', 
		'method' => 'post'])
	!!}
		@include('antrian_apoteks.form')
	{!! Form::close() !!}
@stop
@section('footer') 
    <script src="{!! url('js/terapi.js') !!}"></script>
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop
