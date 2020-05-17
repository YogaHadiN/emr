@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Pembelian Obat

@stop
@section('page-title') 
<h2>Kasir</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Kasir</strong>
	  </li>
</ol>

@stop
@section('content') 
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Poli</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
@stop
@section('footer') 
	
@stop

