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
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		{!! Form::open([
			'url'       => 'home/terapis',
			'method'    => 'post'
		]) !!}
			@include('terapis.resep')
		{!! Form::close() !!}
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body">
				
			<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a class="show_tab_status" href="#status" aria-controls="status" role="tab" data-toggle="tab">Status</a></li>
				<li role="presentation"><a href="#signa_tab" class="show_tab_signa" aria-controls="signa_tab" role="tab" data-toggle="tab">Buat Signa</a></li>
				<li role="presentation"><a href="#aturan_minum_tab" class="show_tab_aturan_minum" aria-controls="aturan_minum_tab" role="tab" data-toggle="tab">Buat Aturan Minum</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="status">
					@include('terapis.info')
				</div>
				<div role="tabpanel" class="tab-pane" id="signa_tab">
					@include('terapis.signaInput', ['table' => 'signa'])
				</div>
				<div role="tabpanel" class="tab-pane" id="aturan_minum_tab">
					@include('terapis.signaInput', ['table' => 'aturan_minum'])
				</div>
			  </div>

			</div>

			</div>
		</div>
	</div>
</div>
@stop
@section('footer') 
    <script src="{!! url('js/terapi.js') !!}"></script>
@stop
