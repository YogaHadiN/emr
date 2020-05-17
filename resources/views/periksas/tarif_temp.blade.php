	<table class="hide" >
		<tbody id="tarif_temp">
			@include('periksas.tindakan', [
				'tarif_id'    => null,
				'keterangan'    => null,
				'asuransi_id' => $nurse_station->asuransi_id
			])
		</tbody>
	</table>
