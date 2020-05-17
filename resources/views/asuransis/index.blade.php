@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Pasien

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Auransi</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Asuransi</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/asuransis/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Asuransi Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Asuransi</th>
							<th>Alamat</th>
							<th>No Telp</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($asuransis->count() > 0)
							@foreach($asuransis as $asuransi)
								<tr>
									<td>{{ $asuransi->id }}</td>
									<td>{{ $asuransi->nama_asuransi }}</td>
									<td>{{ $asuransi->no_telp }}</td>
									<td>{{ $asuransi->alamat }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/asuransis/' . $asuransi->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/asuransis/' . $asuransi->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $asuransi->id }} - {{ $asuransi->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/asuransis/imports', 'method' => 'post', 'files' => 'true']) !!}
										<div class="form-group">
											{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
											{!! Form::file('file') !!}
											{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
										</div>
									{!! Form::close() !!}
								</td>
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

