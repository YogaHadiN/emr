<tr>
	<td>
		{{ date('d-m-Y H:i:s', strtotime($periksa->waktu_datang))   }}
		<br />
		<br />
		<strong>Pemeriksa :</strong>  <br />
		{{ $periksa->staf->nama }}
		<br />
		<strong>Pembayaran :</strong>
		 <br />
		{{ $periksa->asuransi->nama_asuransi }}
		<br />
		<br />
		<a class="btn btn-info btn-sm" target="_blank" href="{{ url('home/periksas/'. $periksa->id .'/status/pdf') }}">Status PDF</a>


	</td>
	<td>
		<strong>Anamnesis : </strong> <br />
		{{ $periksa->anamnesa }} <br />
		<br />
		<strong>Pemeriksaan Fisik : </strong> <br />
		{{ $periksa->pemeriksaan_fisik }} <br />
		<br />
		<strong>Pemeriksaan Penunjang  / Tindakan: </strong> <br />
		<ul>
			
			@foreach($periksa->transaksiPeriksa as $tindakan)	
				<li>{{ $tindakan->tarif->jenisTarif->jenis_tarif}} : {{ $tindakan->keterangan_pemeriksaan }}</li>
			@endforeach
			
		</ul>
		<strong>Diagnosa : </strong> <br />
		{{ $periksa->diagnosa->diagnosa }} (<strong>{{ $periksa->diagnosa->icd_id }}</strong>  | {{ $periksa->diagnosa->icd->diagnosaICD }})
		<br />
		{{ $periksa->keterangan_diagnosa }}

	</td>
	<td nowrap class="autofit">
		{!! $periksa->terapi_temp !!}
	</td>
</tr>
