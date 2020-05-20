<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="form-group @if($errors->has('pemeriksaan_penunjang'))has-error @endif">
	  {!! Form::label('pemeriksaan_penunjang', 'Pemeriksaan Penunjang/Tindakan', ['class' => 'control-label']) !!}
		@if( isset($periksa) )
			<a href="{{ url('home/transaksi_periksas/' . $periksa->nurse_station_id . '/create') }}">Tambah</a>
		@else
		@endif
	  <div class="table-responsive">
		<table class="table table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>Tindakan</th>
					<th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="tindakan_table">
				@if( $tindakans->count() )
					@foreach($tindakans as $k => $tindakan)	
						@include('periksas.tindakan', [
							'tarif_id'    => $tindakan->tarif_id,
							'keterangan'  => $tindakan->keterangan_pemeriksaan,
							'k'           => $k,
							'asuransi_id' => $periksa->asuransi_id
						])
					@endforeach
				@else
					@include('periksas.tindakan', [
						'tarif_id'    => $tarif_id_jasa_dokter,
						'keterangan'  => null,
						'asuransi_id' => $nurse_station->asuransi_id
					])
				@endif
			</tbody>
		</table>
	  </div>
	  @if($errors->has('pemeriksaan_penunjang'))<code>{{ $errors->first('pemeriksaan_penunjang') }}</code>@endif
	</div>
		<button onclick="kembali(); return false;" type="button" class="btn btn-danger btn-block">Kembali ke Periksa</button>
</div>
