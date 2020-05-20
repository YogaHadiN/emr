@if(  Storage::cloud()->has( 'pasiens/pasien' . $pasien_id . '.jpg' )  )
	<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( 'pasiens/pasien' . $pasien_id . '.jpg' ) }}" alt="" />
@else
	<img id="pasien_image" class="full-width" src="{{ url('img/photo_not_available.png') }}" alt="" />
@endif
