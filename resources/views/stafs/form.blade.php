<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('nama'))has-error @endif">
		  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
			{!! Form::text('nama', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('alamat'))has-error @endif">
		  {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
			{!! Form::textarea('alamat', null, array(
				'class'         => 'form-control textareacustom'
			))!!}
		  @if($errors->has('alamat'))<code>{{ $errors->first('alamat') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('no_telp'))has-error @endif">
		  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
			{!! Form::text('no_telp', null, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('pass'))has-error @endif">
		  {!! Form::label('pass', 'Password', ['class' => 'control-label']) !!}
			{!! Form::text('pass', null,  array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('pass'))<code>{{ $errors->first('pass') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	@if(isset($staf))
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
	{!! Form::close() !!}
	{!! Form::open(['url' => 'home/stafs/' . $staf->id, 'method' => 'delete']) !!}
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<button class="btn btn-warning btn-block" onclick="return confirm('Anda yakin ingin menghapus {{ $staf->id }} - {{  $staf->nama  }} ?')" type="submit">Delete</button>
		</div>
	@else
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
	@endif
</div>
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script>
