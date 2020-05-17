<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('role')) has-error @endif">
			{!! Form::label('role', 'Role', ['class' => 'control-label']) !!}
			{!! Form::text('role' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('role'))<code>{{ $errors->first('role') }}</code>@endif
		</div>
	</div>
</div>
<h1>Permission</h1>	
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Table</th>
						<th>Read</th>
						<th>Create</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@if(count($tables) > 0)
						@foreach($tables as $table)
							@if(  
								$table->Tables_in_emr != 'migrations' &&
								$table->Tables_in_emr != 'password_resets' &&
								$table->Tables_in_emr != 'users' 
								)

							<tr>
								<td class='table_name'>{{ $table->Tables_in_emr }}</td>
								@if( isset($role) )
									@include('roles.tidisedit')
								@else
									@include('roles.tidis')
								@endif
							</tr>
							@endif
						@endforeach
					@else
						<tr>
							<td colspan="5" class="text-center">Tidak ada data untuk ditampilkan</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
{!! Form::textarea('restriction', null, ['class' => 'form-control hide', 'id' => 'json_data']) !!}
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if(isset($role))
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/roles') }}">Cancel</a>
			</div>
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/roles') }}">Cancel</a>
			</div>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
</div>
