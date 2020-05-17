<tr>
	<td>
		{!! Form::select('jenis_tarif_id[]', $jenis_tarif_list, $jenis_tarif_id, array(
			'class'            => 'form-control selectpickerKasir',
			'onchange'         => 'changeSelectTarif(this);return false;',
			'placeholder'      => '- Jenis Tarif -',
			'data-live-search' => 'true'
		))!!}
	</td>
	<td>
		<div class="input-group">
			<span class="input-group-addon">Rp. </span>
			@if( isset( $transaksi ) || isset($biaya_obat) )
				{!! Form::text('biaya[]', $biaya, array(
					'class'   => 'form-control biaya',
					'onkeyup' => 'biayaKeyUp();return false;'
				))!!}
			@else
				{!! Form::text('biaya[]', $biaya, array(
					'class'    => 'form-control biaya',
					'disabled' => 'disabled',
					'onkeyup'  => 'biayaKeyUp();return false;'
				))!!}
			@endif
		</div>
	</td>
	<td>
		@if(
			( isset($biaya_obat) || 
			( isset($biaya_obat) && isset( $transaksi ) && $transaksi->tarif->jenis_tarif_id == 9 )|| 
			( isset($biaya_obat) && isset( $transaksi ) && $transaksi->tarif->jenis_tarif_id == 1 ) )
			)
			<button class="btn btn-danger btn-sm" type="button" onclick="delTarif(this); return false;" disabled><span class="glyphicon glyphicon-minus"  aria-hidden="true"></span></button>	
		@elseif( !isset( $transaksi )  )
			<button class="btn btn-success btn-sm" disabled type="button" onclick="tambahTarif(this); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>	
		@elseif( isset($k) && ( $k == $kasir->periksa->transaksiPeriksa->count() - 1 ) )
			<button class="btn btn-success btn-sm" type="button" onclick="tambahTarif(this); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>	
		@else
			<button class="btn btn-danger btn-sm" type="button" onclick="delTarif(this); return false;"><span class="glyphicon glyphicon-minus"  aria-hidden="true"></span></button>	
		@endif
	</td>
</tr>
