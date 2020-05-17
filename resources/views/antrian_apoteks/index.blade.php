@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Antrian Apotek

@stop
@section('page-title') 
<h2>Antrian Apotek</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Antrian Apotek</strong>
	  </li>
</ol>

@stop
@section('content') 
			<div class="table-responsive">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<thead>
							<tr>
								<th>Nama Pasien</th>
								<th>Pembayaran</th>
								<th>Nama Pemeriksa</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if($antrian_apoteks->count() > 0)
								@foreach($antrian_apoteks as $antrian_apotek)
									<tr>
										<td>{{ $antrian_apotek->periksa->pasien->nama }}</td>
										<td>{{ $antrian_apotek->periksa->asuransi->nama_asuransi }}</td>
										<td>{{ $antrian_apotek->periksa->staf->nama }}</td>
										<td nowrap class="autofit">
											{!! Form::open(['url' => 'home/antrian_apoteks/' . $antrian_apotek->id .'/kembalikan', 'method' => 'post']) !!}
												<a class="btn btn-success btn-sm" href="{{ url('home/antrian_apoteks/' . $antrian_apotek->id . '/periksa') }}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a>
												<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan {{ $antrian_apotek->id }} - {{ $antrian_apotek->periksa->pasien->nama }} ke {{ $antrian_apotek->periksa->poli }} ?')" type="submit"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></button>
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
				
			</div>
@stop
@section('footer') 
	
@stop

