@extends('layout.master')
@section('title') 
Online Electronic Medical Record | Create Obat
@stop
@section('page-title') 
<h2>Create Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/obats')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Create</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/obats', 'method' => 'post']) !!}
		@include('obats.form2')
	{!! Form::close() !!}
@stop
@section('footer') 
    <script src="{!! url('js/obat.js') !!}"></script>
@stop
