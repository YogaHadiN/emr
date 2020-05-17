@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Supplier

@stop
@section('page-title') 
<h2>Supplier</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Supplier</strong>
	  </li>
</ol>

@stop
@section('content') 
		<div class="text-right">
			<a class="btn btn-primary" href="{{ url('home/suppliers/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Supplier</a>
		</div>
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Supplier</th>
							<th>No Telp</th>
							<th>Alamat</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($suppliers->count() > 0)
							@foreach($suppliers as $supplier)
								<tr>
									<td>{{ $supplier->nama }}</td>
									<td>{{ $supplier->no_telp }}</td>
									<td>{{ $supplier->alamat }}</td>
									<td>{{ $supplier->email }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/suppliers/' . $supplier->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/suppliers/' . $supplier->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $supplier->nama }} dari daftar supplier?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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
				{{ $suppliers->links() }}
			</div>
@stop
@section('footer') 
	
@stop

