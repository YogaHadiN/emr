@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Pasien

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong></strong>
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
						@if($periksas->count() > 0)
							@foreach($periksas as $periksa)
								<tr>
									<td>{{ $periksa->pasien->nama }}</td>
									<td>{{ $periksa->poli }}</td>
									<td>{{ $periksa->asuransi->nama_asuransi }}</td>
									<td>{{ $periksa->staf->nama }}</td>
									<td>{{ $periksa->waktu_datang }}</td>
									<td nowrap class="autofit">
										<a class="btn btn-info btn-sm" target="_blank" href="{{ url('home/periksas/' . $periksa->id . '/status/pdf') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
										<a class="btn btn-warning btn-sm" target="_blank" href="{{ url('home/periksas/'. $periksa->id . '/struk/pdf') }}"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></a>
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

