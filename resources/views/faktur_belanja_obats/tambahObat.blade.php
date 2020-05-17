<tr>
	<td>
		{!! Form::select('obat_id[]', App\Obat::selectList(), null, [
			'class'            => 'form-control selectpickers obat_id',
			'placeholder'      => '- Pilih Obat -',
			'onchange'      => 'changeObat(this); return false;',
			'data-live-search' => 'true',
		]) !!}
	</td>
	<td>

	  <div class="input-group">
		<span class="input-group-addon">Rp. </span>
		{!! Form::text('harga_beli[]', null, [
			'class' => 'form-control harga_beli',
			'onkeypress' => 'return isNumber(event)'
		]) !!}
	  </div>
	</td>
	<td>

	  <div class="input-group">
		<span class="input-group-addon">Rp. </span>
		{!! Form::text('harga_jual[]', null, [
			'class' => 'form-control harga_jual',
			'onkeypress' => 'return isNumber(event)'
		]) !!}
	  </div>
	</td>
	<td>
		{!! Form::text('exp_date[]', null, ['class' => 'form-control tanggal exp_date']) !!}
	</td>
	<td>
		{!! Form::text('jumlah[]', null, [
			'class' => 'form-control jumlah',
			'onkeypress' => 'return isNumber(event)'
		]) !!}
	</td>
	<td>
		<button disabled class="btn btn-primary action" type="button" onclick="tambahObat(this); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
	</td>
</tr>
