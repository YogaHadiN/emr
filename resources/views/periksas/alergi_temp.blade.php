@if($periksa->pasien->alergi->count() > 0)
	@foreach($periksa->pasien->alergi as $alergi)
		<tr>
			<td class="hide id">{{ $alergi->id }}</td>
			<td class="hide generik_id">{{ $alergi->generik_id }}</td>
			<td class="generik">{{ $alergi->generik->generik }}</td>
			<td nowrap class="autofit">
				<button type="button" class="btn btn-danger" onclick="removeAlergi(this);return false;"> <span class="glyphicon glyphicon-remove" aria-hidden="true"> </span> Delete</button>
			</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="2" class="text-center">Tidak ada data alergi</td>
	</tr>
@endif
