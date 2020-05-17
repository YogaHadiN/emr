@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Obat

@stop
@section('page-title') 
<h2>Obat</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Obat</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Obat</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/obats/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Obat Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Merek</th>
							<th>Formula</th>
							<th>Jumlah</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($obats->count() > 0)
							@foreach($obats as $obat)
								<tr>
									<td>{{ $obat->id }}</td>
									<td>{{ $obat->merek }}</td>
									<td>
									
										@foreach(json_decode($obat->formula) as $k => $formula)	
											@if( $k>0 )
												{{ $generiks[$formula->generik_id] }} {{$formula->bobot}}
												<br />
											@else
												{{ $generiks[$formula->generik_id] }} {{$formula->bobot}}
											@endif
										@endforeach
										
									</td>
									<td class="text-right">{{ $obat->stok }} pcs</td>
									{{-- <td>{{ $obat->kode_rak }}</td> --}}
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/obats/' . $obat->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/obats/' . $obat->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $obat->id }} - {{ $obat->nama_asuransi }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/obats/imports', 'method' => 'post', 'files' => 'true']) !!}
										<div class="form-group">
											{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
											{!! Form::file('file') !!}
											{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
										</div>
									{!! Form::close() !!}
								</td>
							</tr>
						@endif
					</tbody>
				</table>
			{{ $obats->links() }}
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
@stop

