@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Signa

@stop
@section('page-title') 
<h2>Nurse Station</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Signa </strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="text-right">
		<a class="btn btn-primary" href="{{ url('home/signas/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Signa</a>
	</div>
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th width="10%">ID Pasien</th>
							<th>Signa</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($signas->count() > 0)
							@foreach($signas as $signa)
								<tr>
									<td width="10%">{{ $signa->id }}</td>
									<td>{{ $signa->signa }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/signas/' . $signa->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/signas/' . $signa->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $signa->signa }} dari signa ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
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

			{{ $signas->links() }}
@stop
@section('footer') 
	
@stop

