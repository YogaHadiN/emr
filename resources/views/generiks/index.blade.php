@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Generik

@stop
@section('page-title') 
<h2>Generik</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Generik</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Generik</th>
							<th>Pregnancy Safety Index</th>
						</tr>
					</thead>
					<tbody>
						@if($generiks->count() > 0)
							@foreach($generiks as $generik)
								<tr>
									<td>{{ $generik->id }}</td>
									<td>{{ $generik->generik }}</td>
									<td>{!! $generik->pregnancy_safety_index !!}</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'generiks/imports', 'method' => 'post', 'files' => 'true']) !!}
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
			{{ $generiks->links() }}
		</div>
	</div>
@stop
@section('footer') 
	
@stop

