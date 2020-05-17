@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Buat Staf

@stop
@section('page-title') 
<h2>
	Online Electronic Medical Record | Buat Staf
</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/stafs')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Create</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Staf Baru</h3>
				</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'home/stafs', 'method' => 'post']) !!}
						@include('stafs.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

