<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('merek'))has-error @endif">
				  {!! Form::label('merek', 'Merek Obat', ['class' => 'control-label']) !!}
					{!! Form::text('merek', null, array(
						'class'         => 'form-control rq',
						'placeholder'         => 'Merek tanpa bobot dan satuan contoh : Loratadine',
					))!!}
				  @if($errors->has('merek'))<code>{{ $errors->first('merek') }}</code>@endif
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('fornas'))has-error @endif">
				  {!! Form::label('fornas', 'Fornas', ['class' => 'control-label']) !!}
				  {!! Form::select('fornas', [ 0 => 'Bukan Fornas' , 1 => 'Fornas' ] ,null, array(
						'class'         => 'form-control rq selectpick',
						'placeholder'         => ' - Pilih Fornas -',
					))!!}
				  @if($errors->has('fornas'))<code>{{ $errors->first('fornas') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('tidak_dipuyer'))has-error @endif">
				  {!! Form::label('tidak_dipuyer', 'Dipuyer', ['class' => 'control-label']) !!}
				  {!! Form::select('tidak_dipuyer', [ null => '- Harap Diisi -', 0 => 'Dipuyer' , 1=>'Tidak Dipuyer' ], null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('tidak_dipuyer'))<code>{{ $errors->first('tidak_dipuyer') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('sediaan'))has-error @endif">
				  {!! Form::label('sediaan', 'Sediaan', ['class' => 'control-label']) !!}
				  {!! Form::select('sediaan', App\Sediaan::selectList(), null, [
						'class'       => 'form-control rq selectpick',
						'placeholder' => '- Sediaan -'
					]) !!}
				  @if($errors->has('sediaan'))<code>{{ $errors->first('sediaan') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('aturan_minum_id'))has-error @endif">
				  {!! Form::label('aturan_minum_id', 'Aturan Minum', ['class' => 'control-label']) !!}
				  {!! Form::select('aturan_minum_id', App\AturanMinum::selectList(), null, 
						  [
							  'class'            => 'form-control rq selectpick',
							  'placeholder'      => '- Pilih Aturan Minum -',
							  'data-live-search' => 'true'
						  ]
				  )!!}
				  @if($errors->has('aturan_minum_id'))<code>{{ $errors->first('aturan_minum_id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('peringatan'))has-error @endif">
				  {!! Form::label('peringatan', 'Peringatan', ['class' => 'control-label']) !!}
					{!! Form::textarea('peringatan', null, array(
						'class'         => 'form-control textareacustom'
					))!!}
				  @if($errors->has('peringatan'))<code>{{ $errors->first('peringatan') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('verified'))has-error @endif">
				  {!! Form::label('verified', 'Verified', ['class' => 'control-label']) !!}
				  @if( isset($obat) )
					{!! Form::select('verified',[  0 => 'Belum Verified' , 1=>'Verified' ], null, array(
						'class'         => 'form-control rq'
					))!!}
				  @else
					{!! Form::select('verified',[  0 => 'Belum Verified' , 1=>'Verified' ], 0, array(
						'class'         => 'form-control rq'
					))!!}
				  @endif
				  @if($errors->has('verified'))<code>{{ $errors->first('verified') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('tidak_dipuyer'))has-error @endif">
				  {!! Form::label('komposisi', 'Komposisi', ['class' => 'control-label']) !!}
				  @if($errors->has('komposisi'))<code>{{ $errors->first('komposisi') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<tbody>
					@include('obats.komposisi')
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				@if(isset($obat))
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
				@else
					<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
				@endif
				{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/obats') }}">Cancel</a>
			</div>
		</div>
	</div>
</div>
<div class="table-responsive hide">
	<table class="table table-hover table-condensed table-bordered">
		<tbody id="komposisi_template">
			@include('obats.komposisi2')
		</tbody>
	</table>
</div>

