@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Pembelian Obat

@stop
@section('page-title') 
<h2>Pembelian Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/faktur_belanja_obats')}}">Pembelian Obat</a>
	  </li>
	  <li class="active">
		  <strong>{{ $faktur_belanja_obat->id }}</strong>
	  </li>
</ol>

@stop
@section('content') 

	<div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered">
			<tbody>
				<tr>
					<td>Nama Supplier</td>
					<td>{{ $faktur_belanja_obat->supplier->nama }}</td>
				</tr>
				<tr>
					<td>Nama Staf</td>
					<td>{{ $faktur_belanja_obat->staf->nama }}</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td>{{ App\Yoga::updateDatePrep( $faktur_belanja_obat->tanggal ) }}</td>
				</tr>
				<tr>
					<td>Nomor Nota</td>
					<td>{{ $faktur_belanja_obat->nomor_nota }}</td>
				</tr>
				<tr>
					<td>Diskon</td>
					<td>{{ App\Yoga::buatrp( $faktur_belanja_obat->diskon ) }}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<h1>Daftar Pembelian Obat</h1>
	<div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>Obat</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
					<th>Exp Date</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@if($faktur_belanja_obat->pembelianObat->count() > 0)
					@foreach($faktur_belanja_obat->pembelianObat as $pembelian)
						<tr>
							<td>{{ $pembelian->obat->merek }}</td>
							<td>{{ App\Yoga::buatrp( $pembelian->harga_beli ) }}</td>
							<td>{{ App\Yoga::buatrp( $pembelian->harga_jual ) }}</td>
							<td>{{ $pembelian->jumlah }} pcs </td>
							<td class="text-right">{{ App\Yoga::buatrp( $pembelian->harga_beli * $pembelian->jumlah ) }}</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6" class="text-center">Tidak ada data ditemukan</td>
					</tr>
				@endif
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<h2>Total</h2>
					</td>
					<td class="text-right">
						<h2>{{ App\Yoga::buatrp( $faktur_belanja_obat->total_belanja )}}</h2>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@stop
@section('footer') 
	
@stop

