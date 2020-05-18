<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				{{-- @include('periksas.imagePasien', ['pasien_id' => $nurse_station->pasien_id]) --}}
			</div>
		</div>
	</div>
</div>
<h1>{{ $nurse_station->pasien->nama }}</h1>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-66 col-lg-66">
		<table class="table table-hover table-condensed table-bordered">
			<tbody>
				<tr>
					<td>
						<strong>Anamnesis</strong>	
					</td>
					<td>
						{{ $nurse_station->periksa->anamnesa }}	
					</td>
				</tr>
					<tr>
					<td>
						<strong>Pemeriksaan Fisik</strong>
					</td>
					<td>
						{{ $nurse_station->periksa->pemeriksaan_fisik }}	
					</td>
				</tr>
				<tr>
					<td>
					<strong>Penunjang & Tindakan</strong>
					</td>
					<td>
						<ul>
							@foreach($nurse_station->transaksi as $transaksi)	
								<li>{{ $transaksi->tarif->jenisTarif->jenis_tarif }} : {{ $transaksi->keterangan_pemeriksaan }}</li>	
							@endforeach
						</ul>
						
					</td>
				</tr>
				<tr>
					<td>
					<strong>Diagnosa</strong>
					</td>
					<td>
						{{ $nurse_station->periksa->diagnosa->diagnosa }}	
					</td>
				</tr>
				<tr>
					<td>
					<strong>Diagnosa ICD</strong>
					</td>
					<td>
						{{ $nurse_station->periksa->diagnosa->icd_id }} | {{ $nurse_station->periksa->diagnosa->icd->diagnosaICD }}	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<h1>Resep</h1>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<table width="100%" id="resep" class="table table-hover table-condensed">

		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body resepContainer">
				<div class="row hide">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group @if($errors->has('nurse_station_id'))has-error @endif">
						  {!! Form::label('nurse_station_id', 'Nurse Station', ['class' => 'control-label']) !!}
						  {!! Form::text('nurse_station_id', $nurse_station->id, array(
								'class'         => 'form-control rq'
							))!!}
						  @if($errors->has('nurse_station_id'))<code>{{ $errors->first('nurse_station_id') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group @if($errors->has('tipe_resep'))has-error @endif">
							{!! Form::select('tipe_resep', [ 1 => 'Standar', 2 => 'Add', 3 => 'Puyer' ], 1, array(
								'class'    => 'form-control selectpick',
								'onchange' => 'tipeResepChange(this);return false;',
								'id'       => 'tipe_resep'
							))!!}
							@if($errors->has('tipe_resep'))<code>{{ $errors->first('tipe_resep') }}</code>@endif
						</div>
						  <button id="kembaliResepStandar" style="display:none;" type="button" class="btn btn-danger btn-block" onclick="kembaliKeStandar();return false;">Cancel</button>
						  <button id="selesaikanPuyer" style="display:none;" type="button" class="btn btn-primary btn-block" onclick="endPuyer();return false;">Selesaikan</button>
						  <button id="selesaikanAdd" style="display:none;" type="button" class="btn btn-success btn-block" onclick="endAdd();return false;">Selesaikan</button>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('nama_obat'))has-error @endif">
							{!! Form::select('nama_obat', [], null , array(
								'id'    => 'nama_obat_ajax_search',
								'class' => 'form-control'
							))!!}
						  @if($errors->has('nama_obat'))<code>{{ $errors->first('nama_obat') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group @if($errors->has('jumlah'))has-error @endif">
							{!! Form::text('jumlah', null, array(
								'class'       => 'form-control selectpick jumlah disableEnter',
								'id'          => 'jumlah',
								'placeholder' => 'Jumlah'
							))!!}
						  @if($errors->has('jumlah'))<code>{{ $errors->first('jumlah') }}</code>@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group @if($errors->has('signa'))has-error @endif">
							<div class="input-group">
								{!! Form::select('signa', App\Signa::selectList(), null, array(
									'class'            => 'form-control selectpick signa',
									'data-live-search' => 'true',
									'placeholder'      => 'Signa',
									'id'               => 'signa'
								))!!}
								<span class="input-group-addon"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></span>
							</div>
						  @if($errors->has('signa'))<code>{{ $errors->first('signa') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group @if($errors->has('aturan_minum'))has-error @endif">
							<div class="input-group">
								{!! Form::select('aturan_minum', App\AturanMinum::selectList(), null, array(
									'class'            => 'form-control selectpick aturan_minum',
									'data-live-search' => 'true',
									'placeholder'      => 'Aturan Minum',
									'id'               => 'aturan_minum'
								))!!}
								<span class="input-group-addon"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></span>
							</div>
						  @if($errors->has('aturan_minum'))<code>{{ $errors->first('aturan_minum') }}</code>@endif
						</div>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<button class="btn btn-success btn-sm btn-block" onclick="inputResep(this);return false;" type="button">Input</button>
					</div>
					{!! Form::textarea('json_container', $json_terapi, ['class' => 'form-control hide', 'id' => 'json_container']) !!}
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button class="btn btn-success btn-block btn-lg" type="button" onclick='dummySubmit(this);return false;'>
			@if(isset($terapi))
				Update
			@else
				Submit
			@endif
		</button>
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('home/nurse_stations/' . $nurse_station->id . '/periksa') }}">Cancel</a>
	</div>
</div>
