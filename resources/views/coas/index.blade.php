@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Coa

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Coa</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Coa</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/coas/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Coa Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Coa</th>
							<th>Kelompok Coa</th>
							<th>Saldo Awal</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($coas->count() > 0)
							@foreach($coas as $coa)
								<tr>
									<td>{{ $coa->id }}</td>
									<td>{{ $coa->coa }}</td>
									<td>{{ $coa->kelompokCoa->kelompok_coa }}</td>
									<td>{{ $coa->saldo_awal }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/coas/' . $coa->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/coas/' . $coa->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $coa->id }} - {{ $coa->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/coas/imports', 'method' => 'post', 'files' => 'true']) !!}
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
				{{ $coas->links() }}
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
@stop

