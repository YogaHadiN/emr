@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Create Roles

@stop
@section('page-title') 
<h2>Pendaftaran</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">home</a>
	  </li>
	<li>
		  <a href="{{ url('home/roles')}}">Roles</a>
	  </li>
	  <li class="active">
		  <strong>Create</strong>
	  </li>
</ol>
@stop
@section('content') 
	{!! Form::open(['url' => 'home/roles', 'method' => 'post']) !!}
		@include('roles.form')
	{!! Form::close() !!}
@stop
@section('footer') 
    <script src="{!! url('js/role.js') !!}"></script>
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>
@stop
