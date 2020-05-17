@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Belanja Obat	

@stop
@section('page-title') 
<h2>Belanja Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
		<li>
		  <a href="{{ url('home/kasirs')}}">Kasir</a>
	  </li>
		<li>
		  <a href="{{ url('home/faktur_belanja_obats')}}">Pembelian Obat</a>
	  </li>
	  <li class="active">
		  <strong>Belanja Obat</strong>
	  </li>
</ol>
@stop
@section('content') 
	<table class="hide">
		<tbody id="tempTambahObat">
			@include('faktur_belanja_obats.tambahObat')
		</tbody>
	</table>
	{!! Form::open(['url' => 'home/faktur_belanja_obats', 'method' => 'post']) !!}
		@include('faktur_belanja_obats.form')
	{!! Form::close() !!}
@stop
@section('footer') 
    <script src="{!! url('js/faktur_belanja_obat.js') !!}"></script>
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop
