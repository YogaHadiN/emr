<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr>
			<td>
				<strong>Anamnesis</strong>	
			</td>
			<td>
				{{ $nurse_station->periksa->anamnesa }}	
			</td>
		</tr>
			<tr>
			<td>
				<strong>Pemeriksaan Fisik</strong>
			</td>
			<td>
				{{ $nurse_station->periksa->pemeriksaan_fisik }}	
			</td>
		</tr>
		<tr>
			<td>
			<strong>Penunjang & Tindakan</strong>
			</td>
			<td>
				<ul>
					@foreach($nurse_station->transaksi as $transaksi)	
						<li>{{ $transaksi->tarif->jenisTarif->jenis_tarif }} : {{ $transaksi->keterangan_pemeriksaan }}</li>	
					@endforeach
				</ul>
				
			</td>
		</tr>
		<tr>
			<td>
			<strong>Diagnosa</strong>
			</td>
			<td>
				{{ $nurse_station->periksa->diagnosa->diagnosa }}	
			</td>
		</tr>
		<tr>
			<td>
			<strong>Diagnosa ICD</strong>
			</td>
			<td>
				{{ $nurse_station->periksa->diagnosa->icd_id }} | {{ $nurse_station->periksa->diagnosa->icd->diagnosaICD }}	
			</td>
		</tr>
	</tbody>
</table>
