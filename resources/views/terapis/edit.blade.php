@extends('layout.master')

@section('title') 
	Online Electronic Medical Record | Resep {{ $nurse_station->pasien->nama }}
@stop
@section('page-title') 
<h2>Edit Terapi</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
			<a href="{{ url('home/polis/' . $nurse_station->poli_id)}}">{{ ucfirst( $nurse_station->poli->poli ) }}</a>
	  </li>
		<li>
			<a href="{{ url('home/nurse_stations/' . $nurse_station->id . '/periksa')}}">Pemeriksaan {{ $nurse_station->pasien->nama }}</a>
	  </li>
	  <li class="active">
		  <strong>Terapi</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/terapis/' . $nurse_station->id, 'method' => 'put']) !!}
		@include('terapis.form')
	{!! Form::close() !!}
@stop
@section('footer') 
    <script src="{!! url('js/dropdownBelowSelect2.js') !!}"></script>
    <script src="{!! url('js/terapi.js') !!}"></script>
@stop
