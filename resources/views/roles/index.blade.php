@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Role

@stop
@section('page-title') 
<h2>Role</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Role</strong>
	  </li>
</ol>

@stop
@section('content') 
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($roles->count() > 0)
							@foreach($roles as $role)
								<tr>
									<td width="10%">{{ $role->id }}</td>
									<td>{{ $role->role }}</td>
									<td nowrap class="autofit">
										{!! Form::open(['url' => 'home/roles/' . $role->id, 'method' => 'delete']) !!}
											<a class="btn btn-warning btn-sm" href="{{ url('home/roles/' . $role->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus {{ $role->role }} dari role ?')" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="3" class="text-center">Tidak ada data ditemukan</td>
							</tr>
						@endif
					</tbody>
				</table>
			{{ $roles->links() }}
			</div>

@stop
@section('footer') 
	
@stop

