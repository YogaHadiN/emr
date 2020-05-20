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
	@include('pasiens.formEdit')
@stop
@section('footer') 
<script type="text/javascript" charset="utf-8">
	var random_string = "{{ $random_string }}";
</script>
{!! HTML::script('js/pasien_edit.js')!!}
{!! HTML::script('js/app.js')!!}
@stop

