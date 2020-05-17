@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Kasir

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
							<th>Pembayaran</th>
							<th>Pemeriksa</th>
							<th>Waktu Terdaftar</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($kasirs->count() > 0)
							@foreach($kasirs as $kasir)
								<tr>
									<td>{{ $kasir->periksa->pasien->nama }}</td>
									<td>{{ $kasir->periksa->poli }}</td>
									<td>{{ $kasir->periksa->asuransi->nama_asuransi }}</td>
									<td>{{ $kasir->periksa->staf->nama }}</td>
									<td>{{ $kasir->periksa->waktu_datang }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/kasirs/' . $kasir->id . '/kembalikan', 'method' => 'post']) !!}
											<a class="btn btn-success btn-sm" href="{{ url('home/kasirs/' . $kasir->id . '/create') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
											<a class="btn btn-info btn-sm" target="_blank" href="{{ url('home/periksas/' . $kasir->periksa_id . '/status/pdf') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan {{ $kasir->periksa->pasien->nama }} ke antrian apotek ?')" type="submit"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="6" class="text-center">Tidak ada data ditemukan</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
@stop
@section('footer') 
	
@stop

