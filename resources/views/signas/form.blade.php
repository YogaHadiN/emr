<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('signa')) has-error @endif">
		  {!! Form::label('signa', 'Waktu', ['class' => 'control-label']) !!}
		  {!! Form::text('signa' , null, ['class' => 'form-control rq']) !!}
		  @if($errors->has('signa'))<code>{{ $errors->first('signa') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if(isset($signa))
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/signas') }}">Cancel</a>
			</div>
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/pasiens') }}">Cancel</a>
			</div>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
</div>
