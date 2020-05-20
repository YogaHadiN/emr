@if( isset($pasien))
	{!! Form::model($pasien,[
		'url'     => 'home/pasiens/' . $pasien->id,
		'enctype' => 'multipart/form-data',
		"files"  => "true",
		'method'  => 'put'
	]) !!}
@else
	{!! Form::open([
		'url'     => 'home/pasiens',
		"files"  => "true",
		'enctype' => 'multipart/form-data',
		'method'  => 'post',
	]) !!}
@endif
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					@if( isset( $pasien )  )
						Update Pasien
					@else
						Create Pasien
					@endif
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group @if($errors->has('nama')) has-error @endif">
						  {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
						  {!! Form::text('nama' , null, ['class' => 'form-control rq']) !!}
						  @if($errors->has('nama'))<code>{{ $errors->first('nama') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group @if($errors->has('alamat'))has-error @endif">
						  {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
							{!! Form::textarea('alamat', null, array(
								'class'         => 'form-control textareacustom rq'
							))!!}
						  @if($errors->has('alamat'))<code>{{ $errors->first('alamat') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('no_telp'))has-error @endif">
						  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
							{!! Form::text('no_telp', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('asuransi_id'))has-error @endif">
						  {!! Form::label('asuransi_id', 'Asuransi', ['class' => 'control-label']) !!}
							{!! Form::select('asuransi_id', $asuransis, null, array(
								'class'         => 'form-control rq'
							))!!}
						  @if($errors->has('asuransi_id'))<code>{{ $errors->first('asuransi_id') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('nomor_asuransi'))has-error @endif">
						  {!! Form::label('nomor_asuransi', 'Nomor Asuransi', ['class' => 'control-label']) !!}
							{!! Form::text('nomor_asuransi', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('nomor_asuransi'))<code>{{ $errors->first('nomor_asuransi') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('nama_peserta'))has-error @endif">
							{!! Form::label('nama_peserta', 'Nama Peserta', ['class' => 'control-label']) !!}
							{!! Form::text('nama_peserta', null, array(
								'class'         => 'form-control'
							))!!}
							@if($errors->has('nama_peserta'))<code>{{ $errors->first('nama_peserta') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('no_ktp'))has-error @endif">
						  {!! Form::label('no_ktp', 'Nomor KTP', ['class' => 'control-label']) !!}
							{!! Form::text('no_ktp', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('no_ktp'))<code>{{ $errors->first('no_ktp') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('jenis_peserta_id'))has-error @endif">
						  {!! Form::label('jenis_peserta_id', 'Jenis Peserta', ['class' => 'control-label']) !!}
							{!! Form::select('jenis_peserta_id', \App\JenisPeserta::pluck('jenis_peserta', 'id'), null, array(
								'class'         => 'form-control rq'
							))!!}
						  @if($errors->has('jenis_peserta_id'))<code>{{ $errors->first('jenis_peserta_id') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('sex'))has-error @endif">
						  {!! Form::label('sex', 'Jenis Kelamin', ['class' => 'control-label']) !!}
							{!! Form::select('sex', \App\Yoga::jenisKelaminList(), null, array(
								'class'         => 'form-control rq'
							))!!}
						  @if($errors->has('sex'))<code>{{ $errors->first('sex') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('tanggal_lahir'))has-error @endif">
						  {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'control-label']) !!}
						  @if(isset($pasien))
							  {!! Form::text('tanggal_lahir', App\Yoga::updateDatePrep($pasien->tanggal_lahir), array( 'class'         => 'form-control tanggal'))!!}
							@else
							{!! Form::text('tanggal_lahir', null, array( 'class'         => 'form-control tanggal'))!!}
							@endif
						  @if($errors->has('tanggal_lahir'))<code>{{ $errors->first('tanggal_lahir') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('nama_ayah'))has-error @endif">
						  {!! Form::label('nama_ayah', 'Nama Ayah', ['class' => 'control-label']) !!}
							{!! Form::text('nama_ayah', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('nama_ayah'))<code>{{ $errors->first('nama_ayah') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('nama_ibu'))has-error @endif">
						  {!! Form::label('nama_ibu', 'Nama Ibu', ['class' => 'control-label']) !!}
							{!! Form::text('nama_ibu', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('nama_ibu'))<code>{{ $errors->first('nama_ibu') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('email'))has-error @endif">
						  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
							{!! Form::text('email', null, array(
								'class'         => 'form-control'
							))!!}
						  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
						</div>
					</div>
				</div>
				{!! Form::text('random_string', $random_string, array(
					'class'         => 'form-control'
				))!!}
				@include('images.barcode')
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				{!! Form::label('image', 'Foto Pasien') !!}
				{!! Form::file('image') !!}
					@if (isset($pasien) && $pasien->image)
						@include('periksas.imagePasien', ['temp' => 'image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group{{ $errors->has('ktp_image') ? ' has-error' : '' }}">
				{!! Form::label('ktp_image', 'KTP') !!}
				{!! Form::file('ktp_image') !!}
					@if (isset($pasien) && $pasien->ktp_image)
						@include('periksas.imagePasien', ['temp' => 'ktp_image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('ktp_image', '<p class="help-block">:message</p>') !!}
			</div>
			<div class="form-group{{ $errors->has('bpjs_image') ? ' has-error' : '' }}">
				{!! Form::label('bpjs_image', 'Kartu BPJS') !!}
				{!! Form::file('bpjs_image') !!}
					@if (isset($pasien) && $pasien->bpjs_image)
						@include('periksas.imagePasien', ['temp' => 'bpjs_image'])
					@else
						<p> {!! HTML::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
					@endif
				{!! $errors->first('bpjs_image', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
</div>
<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>
				@if( isset($pasien) )
					Update
				@else
					Submit
				@endif
			</button>
			{!! Form::submit('Submit', ['class' => 'submit btn btn-success hide', 'id' => 'submit']) !!}
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
		</div>
</div>
{!! Form::close() !!}
<br>
<div class="row">
	@if(isset($pasien))
	{!! Form::open(['url' => 'home/pasiens/' . $pasien->id, 'method' => 'delete']) !!}
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<button class="btn btn-warning btn-block" onclick="return confirm('Anda yakin ingin menghapus {{ $pasien->id }} - {{  $pasien->nama  }} ?')" type="submit">Delete</button>
		</div>
	{!! Form::close() !!}
	@endif
</div>
	@include('pasiens.image_template')
	{{-- @include('images.barcode') --}}
	<div id="app">
		Event Listener
	</div>
