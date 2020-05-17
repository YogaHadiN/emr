<tr>
	<td>
			{!! Form::select('tindakans[]', App\Tarif::selectList( $asuransi_id ), $tindakan->tarif_id, [
				'class'            => 'form-control tarif_select',
				'placeholder'      => '- Pilih Tindakan -',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'data-live-search' => 'true'
			]) !!}
	</td>
	<td>
		{!! Form::text('keterangan_tindakans[]', null, ['class' => 'form-control']) !!}
	</td>
	<td>
		<button class="btn btn-danger btn-sm" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
	</td>
</tr>
