@extends('layout.master')

@section('head') 
	<link href="{!! asset('css/poli.css') !!}" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title') 

Online Electronic Medical Record | Buat Pasien Baru

@stop
@section('page-title') 
<h2>Create Pasien</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/pasiens')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Create Pasien
					</h3>
				</div>
				<div class="panel-body">
					{!! Form::open([
						'url'     => 'home/pasiens',
						'enctype' => 'multipart/form-data',
						'method'  => 'post',
					]) !!}
					@include('pasiens.formEdit')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div id="image_container" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		</div>
	</div>
	@include('pasiens.image_template')
	@include('images.barcode')
	<div id="app">
		Event Listener
	</div>
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		var random_string = "{{ $random_string }}";
	</script>
{!! HTML::script('js/pasien_edit.js')!!}
{!! HTML::script('js/app.js')!!}
@stop

