<tr>
	<td>
			{!! Form::select('tindakans[]', $tarif_selection, $tarif_id, [
				'class'            => 'form-control tarif_select',
				'placeholder'      => '- Pilih Tindakan -',
				'onchange'         => 'tarifSelectChange(this);return false;',
				'data-live-search' => 'true'
			]) !!}
	</td>
	<td>
		{!! Form::text('keterangan_tindakans[]', $keterangan, ['class' => 'form-control']) !!}
	</td>
	<td class="action">
		@if( isset($tindakan) && isset($k) && $k == count($tindakans) -1  )
			<button class="btn btn-danger btn-sm" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		@else
			<button class="btn btn-primary btn-sm" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
			<button class="btn btn-danger btn-sm" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		@endif
	</td>
</tr>
