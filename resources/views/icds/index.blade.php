@extends('layout.master')

@section('title') 
Online Electronic Medical Record | ICD 10

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>ICD 10</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				ICD 10
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama ICD 10</th>
						</tr>
					</thead>
					<tbody>
						@if($icds->count() > 0)
							@foreach($icds as $icd)

								<tr>
									<td>{{ $icd->id }}</td>
									<td>{{ $icd->diagnosaICD }}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/icds/imports', 'method' => 'post', 'files' => 'true']) !!}
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
				{{ $icds->links() }}
			</div>
		</div>
	</div>
@stop
@section('footer') 
	
@stop

