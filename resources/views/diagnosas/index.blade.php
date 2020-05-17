@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Diagnosa

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Diagnosa</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				Diagnosa
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Diagnosa</th>
							<th>ICD 10</th>
							<th>Diagnosa ICD</th>
						</tr>
					</thead>
					<tbody>
						@if($diagnosas->count() > 0)
							@foreach($diagnosas as $diagnosa)

								<tr>
									<td>{{ $diagnosa->id }}</td>
									<td>{{ $diagnosa->diagnosa }}</td>
									<td>{{ $diagnosa->icd_id }}</td>
									<td>{{ $diagnosa->icd->diagnosaICD }}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/diagnosas/imports', 'method' => 'post', 'files' => 'true']) !!}
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
				{{ $diagnosas->links() }}
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

