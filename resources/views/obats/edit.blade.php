@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Edit Obat

@stop
@section('page-title') 
<h2>Edit Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/obats')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Edit</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::model($obat, ['url' => 'home/obats/'. $obat->id, 'method' => 'put']) !!}
		@include('obats.form')
		{{-- @include('obats.form2') --}}
		
	{!! Form::close() !!}

@stop
@section('footer') 
    <script src="{!! url('js/obat.js') !!}"></script>
@stop

