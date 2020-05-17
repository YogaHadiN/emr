<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
{{ env("APP_NAME") }} | Gambar Pasien
</title>
    {!! HTML::style('css/all.css')!!}

</head>

<body class="gray-bg">

<h2>Gambar Pasien</h2>
	{!! Form::open([
		'url'		=> 'home/pasiens/image', 
		'method'	=> 'post', 
		'files'		=> 'true'
	]) !!}
	<div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
		{!! Form::label('gambar', 'Gambar') !!}
		{!! Form::file('gambar') !!}
			<p> {!! Html::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
		{!! $errors->first('gambar', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group{{ $errors->has('ktp') ? ' has-error' : '' }}">
		{!! Form::label('ktp', 'KTP') !!}
		{!! Form::file('ktp') !!}
			<p> {!! Html::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
		{!! $errors->first('ktp', '<p class="help-block">:message</p>') !!}
	</div>
	<div class="form-group{{ $errors->has('bpjs') ? ' has-error' : '' }}">
		{!! Form::label('bpjs', 'BPJS') !!}
		{!! Form::file('bpjs') !!}
			<p> {!! Html::image(asset('img/photo_not_available.png'), null, ['class'=>'img-rounded upload']) !!} </p>
		{!! $errors->first('bpjs', '<p class="help-block">:message</p>') !!}
	</div>
	{!! Form::text('random_string', $random_string, ['class' => 'form-control hide']) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@if(isset($pasien))
				<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			@else
				<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			@endif
			{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
		</div>
	</div>
	{!! Form::close() !!}
    <!-- Mainly scripts -->
	{!! HTML::script('js/all.js')!!} 
	<script type="text/javascript" charset="utf-8">
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
	</script>

<script type="text/javascript" charset="utf-8">
	tambahGambar();
	function dummySubmit(){
		 $('#submit').click();
	}
</script>
	{!! HTML::script('js/gambar_periksa.js')!!} 
	{!! HTML::script('js/inputGambar.js')!!} 
</body>

</html>
