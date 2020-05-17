<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
		Online Electronic Medical Record | Login
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') !!}" rel="stylesheet">
    {!! HTML::style('css/animate.css')!!}
    {!! HTML::style('css/style.css')!!}
  {{--   <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> --}}

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">EMR+</h1>

            </div>
            <h3>Selamat Datang di {{ env("NAMA_KLINIK") }}</h3>
            <p>Silahkan masukkan email dan password dengan benar.</p>

            {!! Form::open(array('url' => 'login', 'class' => 'm-t', 'method' => 'post')) !!}

				<div class="form-group @if($errors->has('email'))has-error @endif">
                    {!! Form::email('email', null, array('class'=>'form-control', 'placeholder' => 'email', 'autocomplete' => 'false'))!!}
                </div>
				<div class="form-group @if($errors->has('password'))has-error @endif">
                    {!! Form::password('password',  array('placeholder' => 'password', 'class'=>'form-control', 'autocomplete' => 'false'))!!}
                </div>
                <div class="form-group row">
					<div class="col-lg-4 col-md-4 offset-md-4">
						{!! Form::submit('Login', array('class' => 'btn btn-sm btn-primary btn-block'))!!}
					</div>
					<div class="col-md-8 offset-md-4">
						@if (Route::has('password.request'))
							<a class="" href="{{ route('password.request') }}">
								{{ __('Lupa Password') }}
							</a>
						@endif
					</div>
				</div>
            {!! Form::close() !!}

            <p><a href="{{ url('register') }}">Klik Disini</a> untuk membuat akun baru</p> 

           @if(\Session::has('pesan'))
                <p class="m-t"> <code> {!! \Session::get('pesan') !!}</code> </p>
            @endif
        </div>
    </div>

    <!-- Mainly scripts -->

    {!! HTML::script('js/jquery-2.1.1.js')!!}
    {!! HTML::script('js/bootstrap.min.js')!!}

</body>

</html>
