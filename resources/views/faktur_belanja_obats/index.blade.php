@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Nurse Station

@stop
@section('page-title') 
<h2>Pembelian Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/kasirs')}}">Kasir</a>
	  </li>
	  <li class="active">
		  <strong>Pembelian Obat</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="text-right">
		<a class="btn btn-primary" href="{{ url('home/faktur_belanja_obats/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Belanja Obat</a>
	</div>
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Supplier</th>
							<th>Nama Staf</th>
							<th>Total Belanja</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($faktur_belanja_obats->count() > 0)
							@foreach($faktur_belanja_obats as $faktur_belanja_obat)
								<tr>
									<td>{{ $faktur_belanja_obat->tanggal }}</td>
									<td>{{ $faktur_belanja_obat->supplier->nama }}</td>
									<td>{{ $faktur_belanja_obat->staf->nama }}</td>
									<td>{{ App\Yoga::buatrp($faktur_belanja_obat->total_belanja) }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/faktur_belanja_obats/' . $faktur_belanja_obat->id, 'method' => 'delete']) !!}
											<a class="btn btn-info btn-sm" href="{{ url('home/faktur_belanja_obats/' . $faktur_belanja_obat->id ) }}"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $faktur_belanja_obat->id }} dari faktur_belanja_obat?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
				{{ $faktur_belanja_obats->links() }}
			</div>
@stop
@section('footer') 
	
@stop

