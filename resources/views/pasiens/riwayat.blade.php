@extends('layout.master')

@section('title') 
	Klinik Jati Elok | Riwayat Pemeriksaaan {{ $pasien->nama }}

@stop
@section('page-title') 
<h2>Riwayat Pemeriksaaan {{ $pasien->nama }}</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/pasiens')}}">Pasien</a>
	  </li>
	  <li class="active">
		  <strong>Riwayat Pemeriksaaan {{ $pasien->nama }}</strong>
	  </li>
</ol>

@stop
@section('content') 
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Riwayat</th>
				<th>Terapi</th>
			</tr>
		</thead>
		<tbody>
			@if($pasien->periksa->count() > 0)
				@foreach($pasien->periksa as $periksa)
					@include('pasiens.riwayat_template')
				@endforeach
			@else
				<tr>
					<td colspan="3" class="text-center">Tidak ada Data untuk ditampilkan :p</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>

@stop
@section('footer') 
	
@stop

