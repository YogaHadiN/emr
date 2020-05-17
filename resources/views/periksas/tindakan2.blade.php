<tr>
	<td>
		@if( isset($tindakan) )
			{!! Form::select('tindakans[]', App\Tarif::selectList( $asuransi_id ), $tindakan->tarif_id, [
				'class'            => 'form-control tarif_select',
				'placeholder'      => '- Pilih Tindakan -',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'data-live-search' => 'true'
			]) !!}
		@else
			{!! Form::select('tindakans[]', App\Tarif::selectList( $asuransi_id ), App\Tarif::where('user_id', Auth::id())->where('jenis_tarif_id', 1)->first()->id, [
				'class'            => 'form-control tarif_select',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'placeholder'      => '- Pilih Tindakan -',
				'data-live-search' => 'true'
			]) !!}
		@endif
	</td>
	<td>
		{!! Form::text('keterangan_tindakans[]', null, ['class' => 'form-control']) !!}
	</td>
	<td>
		<button class="btn btn-primary btn-sm disabled" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</td>
</tr>
