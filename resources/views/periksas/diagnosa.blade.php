<h1>Buat Diagnosa Baru</h1>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group @if($errors->has('icd_10'))has-error @endif">
		  {!! Form::label('icd_10', 'ICD 10', ['class' => 'control-label']) !!}
			{!! Form::select('icd_10', [], null, array(
				'id' => 'icd_ajax_search',
				'onchange' => 'buatDiagnosa(this);return false;',
				'class' => 'form-control'
			))!!}
		  @if($errors->has('icd_10'))<code>{{ $errors->first('icd_10') }}</code>@endif
		</div>
	</div>
</div>
<div class="row hide" id="diagnosa_entry">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="diagnosa_ada hide">
			<h2>Pilih Diagnosa Yang Ada</h2>
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<tbody id="diagnosaContainer">

					</tbody>
				</table>
			</div>
			<h2>Atau</h2>
		</div>
		<div class="form-group @if($errors->has('buat_baru')) has-error @endif">
			  {!! Form::label('buat_baru', 'Buat Diagnosa Baru', ['class' => 'control-label']) !!}
			  {!! Form::text('buat_baru' , null, ['class' => 'form-control']) !!}
			  @if($errors->has('buat_baru'))<code>{{ $errors->first('buat_baru') }}</code>@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button onclick="diagnosaBaru(this); return false;" id="button_submit" type="button" class="btn btn-primary btn-block disabled">Submit</button>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<button onclick="kembali(); return false;" type="button" class="btn btn-danger btn-block">Cancel</button>
	</div>
</div>

