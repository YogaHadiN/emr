<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('kelompok_coa')) has-error @endif">
		  {!! Form::label('kelompok_coa', 'Nama Asuransi', ['class' => 'control-label']) !!}
		  {!! Form::text('kelompok_coa' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('kelompok_coa'))<code>{{ $errors->first('kelompok_coa') }}</code>@endif
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
		<div class="form-group @if($errors->has('no_telp')) has-error @endif">
		  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
		  {!! Form::text('no_telp' , null, ['class' => 'form-control']) !!}
		  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if(isset($update))
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('home/asuransis') }}">Cancel</a>
	</div>
</div>
