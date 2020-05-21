<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Staf Baru</h3>
				</div>
				<div class="panel-body">
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
									'class'         => 'form-control'
								))!!}
							  @if($errors->has('pass'))<code>{{ $errors->first('pass') }}</code>@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				{!! Form::label('image', 'Foto Staf') !!}
				{!! Form::file('image') !!}
					@if (isset($staf) && $staf->image)
						@include('periksas.imagePasien', ['model' => $staf,'temp' => 'image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group{{ $errors->has('ktp_image') ? ' has-error' : '' }}">
				{!! Form::label('ktp_image', 'Foto KTP') !!}
				{!! Form::file('ktp_image') !!}
					@if (isset($staf) && $staf->ktp_image)
						@include('periksas.imagePasien', ['model' => $staf,'temp' => 'ktp_image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
	</div>
<br>
