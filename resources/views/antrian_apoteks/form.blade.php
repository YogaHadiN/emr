<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				@include('periksas.imagePasien', ['model' => $antrian_apotek->periksa->pasien, 'temp' => 'image'])
			</div>
		</div>
	</div>
</div>
<h1>{{ $antrian_apotek->periksa->pasien->nama }}</h1>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-66 col-lg-66">
		<table class="table table-hover table-condensed table-bordered">
			<tbody>
				<tr>
					<td>
						<strong>Anamnesis</strong>	
					</td>
					<td>
						{{ $antrian_apotek->periksa->anamnesa }}	
					</td>
				</tr>
					<tr>
					<td>
						<strong>Pemeriksaan Fisik</strong>
					</td>
					<td>
						{{ $antrian_apotek->periksa->pemeriksaan_fisik }}	
					</td>
				</tr>
				<tr>
					<td>
					<strong>Penunjang & Tindakan</strong>
					</td>
					<td>
						<ul>
							@foreach($antrian_apotek->periksa->transaksiPeriksa as $transaksi)	
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
						{{ $antrian_apotek->periksa->diagnosa->diagnosa }}	
					</td>
				</tr>
				<tr>
					<td>
					<strong>Diagnosa ICD</strong>
					</td>
					<td>
						{{ $antrian_apotek->periksa->diagnosa->icd_id }} | {{ $antrian_apotek->periksa->diagnosa->icd->diagnosaICD }}	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Key</th>
						<th>Obat</th>
						<th>Signa</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					@if(count($antrian_apotek->periksa->terapis, true) > 0)
						@foreach($antrian_apotek->periksa->terapis as $k => $terapi)
							<tr>
								<td class="key">{{ $k }}</td>
								<td class="obat_id">
									{!! Form::select('obat_id', $obat_list[ $terapi->obat->formula ], $terapi['obat_id'], [
										'class' => 'form-control',
										'onchange' => 'obatChange(this); return false;',
									]) !!}
								</td>
								<td>
									{!! Form::text('signa_id', $terapi->signa->signa, [
										'class'    => 'form-control',
										'disabled' => 'disabled'
									]) !!}
								</td>
								<td class="jumlah">
									{!! Form::text('jumlah', $terapi['jumlah'],  [
										'class' => 'form-control',
										'onkeyup' => 'jumlahChange(this);return false;'
									]) !!}
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4" class="text-center">Tidak ada data untuk ditampilkan</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		{!! Form::open(['url' => 'home/antrian_apoteks', 'method' => 'post']) !!}
		<div class="row hide">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('antrian_apotek_id'))has-error @endif">
				  {!! Form::label('antrian_apotek_id', 'Antrian Apotek Id', ['class' => 'control-label']) !!}
				  {!! Form::text('antrian_apotek_id', $antrian_apotek->id, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('antrian_apotek_id'))<code>{{ $errors->first('antrian_apotek_id') }}</code>@endif
				</div>
			</div>
		</div>
			<div class="row hide">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group @if($errors->has('terapi'))has-error @endif">
					  {!! Form::label('terapi', 'Terapi JSON', ['class' => 'control-label']) !!}
					  {!! Form::textarea('terapi', $antrian_apotek->periksa->terapi_apotek, array(
							'class' => 'form-control',
							'id'    => 'terapi_json'
						))!!}
					  @if($errors->has('terapi'))<code>{{ $errors->first('terapi') }}</code>@endif
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
					<a class="btn btn-danger btn-block" href="{{ url('home/antrian_apoteks') }}">Cancel</a>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
	function obatChange(control){
		var terapi            = $('#terapi_json').val();
		terapi                = JSON.parse(terapi);
		var key               = $(control).closest('tr').find('.key').html();
		var obat_id           = $(control).val();
		terapi[key]['obat_id'] = obat_id;
		var text              = $(control).find( "option:selected" ).text();
		terapi[key]['obat_text'] = text;
		$('#terapi_json').val(JSON.stringify(terapi));
		console.log(text);
	}
	function jumlahChange(control){
		var terapi           = $('#terapi_json').val();
		terapi               = JSON.parse(terapi);
		var key              = $(control).closest('tr').find('.key').html();
		var jumlah           = $(control).val();
		terapi[key]['jumlah'] = jumlah
		var text             = $(control).val();
		$('#terapi_json').val(JSON.stringify(terapi));
		console.log(text);
	}

</script>
