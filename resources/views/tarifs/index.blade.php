@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Tarif

@stop
@section('page-title') 
<h2>Nurse Station</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Tarif</strong>
	  </li>
</ol>

@stop
@section('content') 
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Nama Tindakan</th>
							<th>Biaya</th>
							<th>Jasa Dokter</th>
							<th>Bahan Habis Pakai</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($tarifs->count() > 0)
							@foreach($tarifs as $tarif)
								<tr>
									<td>{{ $tarif->jenisTarif->jenis_tarif }}</td>
									<td>{{ App\Yoga::buatrp( $tarif->biaya ) }}</td>
									<td>{{ App\Yoga::buatrp( $tarif->jasa_dokter ) }}</td>
									<td>{{$tarif->bahanHabisPakai}}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/tarifs/' . $tarif->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/tarifs/' . $tarif->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $tarif->jenisTarif->jenis_tarif }}  tarif ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
				{{ $tarifs->links() }}
			</div>
@stop
@section('footer') 
	
@stop

