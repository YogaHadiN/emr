@extends('layout.master')

@section('title') 

	Online Electronic Medical Record | Edit Pemeriksaan {{ ucfirst( $periksa->poli ) }} 

@stop
@section('head') 

@stop
@section('page-title') 
<h2>Edit Pemeriksaan</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
		<a href="{{ url('home/polis/' . $periksa->nurseStation->poli_id)}}">{{ ucfirst( $periksa->poli ) }}</a>
	  </li>
	  <li class="active">
		  <strong>Pemeriksaan {{ $periksa->pasien->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::model($periksa,['url' => 'home/periksas/' . $periksa->id, 'method' => 'put']) !!}
		@include('periksas.pre_tab')
		@include('periksas.form')
		@include('periksas.post_tab')
	{!! Form::close() !!}
@stop
@section('footer') 
	<script src="{!! url('js/periksa.js') !!}"></script>
@stop
