<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<div class="panel panel-default">
			<div class="panel-body">
				@include('periksas.imagePasien', ['model' => $nurse_station->pasien, 'temp' => 'image'])
				<h1>{{ $nurse_station->pasien->nama }}</h1>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1>Resep</h1>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table width="100%" id="resep" class="table table-hover table-condensed">

				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
										'class' => 'form-control select2'
									))!!}
								  @if($errors->has('nama_obat'))<code>{{ $errors->first('nama_obat') }}</code>@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<div class="form-group @if($errors->has('jumlah'))has-error @endif">
									{!! Form::text('jumlah', null, array(
										'class'       => 'form-control jumlah disableEnter',
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
									{!! Form::select('signa', [], null, array(
										'class'            => 'form-control signa',
										'id'               => 'signa'
									))!!}
									{{-- <a href="" class="" aria-controls="signa" onclick="showSignaTab();return false;">Signa tidak ketemu?</a> --}}
								  @if($errors->has('signa'))<code>{{ $errors->first('signa') }}</code>@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group @if($errors->has('aturan_minum'))has-error @endif">
									{!! Form::select('aturan_minum', [], null, array(
										'class'            => 'form-control aturan_minum',
										'id'               => 'aturan_minum'
									))!!}
									{{-- <a href="" class="" aria-controls="signa" onclick="showAturanMinumTab();return false;">Aturan Minum tidak ketemu?</a> --}}
								  @if($errors->has('aturan_minum'))<code>{{ $errors->first('aturan_minum') }}</code>@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<button class="btn btn-success btn-sm btn-block" onclick="inputResep(this);return false;" type="button">Input</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>
			@if(isset($terapi))
				Update
			@else
				Submit
			@endif
		</button>
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block" href="{{ url('home/periksas/' . $nurse_station->periksa_id . '/edit') }}">Kembali ke Periksa</a>
	</div>
</div>
<textarea id="json_container" class="hide">{{ $json_terapi }}</textarea>
