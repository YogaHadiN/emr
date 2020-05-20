@if(  Storage::cloud()->has( $pasien->$temp )  )
	<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( $pasien->$temp ) }}?{{ strtotime('now') }}" alt="" />
@else
	<img id="pasien_image" class="full-width" src="{{ url('img/photo_not_available.png') }}" alt="" />
@endif
