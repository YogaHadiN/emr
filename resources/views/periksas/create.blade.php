@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Pemeriksaan {{ ucfirst( $nurse_station->poli->poli ) }} 

@stop
@section('head') 
@stop
@section('page-title') 
<h2>Pemeriksaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
			<a href="{{ url('home/polis/' . $nurse_station->poli_id)}}">{{ ucfirst( $nurse_station->poli->poli ) }}</a>
	  </li>
	  <li class="active">
		  <strong>Pemeriksaan {{ $nurse_station->pasien->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	@include('periksas.pre_tab')
	{!! Form::open(['url' => 'home/periksas', 'method' => 'post']) !!}
		@include('periksas.form')
	{!! Form::close() !!}
	@include('periksas.post_tab')
@stop
@section('footer') 
	<script src="{!! url('js/periksa.js') !!}"></script>
@stop
