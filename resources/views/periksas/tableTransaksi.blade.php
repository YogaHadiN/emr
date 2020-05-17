
@if($transaksi->count() > 0)
	@foreach($nurse_station->transaksi as $transaksi)
		<tr>
			<td>{{ $transaksi->transaksi }}</td>
			<td>{{ $transaksi->keterangan_pemeriksaan }}</td>
		</tr>
	@endforeach
@else
	<tr>
		<td colspan="2" class="text-center">Belum ada tindakan / pemerikaan penunjang</td>
	</tr>
@endif
