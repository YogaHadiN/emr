@extends('layout.master')

@section('title') 
	Online Electronic Medical Record | {{ ucfirst($poli->poli) }}

@stop
@section('page-title') 
<h2>Antrian Poli</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>{{ ucfirst($poli->poli) }}</strong>
	  </li>
</ol>

@stop
@section('content') 
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Pasien</th>
				<th>Pembayaran</th>
				<th>Pemeriksa</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if($antrians->count() > 0)
				@foreach($antrians as $antrian)
					<tr>
						<td>{{ $antrian->pasien->nama }}</td>
						<td>{{ $antrian->asuransi->nama_asuransi }}</td>
						<td>{{ $antrian->staf->nama }}</td>
						<td nowrap class="autofit">
							{!! Form::open(['url' => 'home/nurse_stations/' . $antrian->id, 'method' => 'delete']) !!}
								<a class="btn btn-success btn-sm" href="{{ url('home/nurse_stations/' . $antrian->id . '/periksa') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
								<a class="btn btn-warning btn-sm" href="{{ url('home/nurse_stations/' . $antrian->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $antrian->id }} - {{ $antrian->pasien->nama }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-center">Tidak ada data ditemukan</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>
@stop
@section('footer') 
	
@stop

