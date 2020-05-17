@extends('layout.master')

@section('title') 
	Online Electronic Medical Record | Pasien

@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Edit Profile</strong>
	  </li>
</ol>

@stop
@section('content') 

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit User Profile
				</div>
				<div class="panel-body">
					{!! Form::model($user,['url' => 'home/users/' . $user->id, 'method' => 'put']) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('name'))has-error @endif">
								  {!! Form::label('name', 'Nama Klinik', ['class' => 'control-label']) !!}
									{!! Form::text('name', null, array(
										'class'         => 'form-control rq'
									))!!}
								  @if($errors->has('name'))<code>{{ $errors->first('name') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('alamat'))has-error @endif">
								  {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
									{!! Form::textarea('alamat', null, array(
										'class'         => 'form-control textareacustom rq'
									))!!}
								  @if($errors->has('alamat'))<code>{{ $errors->first('alamat') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('no_telp'))has-error @endif">
								  {!! Form::label('no_telp', 'Nomor Telepon', ['class' => 'control-label']) !!}
									{!! Form::text('no_telp', null, array(
										'class'         => 'form-control rq'
									))!!}
								  @if($errors->has('no_telp'))<code>{{ $errors->first('no_telp') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('email'))has-error @endif">
								  {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
									{!! Form::text('email', null, array(
										'class'         => 'form-control rq'
									))!!}
								  @if($errors->has('email'))<code>{{ $errors->first('email') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('password'))has-error @endif">
								  {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password : Kosongkan jika tidak ingin diubah">
								  @if($errors->has('password'))<code>{{ $errors->first('password') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group @if($errors->has('password_confirmation'))has-error @endif">
								  {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'control-label']) !!}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation : Kosongkan jika tidak ingin diubah">
									{{-- {!! Form::text('password_confirmation', null, array( --}}
									{{-- 	'class'         => 'form-control rq' --}}
									{{-- ))!!} --}}
								  @if($errors->has('password_confirmation'))<code>{{ $errors->first('password_confirmation') }}</code>@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
								{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
								<a class="btn btn-danger btn-block" href="{{ url('home') }}">Cancel</a>
							</div>
						</div>
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
	
@stop
@section('footer') 
	
<script type="text/javascript" charset="utf-8">
	function dummySubmit(control){
		if(validatePass2(control)){
			$('#submit').click();
		}
	}
</script>
@stop

