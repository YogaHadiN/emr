@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Poli

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Poli</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Poli</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/polis/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Poli Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Poli</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($polis->count() > 0)
							@foreach($polis as $poli)
								<tr>
									<td>{{ $poli->id }}</td>
									<td>{{ $poli->poli }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/polis/' . $poli->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/polis/' . $poli->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $poli->id }} - {{ $poli->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="3" class="text-center">Tidak ada data untuk ditampilkan</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
@stop

