<tr>
	@if( isset( $obat ) )
		<td width="50%">
			{!! Form::select('generik[]', App\Generik::selectList(), null, [
				'class'            => 'form-control generik',
				'data-live-search' => 'true',
				'placeholder'      => 'Generik'
			]) !!}
		</td>
		<td width="20%">
			{!! Form::text('bobot[]', null, array(
				'class'       => 'form-control bobot',
				'placeholder' => 'bobot'
			))!!}
		</td>
	@else
		<td width="50%">
			{!! Form::select('generik[]', App\Generik::selectList(), null, [
				'class'            => 'form-control generik',
				'data-live-search' => 'true',
				'placeholder'      => 'Generik'
			]) !!}
		</td>
		<td width="20%">
			{!! Form::text('bobot[]', null, array(
				'class'       => 'form-control bobot',
				'placeholder' => 'bobot'
			))!!}
		</td>
		<td width="20%">
			{!! Form::select('satuan[]', App\Satuan::selectList(), null, [
				'class'            => 'form-control satuan',
				'data-live-search' => 'true',
				'placeholder'      => '- Pilih Satuan -'
			]) !!}
		</td>
	@endif
	<td width="10%">
		<button class="btn btn-success btn-sm btn-block" type="button" onclick="tambahKomposisi(this);return false">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</button>
	</td>
</tr>
