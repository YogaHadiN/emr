		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						@if( isset($periksa) )
							@include('periksas.imagePasien', ['pasien' => $periksa->pasien,  'temp' => 'image'])
						@else
							@include('periksas.imagePasien', ['pasien' => $nurse_station->pasien,  'temp' => 'image'])
						@endif
						@if( isset($periksa) )
							<h1>{{ $periksa->pasien->nama }}</h1>
						@else
							<h1>{{ $nurse_station->pasien->nama }}</h1>
						@endif
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<tbody>
									<tr>
										<td>
										<strong>Umur</strong>
										</td>
										<td>
											{{ $nurse_station->pasien->umur }}	
										</td>
									</tr>
									<tr>
										<td>
											<strong>Pembayaran</strong>	
										</td>
										<td>
											{{ $nurse_station->asuransi->nama_asuransi }}	
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<tr>
										<th>
											Pemeriksaan Terakhir
										</th>
										<th class="text-right">
											<a target="_blank" class="btn btn-primary btn-sm text-right" href="{{ url('home/pasiens/' . $nurse_station->pasien_id . '/riwayat') }}">
											<span class="glyphicon glyphicon-list" aria-hidden="true"></span>	
												Lihat Semua Riwayat
											</a>
										</th>
									</tr>
								</thead>
								<tbody>
									@if(!is_null($periksa_last))
									<tr>
										<td>
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-bordered">
													<tbody>
														<tr>
															<td>
																<strong>Tanggal </strong> 
															</td>
															<td>
																{{ date('d-m-Y H:i:s', strtotime($periksa_last->waktu_datang))   }}
															</td>
														</tr>
														<tr>
															<td>
																<strong>Pemeriksa :</strong>  <br />
															</td>
															<td>
																{{ $periksa_last->staf->nama }}
															</td>
														</tr>
														<tr>
															<td>
																<strong>Pembayaran :</strong>
															</td>
															<td>
																{{ $periksa_last->asuransi->nama_asuransi }}
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<strong>Anamnesis : </strong> <br />
											{{ $periksa_last->anamnesa }} <br />
											<br />
											<strong>Pemeriksaan Fisik : </strong> <br />
											{{ $periksa_last->pemeriksaan_fisik }} <br />
											<br />
											<strong>Pemeriksaan Penunjang  / Tindakan: </strong> <br />
											<ul>
												
												@foreach($periksa_last->transaksiPeriksa as $tindakan)	
													<li>{{ $tindakan->tarif->jenisTarif->jenis_tarif}} : {{ $tindakan->keterangan_pemeriksaan }}</li>
												@endforeach
												
											</ul>
											<strong>Diagnosa : </strong> <br />
											{{ $periksa_last->diagnosa->diagnosa }} (<strong>{{ $periksa_last->diagnosa->icd_id }}</strong>  | {{ $periksa_last->diagnosa->icd->diagnosaICD }})
											<br />
											{{ $periksa_last->keterangan_diagnosa }}

										</td>
										<td nowrap class="autofit">
											{!! $periksa_last->terapi_temp !!}
										</td>
									</tr>
									@else
										<tr>
											<td class="text-center" colspan="2">Tidak ada data</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<tbody>
							@if( isset($periksa) && $periksa->kecelakaan_kerja )
								@include('periksas.kecelakaan_kerja')
							@elseif( !isset($periksa) && $nurse_station->kecelakaan_kerja )
								@include('periksas.kecelakaan_kerja')
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="table-responsive">
					<table class="table table-hover table-condensed table-bordered">
						<tbody>
							@if( isset($periksa) && $periksa->kecelakaan_kerja )
								@include('periksas.kecelakaan_kerja')
							@elseif( !isset($periksa) && $nurse_station->kecelakaan_kerja )
								@include('periksas.kecelakaan_kerja')
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row hide">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('nurse_station_id'))has-error @endif">

					@if( isset($periksa) )
						{!! Form::text('nurse_station_id', $periksa->nurse_station_id, array(
							'class'         => 'form-control rq'
						))!!}
					@else
						{!! Form::text('nurse_station_id', $nurse_station->id, array(
							'class'         => 'form-control rq'
						))!!}
					@endif
				  @if($errors->has('nurse_station_id'))<code>{{ $errors->first('nurse_station_id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row hide">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('waktu_periksa'))has-error @endif">
				  {!! Form::label('waktu_periksa', 'Waktu Periksa', ['class' => 'control-label']) !!}
					{!! Form::textarea('waktu_periksa', date('Y-m-d H:i:s'), array(
						'class'         => 'form-control textareacustom'
					))!!}
				  @if($errors->has('waktu_periksa'))<code>{{ $errors->first('waktu_periksa') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('anamnesa'))has-error @endif">
				  {!! Form::label('anamnesa', 'Anamnesis', ['class' => 'control-label']) !!}
					{!! Form::textarea('anamnesa', null, array(
						'class'         => 'form-control textareacustom rq'
					))!!}
				  @if($errors->has('anamnesa'))<code>{{ $errors->first('anamnesa') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('pemeriksaan_fisik'))has-error @endif">
				  {!! Form::label('pemeriksaan_fisik', 'Pemeriksaan Fisik', ['class' => 'control-label']) !!}
					{!! Form::textarea('pemeriksaan_fisik', null, array(
						'class'         => 'form-control textareacustom'
					))!!}
				  @if($errors->has('pemeriksaan_fisik'))<code>{{ $errors->first('pemeriksaan_fisik') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="form-group @if($errors->has('sistolik'))has-error @endif">
					{!! Form::label('sistolik', 'Sistolik', ['class' => 'control-label']) !!}
					  <div class="input-group">
							@if( isset($periksa) )
								{!! Form::text('sistolik', $periksa->sistolik, array(
									'class'         => 'form-control'
								))!!}
							@else
								{!! Form::text('sistolik', $nurse_station->sistolik, array(
									'class'         => 'form-control'
								))!!}
							@endif
						<span class="input-group-addon"> / </span>
					  </div>
					@if($errors->has('sistolik'))<code>{{ $errors->first('sistolik') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="form-group @if($errors->has('diastolik'))has-error @endif">
					{!! Form::label('diastolik', 'Diastolik', ['class' => 'control-label']) !!}
					  <div class="input-group">
						@if( isset($periksa) )
							{!! Form::text('diastolik', $periksa->diastolik, array(
								'class'         => 'form-control'
							))!!}
						@else
							{!! Form::text('diastolik', $nurse_station->diastolik, array(
								'class'         => 'form-control'
							))!!}
						@endif
						<span class="input-group-addon"> mmHg </span>
					  </div>
					@if($errors->has('diastolik'))<code>{{ $errors->first('diastolik') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="form-group @if($errors->has('berat_badan'))has-error @endif">
					{!! Form::label('berat_badan', 'Berat Badan', ['class' => 'control-label']) !!}
					  <div class="input-group">
							@if( isset($periksa) )
								{!! Form::text('berat_badan', $periksa->berat_badan, array(
									'class'         => 'form-control'
								))!!}
							@else
								{!! Form::text('berat_badan', $nurse_station->berat_badan, array(
									'class'         => 'form-control'
								))!!}
							@endif
						<span class="input-group-addon">kg</span>
					  </div>
					@if($errors->has('berat_badan'))<code>{{ $errors->first('berat_badan') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="form-group @if($errors->has('hamil'))has-error @endif">
					{!! Form::label('hamil', 'Hamil', ['class' => 'control-label']) !!}
					@if( isset($periksa) )
						{!! Form::select('hamil', App\Yoga::yesNoList('Hamil'), $periksa->hamil, array(
							'class'         => 'form-control rq'
						))!!}
					@else
						{!! Form::select('hamil', App\Yoga::yesNoList('Hamil'), $nurse_station->hamil, array(
							'class'         => 'form-control rq'
						))!!}
					@endif
					@if($errors->has('hamil'))<code>{{ $errors->first('hamil') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<div class="form-group @if($errors->has('hamil'))has-error @endif">
					{!! Form::label('penunjang', '', ['class' => 'control-label']) !!}
					<button class="btn btn-primary" onclick="showPenunjangTindakan();return false;" type='button'><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Input Penunjang dan Tindakan</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('diagnosa_id'))has-error @endif">
				  {!! Form::label('diagnosa_id', 'Diagnosa', ['class' => 'control-label']) !!}
					<a href="" class="" aria-controls="diagnosa" onclick="showDiagnosaTab();return false;">Tidak dapat menemukan diagnosa?</a>
						@if(isset($periksa))
							{!! Form::select('diagnosa_id', [ $periksa->diagnosa_id => $periksa->diagnosa->diagnosa . ' (' . $periksa->diagnosa->icd_id . ' - ' . $periksa->diagnosa->icd->diagnosaICD . ')' ], $periksa->diagnosa_id, array(
								'id'    => 'diagnosa_ajax_search',
								'class' => 'form-control rq'
							))!!}
						@else
							{!! Form::select('diagnosa_id', [], null, array(
								'id'    => 'diagnosa_ajax_search',
								'class' => 'form-control rq'
							))!!}
						@endif
				  @if($errors->has('diagnosa_id'))<code>{{ $errors->first('diagnosa_id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('keterangan_diagnosa'))has-error @endif">
				  {!! Form::label('keterangan_diagnosa', 'Keterangan Diagnosa / dd / Diagnosa Lain', ['class' => 'control-label']) !!}
					{!! Form::text('keterangan_diagnosa', null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('keterangan_diagnosa'))<code>{{ $errors->first('keterangan_diagnosa') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				@if(isset($daftar))
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Terapi</button>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a class="btn btn-danger btn-block" href="{{ url('home/daftars') }}">Cancel</a>
					</div>
				@else
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Terapi</button>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<a class="btn btn-danger btn-block" href="{{ url('home/pasiens') }}">Cancel</a>
					</div>
				@endif
				{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
	{{-- </div> --}}
