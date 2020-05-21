
			<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				{!! Form::label('image', 'Foto Pasien') !!}
				{!! Form::file('image') !!}
					@if (isset($pasien) && $pasien->image)
						@include('periksas.imagePasien', ['model' => $pasien, 'temp' => 'image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
			</div>
