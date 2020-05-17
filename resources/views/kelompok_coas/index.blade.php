@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Kelompok Coa	

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Kelompok Coa</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Kelompok Coa</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/kelompok_coas/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Kelompok Coa Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Kelompok Coas</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($kelompok_coas->count() > 0)
							@foreach($kelompok_coas as $kelompk_coa)
								<tr>
									<td>{{ $kelompk_coa->id }}</td>
									<td>{{ $kelompk_coa->kelompok_coa }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/kelompok_coas/' . $kelompk_coa->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/kelompok_coas/' . $kelompk_coa->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $kelompk_coa->id }} - {{ $kelompk_coa->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/kelompok_coas/imports', 'method' => 'post', 'files' => 'true']) !!}
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

