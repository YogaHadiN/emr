@if ($temp == 'ktp_image')
	{{-- {{ dd('this') }} --}}
	{{-- {{ dd( $model->ktp_image  ,$model->image, $temp) }} --}}
@endif
{{-- {{ dd(  Storage::cloud()->has( $model->$temp ) , Storage::cloud()->url( $model->$temp ) ,$model->image, $temp) }} --}}
@if(  Storage::cloud()->has( $model->$temp )  )
	<img id="pasien_image" class="full-width" src="{{ Storage::cloud()->url( $model->$temp ) }}" alt="" />
@else
	<img id="pasien_image" class="full-width" src="{{ url('img/photo_not_available.png') }}" alt="" />
@endif
