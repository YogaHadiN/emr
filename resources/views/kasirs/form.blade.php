<div class="row hide">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('periksa_id'))has-error @endif">
		  {!! Form::label('periksa_id', 'Periksa Id', ['class' => 'control-label']) !!}
		  {!! Form::text('periksa_id', $kasir->periksa_id, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('periksa_id'))<code>{{ $errors->first('periksa_id') }}</code>@endif
		</div>
	</div>
</div>
<div class="row hide">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('kasir_id'))has-error @endif">
		  {!! Form::label('kasir_id', 'Kasir Id', ['class' => 'control-label']) !!}
		  {!! Form::text('kasir_id', $kasir->id, array(
				'class'         => 'form-control rq'
			))!!}
		  @if($errors->has('kasir_id'))<code>{{ $errors->first('kasir_id') }}</code>@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				@include('periksas.imagePasien', ['model' => $kasir->periksa->pasien, 'temp' => 'image'])
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h1>{{ $kasir->periksa->pasien->nama }}</h1>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<tbody>
					<tr>
						<td>
							<strong>Pembayaran</strong>	
						</td>
						<td>
							{{ $kasir->periksa->asuransi->nama_asuransi }}	
						</td>
					</tr>
					<tr>
						<td>
						<strong>Pemeriksa</strong>
						</td>
						<td>
							{{ $kasir->periksa->staf->nama }}	
						</td>
					</tr>
					<tr>
						<td>
						<strong>Nurse Station</strong>	
						</td>
						<td>
							@if(isset( $kasir->periksa->asisten->nama))
								{{ $kasir->periksa->asisten->nama}}	
							@endif
						</td>
					</tr>
					@if( isset($periksa) && $periksa->kecelakaan_kerja )
						@include('periksas.kecelakaan_kerja')
					@elseif( !isset($periksa) && $kasir->periksa->kecelakaan_kerja )
						@include('periksas.kecelakaan_kerja')
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h1>Total</h1>
		<div id="total_biaya" class="font-super-big-without-padding">
			{{ App\Yoga::buatrp( $total_biaya ) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Merek</th>
						<th>Jumlah</th>
						<th>Harga Satuan</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					@if($kasir->periksa->terapis->count() > 0)
						@foreach($kasir->periksa->terapis as $terapi)
							<tr>
								<td>{{ $terapi->obat->merek }}</td>
								<td class="text-right">{{ $terapi->jumlah }}</td>
								<td class="text-right" nowrap>{{ App\Yoga::buatrp( $terapi->obat->harga_jual) }}</td>
								<td class="text-right" nowrap>{{ App\Yoga::buatrp( $terapi->obat->harga_jual * $terapi->jumlah ) }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="">
								{!! Form::open(['url' => 'periksa->terapis/imports', 'method' => 'post', 'files' => 'true']) !!}
									<div class="form-group">
										{!! Form::label('file', 'Data tidak ditemukan, upload data?') !!}
										{!! Form::file('file') !!}
										{!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'submit']) !!}
									</div>
								{!! Form::close() !!}
							</td>
						</tr>
					@endif
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" class="text-right">
							<h2>
								{{ App\Yoga::buatrp( $total_biaya_obat )}}
							</h2>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		
	</div>
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="table-responsive">
			<table id="tabel_nota" class="table table-hover table-condensed table-bordered" id="tarif_container">
				<thead>
					<tr>
						<th>Tarif</th>
						<th>Biaya</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@include('kasirs.selectJenisTarif', ['jenis_tarif_id' => 9, 'biaya' => $total_biaya_obat, 'biaya_obat' => true])
					@if($kasir->periksa->transaksiPeriksa->count() > 0)
						@foreach($kasir->periksa->transaksiPeriksa as $k => $transaksi)
							@include('kasirs.selectJenisTarif', ['jenis_tarif_id' => $transaksi->tarif->jenis_tarif_id, 'biaya' => $transaksi->tarif->biaya])
						@endforeach
					@else
						<tr>
							<td colspan="3" class="text-center">Tidak ada data untuk ditampilkan</td>
						</tr>
					@endif
						<tr>
							<td>Pembayaran</td>
							<td> 

								<div class="input-group">
									<span class="input-group-addon">Rp. </span>
									{!! Form::text('pembayaran', null, [
										'class'   => 'form-control',
										'id'      => 'pembayaran',
										'onkeyup' => 'biayaKeyUp(); return false;',
									]) !!}
								</div>
							</td>
						</tr>
						<tr>
							<td>Kembalian</td>
							<td> 
								<div class="input-group">
									<span class="input-group-addon">Rp. </span>
									{!! Form::text('kembalian', null, [
										'class'    => 'form-control',
										'id'       => 'kembalian',
										'readonly' => 'readonly'
									]) !!}
								</div>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button class="btn btn-success btn-block btn-lg" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<a class="btn btn-danger btn-block btn-lg" href="{{ url('home/kasirs') }}">Cancel</a>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script>

