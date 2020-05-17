@if(isset($periksa))
{!! Form::model($periksa,['url' => 'home/periksas/' . $periksa->id, 'method' => 'put']) !!}
@else
{!! Form::open(['url' => 'home/periksas', 'method' => 'post']) !!}
@endif
	@include('periksas.form')
{!! Form::close() !!}
@include('periksas.tarif_temp')
