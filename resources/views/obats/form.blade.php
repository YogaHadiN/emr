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
				<div class="form-group @if($errors->has('exp_date'))has-error @endif">
				  {!! Form::label('exp_date', 'Expiry Date', ['class' => 'control-label']) !!}
				  {!! Form::text('exp_date', null, array(
					  'class'         => 'form-control rq tanggal'
				  ))!!}
				  @if($errors->has('exp_date'))<code>{{ $errors->first('exp_date') }}</code>@endif
				</div>
			</div>
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
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('harga_jual'))has-error @endif">
				  {!! Form::label('harga_jual', 'Harga Jual', ['class' => 'control-label']) !!}
				  <div class="input-group">
					<span class="input-group-addon">Rp. </span>
					{!! Form::text('harga_jual', null, array(
						'class'         => 'form-control rq'
					))!!}
				  </div>
				  @if($errors->has('harga_jual'))<code>{{ $errors->first('harga_jual') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('harga_beli'))has-error @endif">
				  {!! Form::label('harga_beli', 'Harga Beli', ['class' => 'control-label']) !!}
				  <div class="input-group">
					<span class="input-group-addon">Rp. </span>
					{!! Form::text('harga_beli', null, array(
						'class'         => 'form-control rq'
					))!!}
				  </div>
				  @if($errors->has('harga_beli'))<code>{{ $errors->first('harga_beli') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('kode_rak'))has-error @endif">
				  {!! Form::label('kode_rak', 'Kode Rak', ['class' => 'control-label']) !!}
					{!! Form::text('kode_rak', null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('kode_rak'))<code>{{ $errors->first('kode_rak') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('stok'))has-error @endif">
				  {!! Form::label('stok', 'Stok', ['class' => 'control-label']) !!}
					{!! Form::text('stok', null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('stok'))<code>{{ $errors->first('stok') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('stok_minimal'))has-error @endif">
				  {!! Form::label('stok_minimal', 'Stok Minimal', ['class' => 'control-label']) !!}
				  <div class="input-group">
					{!! Form::text('stok_minimal', null, array(
						'class'         => 'form-control rq'
					))!!}
					<span class="input-group-addon">pcs</span>
				  </div>
				  @if($errors->has('stok_minimal'))<code>{{ $errors->first('stok_minimal') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('dijual_bebas'))has-error @endif">
				  {!! Form::label('dijual_bebas', 'Dijual Bebas', ['class' => 'control-label']) !!}
				  {!! Form::select('dijual_bebas', [ null => '- Harap Diisi -', 0 => 'Tidak Dijual Bebas', 1 => 'Dijual Bebas' ], 1, ['class' => 'form-control']) !!}
				  @if($errors->has('dijual_bebas'))<code>{{ $errors->first('dijual_bebas') }}</code>@endif
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
						'class'         => 'form-control rq textareacustom'
					))!!}
				  @if($errors->has('peringatan'))<code>{{ $errors->first('peringatan') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('tidak_dipuyer'))has-error @endif">
				  {!! Form::label('tidak_dipuyer', 'Dipuyer', ['class' => 'control-label']) !!}
				  {!! Form::select('tidak_dipuyer', [ null => '- Harap Diisi -', 0 => 'Dipuyer' , 1=>'Tidak Dipuyer' ], null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('tidak_dipuyer'))<code>{{ $errors->first('tidak_dipuyer') }}</code>@endif
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="form-group @if($errors->has('verified'))has-error @endif">
				  {!! Form::label('verified', 'Verified', ['class' => 'control-label']) !!}
					{!! Form::select('verified',[  0 => 'Belum Verified' , 1=>'Verified' ], 0, array(
						'class'         => 'form-control rq'
					))!!}
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

