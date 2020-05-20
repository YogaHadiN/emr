@extends('layout.master')

@section('title') 
	Online Electronic Medical Record | Resep {{ $nurse_station->pasien->nama }}
@stop
@section('page-title') 
<h2>Terapi</h2>
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
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#resep" aria-controls="resep" role="tab" data-toggle="tab">Resep</a></li>
	<li role="presentation"><a href="#signa_tab" aria-controls="signa_tab" role="tab" data-toggle="tab">Signa</a></li>
	<li role="presentation"><a href="#aturan_minum_tab" aria-controls="aturan_minum_tab" role="tab" data-toggle="tab">Aturan Minum</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="resep">
		{!! Form::open([
			'url'       => 'home/terapis',
			'method'    => 'post'
		]) !!}
			@include('terapis.resep')
		{!! Form::close() !!}
	</div>
	<div role="tabpanel" class="tab-pane" id="signa_tab">
		@include('terapis.signaInput')
	</div>
	<div role="tabpanel" class="tab-pane" id="aturan_minum_tab">
		this is it 3
		{{-- @include('terapis.signaInput') --}}
	</div>
  </div>

</div>
@stop
@section('footer') 
    <script src="{!! url('js/dropdownBelowSelect2.js') !!}"></script>
    <script src="{!! url('js/terapi.js') !!}"></script>
@stop
