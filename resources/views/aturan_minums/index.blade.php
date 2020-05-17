@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Aturan Minum

@stop
@section('page-title') 
<h2>Aturan Minum</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Aturan Minum</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="panelLeft">Aturan Minum</div>
				<div class="panelRight">
					<a class="btn btn-primary" href="{{ url('home/aturan_minums/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Aturan Minum Baru</a>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Aturan Minum</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($aturan_minums->count() > 0)
							@foreach($aturan_minums as $aturan_minum)
								<tr>
									<td>{{ $aturan_minum->id }}</td>
									<td>{{ $aturan_minum->aturan_minum }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/aturan_minums/' . $aturan_minum->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/aturan_minums/' . $aturan_minum->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $aturan_minum->id }} - {{ $aturan_minum->aturan_minum }} ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/aturan_minums/imports', 'method' => 'post', 'files' => 'true']) !!}
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
				{{ $aturan_minums->links() }}
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
@stop

