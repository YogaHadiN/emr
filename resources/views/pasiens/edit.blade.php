@extends('layout.master')

@section('head') 
	<link href="{!! asset('css/poli.css') !!}" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title') 

Online Electronic Medical Record | Pasien

@stop
@section('page-title') 
<h2>Edit Pasien</h2>
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
						Edit Pasien
					</h3>
				</div>
				<div class="panel-body">
					{!! Form::model($pasien,[
						'url'     => 'home/pasiens/' . $pasien->id,
						'enctype' => 'multipart/form-data',
						'method'  => 'put'
					]) !!}
						@include('pasiens.formEdit')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			@if( Storage::disk('s3')->has( 'pasiens/pasien' . $pasien->id . '.jpg' ) )
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Pasien</h3>
						</div>
						<div class="panel-body">
							<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( 'pasiens/pasien' . $pasien->id . '.jpg' ) }}" alt="" />
						</div>
					</div>
				</div>
			</div>
			@endif
			@if( Storage::disk('s3')->has( 'pasiens/ktp' . $pasien->id . '.jpg' ) )
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"></h3>
						</div>
						<div class="panel-body">
							<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( 'pasiens/ktp' . $pasien->id . '.jpg' ) }}" alt="" />
						</div>
					</div>
				</div>
			</div>
			@endif
			@if( Storage::disk('s3')->has( 'pasiens/bpjs' . $pasien->id . '.jpg' ) )
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"></h3>
						</div>
						<div class="panel-body">
							<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( 'pasiens/bpjs' . $pasien->id . '.jpg' ) }}" alt="" />
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
@stop
@section('footer') 
	<script type="text/javascript" charset="utf-8">
		var random_string = "{{ $random_string }}";
	</script>

{!! HTML::script('js/pasien_edit.js')!!}
{!! HTML::script('js/app.js')!!}
 
@stop

