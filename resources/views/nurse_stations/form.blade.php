<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<tbody>
					<tr>
						<td>
							<strong>Pembayaran</strong>	
						</td>
						<td>
							@if(isset($nurse_station))
								{{ $nurse_station->asuransi->nama_asuransi }}	
							@else
								{{ $daftar->asuransi->nama_asuransi }}	
							@endif
						</td>
					</tr>
					<tr>
						<td>
						<strong>Pemeriksa</strong>
						</td>
						<td>
							@if(isset($nurse_station))
								{{ $nurse_station->staf->nama }}	
							@else
								{{ $daftar->staf->nama }}	
							@endif
						</td>
					</tr>
					<tr>
						<td>
						<strong>Poli</strong>	
						</td>
						<td>
							@if(isset($nurse_station))
								 {{ $nurse_station->poli->poli }}	
							@else
								 {{ $daftar->poli->poli }}	
							@endif
						</td>
					</tr>
					<tr>
						<td>
						<strong>Jenis Kelamin</strong>	
						</td>
						<td>
							@if(isset($nurse_station))
								 {{ $nurse_station->pasien->jeniskelamin }}	
							@else
								 {{ $daftar->pasien->jeniskelamin }}	
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="row hide">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('id')) has-error @endif">
				  {!! Form::label('id', 'id', ['class' => 'control-label']) !!}
				@if(isset($nurse_station))
					{!! Form::text('id' , $nurse_station->id, ['class' => 'form-control rq']) !!}
				@else
					{!! Form::text('id' , $daftar->id, ['class' => 'form-control rq']) !!}
				@endif
				  @if($errors->has('id'))<code>{{ $errors->first('id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('hamil'))has-error @endif">
				  {!! Form::label('hamil', 'Hamil', ['class' => 'control-label']) !!}
					@if(isset($nurse_station) && $nurse_station->pasien->sex == 1)
						{!! Form::select('hamil', App\Yoga::yesNoList('hamil'), 0, array(
							'class'         => 'form-control'
						))!!}
					@elseif(isset($daftar) && $daftar->pasien->sex == 1)
						{!! Form::select('hamil', App\Yoga::yesNoList('hamil'), 0, array(
							'class'         => 'form-control'
						))!!}
					@else
						{!! Form::select('hamil', App\Yoga::yesNoList('hamil'), null, array(
							'class'         => 'form-control'
						))!!}
					@endif
				  @if($errors->has('hamil'))<code>{{ $errors->first('hamil') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('tinggi_badan'))has-error @endif">
				  {!! Form::label('tinggi_badan', 'Tinggi Badan', ['class' => 'control-label']) !!}
				  <div class="input-group">
					{!! Form::text('tinggi_badan', null, array(
						'class'         => 'form-control',
						'dir'         => 'rtl'
					))!!}
				  	<span class="input-group-addon">cm</span>
				  </div>
				  @if($errors->has('tinggi_badan'))<code>{{ $errors->first('tinggi_badan') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('berat_badan'))has-error @endif">
				  {!! Form::label('berat_badan', 'Berat Badan', ['class' => 'control-label']) !!}
				  <div class="input-group">
					{!! Form::text('berat_badan', null, array(
						'class'         => 'form-control',
						'dir'         => 'rtl'
					))!!}
				  	<span class="input-group-addon">kg</span>
				  </div>
				  @if($errors->has('berat_badan'))<code>{{ $errors->first('berat_badan') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('suhu'))has-error @endif">
				  {!! Form::label('suhu', 'Suhu', ['class' => 'control-label']) !!}
				  <div class="input-group">
					{!! Form::text('suhu', null, array(
						'class'         => 'form-control',
						'dir'         => 'rtl'
					))!!}
				  	<span class="input-group-addon">C</span>
				  </div>
				  @if($errors->has('suhu'))<code>{{ $errors->first('suhu') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('asisten_id'))has-error @endif">
				  {!! Form::label('asisten_id', 'Nama Asisten', ['class' => 'control-label']) !!}
					{!! Form::select('asisten_id', App\Staf::selectList(), null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('asisten_id'))<code>{{ $errors->first('asisten_id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('sistolik'))has-error @endif">
				  {!! Form::label('sistolik', 'Sistolik', ['class' => 'control-label']) !!}
					{!! Form::text('sistolik', null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('sistolik'))<code>{{ $errors->first('sistolik') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('diastolik'))has-error @endif">
				  {!! Form::label('diastolik', 'Diastolik', ['class' => 'control-label']) !!}
					{!! Form::text('diastolik', null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('diastolik'))<code>{{ $errors->first('diastolik') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('kecelakaan_kerja'))has-error @endif">
				  {!! Form::label('kecelakaan_kerja', 'Kecelakaan Kerja', ['class' => 'control-label']) !!}
					{!! Form::select('kecelakaan_kerja', App\Yoga::yesNoList('Kecelakaan Kerja'), null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('kecelakaan_kerja'))<code>{{ $errors->first('kecelakaan_kerja') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				@if(isset($daftar))
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a class="btn btn-danger btn-block" href="{{ url('home/daftars') }}">Cancel</a>
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
	</div>
</div>
