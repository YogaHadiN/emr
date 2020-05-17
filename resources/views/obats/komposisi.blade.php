	@if( isset( $obat ) )
		@foreach($obat->komposisi as $k => $komposisi)	
		<tr>
			<td width="50%">
				{!! Form::select('generik[]', App\Generik::selectList(), $komposisi->generik_id, [
					'class'            => 'form-control selectpick generik',
					'data-live-search' => 'true',
					'placeholder'      => 'Generik'
				]) !!}
			</td>
			<td width="40%">
				{!! Form::text('bobot[]', $komposisi->bobot, array(
					'class'       => 'form-control bobot',
					'placeholder' => 'bobot'
				))!!}
			</td>
			@if( $k == $obat->komposisi->count() -1 )
				<td width="10%">
					<button class="btn btn-success btn-sm btn-block" type="button" onclick="tambahKomposisi(this);return false">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</button>
				</td>
			@else
				<td width="10%">
					<button class="btn btn-danger btn-sm btn-block" type="button" onclick="delKomposisi(this);return false">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
				</td>
			@endif
		</tr>
		@endforeach
	@else
		<tr>
			<td width="50%">
				{!! Form::select('generik[]', App\Generik::selectList(), null, [
					'class'            => 'form-control selectpick generik',
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
					'class'            => 'form-control selectpick satuan',
					'data-live-search' => 'true',
					'placeholder'      => '- Pilih Satuan -'
				]) !!}
			</td>
			<td width="10%">
				<button class="btn btn-success btn-sm btn-block" type="button" onclick="tambahKomposisi(this);return false">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</td>
		</tr>
	@endif
</tr>
