@extends('layout.master')

@section('title') 
Online Electronic Medical Record | User

@stop
@section('page-title') 
<h2>User</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>User</strong>
	  </li>
</ol>

@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				User
			</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama User</th>
							<th>Alamat</th>
							<th>No Telp</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($users->count() > 0)
							@foreach($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->name}}</td>
									<td>{{ $user->no_telp }}</td>
									<td>{{ $user->alamat }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/users/' . $user->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/users/' . $user->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
											<button class="btn btn-danger btn-sm
											@if(Auth::id() == $user->id)	
												disabled" type="button"
											@else
												onclick="return confirm('Anda yakin ingin menghapus {{ $user->id }} - {{ $user->nama_asuransi }} ?')" type="submit"
											@endif
												  ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="">
									{!! Form::open(['url' => 'home/users/imports', 'method' => 'post', 'files' => 'true']) !!}
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

