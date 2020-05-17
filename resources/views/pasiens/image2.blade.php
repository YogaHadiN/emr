<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
{{ env("APP_NAME") }} | Gambar Periksais
</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') !!}" rel="stylesheet">
	<link href="{!! asset('css/all.css') !!}" rel="stylesheet">
</head>

<body class="gray-bg">

<h2>Gambar Periksa</h2>
	{!! Form::open([
		'url'		=> 'pasiens/home/images/' . $random_string, 
		'method'	=> 'post', 
		'files'		=> 'true'
	]) !!}
		@include('images.form')
	{!! Form::close() !!}
	{{-- @include('gambar_periksa') --}}

    <!-- Mainly scripts -->

	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	{!! HTML::script('js/all.js')!!} 

<script type="text/javascript" charset="utf-8">
	{{-- $(window).bind('load', function() { --}}
	{{-- 	$('img').each(function() { --}}
	{{-- 		if((typeof this.naturalWidth != "undefined" && --}}
	{{-- 			this.naturalWidth == 0 ) --}} 
	{{-- 			|| this.readyState == 'uninitialized' ) { --}}
	{{-- 			$(this).attr('src', '{{ url('/') }}' + '/img/photo_not_available.png'); --}}
	{{-- 		} --}}
	{{-- 	}); --}} 
	{{-- }) --}}
	tambahGambar();
	function dummySubmit(){
		 $('#submit').click();
	}
	$('img').each(function() {
		if((typeof this.naturalWidth != "undefined" &&
			this.naturalWidth == 0 ) 
			|| this.readyState == 'uninitialized' ) {
			$(this).attr('src', url + '/img/photo_not_available.png');
		}
	}); 
</script>
	{!! HTML::script('js/gambar_periksa.js')!!} 
	{!! HTML::script('js/inputGambar.js')!!} 
</body>

</html>
