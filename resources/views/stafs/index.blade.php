@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Staf

@stop
@section('page-title') 
<h2>
	Online Electronic Medical Record | Staf
</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('laporans')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Staf</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">
					Staf
				</div>
				<div class="panelRight">
					<a href="{{ url( 'home/stafs/create' ) }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Staf Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered DT">
					<thead>
						<tr>
							<th>id</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>No Telp</th>
							{{-- <th>Rele</th> --}}
							<th>Alamat</th>
						</tr>
					</thead>
					<tbody>
						@if($stafs->count() > 0)
							@foreach($stafs as $staf)
								<tr>
									<td>{{ $staf->id }}</td>
									<td>{{ $staf->nama }}</td>
									<td>{{ $staf->alamat }}</td>
									<td>{{ $staf->no_telp }}</td>
									{{-- <td>{{ $staf->role->role }}</td> --}}
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/stafs/' . $staf->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/stafs/' . $staf->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $staf->id }} - {{ $staf->nama }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'stafs/imports', 'method' => 'post', 'files' => 'true']) !!}
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
			</div>
			
		</div>
	</div>
@stop
@section('footer') 
	
@stop

