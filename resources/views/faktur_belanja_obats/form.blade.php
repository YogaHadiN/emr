<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('tanggal'))has-error @endif">
				  {!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
					{!! Form::text('tanggal', null, array(
						'class'         => 'form-control tanggal rq'
					))!!}
				  @if($errors->has('tanggal'))<code>{{ $errors->first('tanggal') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('staf_id'))has-error @endif">
				  {!! Form::label('staf_id', 'Nama Staf', ['class' => 'control-label']) !!}
					{!! Form::select('staf_id', App\Staf::selectList(), null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('staf_id'))<code>{{ $errors->first('staf_id') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('nomor_nota'))has-error @endif">
				  {!! Form::label('nomor_nota', 'Nomor Nota', ['class' => 'control-label']) !!}
					{!! Form::text('nomor_nota', null, array(
						'class'         => 'form-control'
					))!!}
				  @if($errors->has('nomor_nota'))<code>{{ $errors->first('nomor_nota') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('diskon'))has-error @endif">
				  {!! Form::label('diskon', 'Diskon', ['class' => 'control-label']) !!}
					{!! Form::text('diskon', '0', array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('diskon'))<code>{{ $errors->first('diskon') }}</code>@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group @if($errors->has('supplier_id'))has-error @endif">
				  {!! Form::label('supplier_id', 'Supplier', ['class' => 'control-label']) !!}
					{!! Form::select('supplier_id', App\Supplier::selectList(), null, array(
						'class'         => 'form-control rq'
					))!!}
				  @if($errors->has('supplier_id'))<code>{{ $errors->first('supplier_id') }}</code>@endif
				</div>
			</div>
		</div>
	</div>
</div>


<h1>Daftar Belanja Obat</h1>
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>Nama Obat</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
				<th>Exp Date</th>
				<th>Jumlah</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="tableObat">
			@include('faktur_belanja_obats.tambahObat')
		</tbody>
	</table>
</div>

<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		@if(isset($daftar))
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Update</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/daftars') }}">Cancel</a>
			</div>
		@else
			<button class="btn btn-success btn-block" type="button" onclick='dummySubmit(this);return false;'>Submit</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-danger btn-block" href="{{ url('home/pasiens') }}">Cancel</a>
			</div>
		@endif
		{!! Form::submit('Submit', ['class' => 'btn btn-success hide', 'id' => 'submit']) !!}
</div>
