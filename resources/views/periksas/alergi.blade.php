<h1>Daftar Alergi Obat</h1>
@if(isset($periksa))
	<input type="text" class="hide" id="pasien_id" value="{{ $periksa->pasien_id  }}" />
@else
	<input type="text" class="hide" id="pasien_id "value="{{ $nurse_station->pasien_id  }}" />
@endif
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th class="hide">ID</th>
						<th>Nama Generik</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id='alergi_container'>
					@if(isset($periksa))
						@include('periksas.alergi_temp')
					@else
						@include('periksas.alergi_temp', ['periksa' => $nurse_station])
					@endif
				</tbody>
				<tfoot>
					<tr>
						<td>
							{!! Form::select('generik_id', [], null, [
								'class'    => 'form-control',
								'onchange' => 'changeGenerik(this);return false;',
								'id'       => 'select_generik_id'
							]) !!}
						</td>
						<td>
							<button type="button"id="submit_alergi" class="disabled btn btn-primary" onclick="submitAlergi(this);return false;"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Submit</button>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<button onclick="kembali(); return false;" type="button" class="btn btn-warning btn-block">Kembali ke Terapi</button>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<button onclick="kembali(); return false;" type="button" class="btn btn-danger btn-block">Kembali ke Periksa</button>
			</div>
		</div>
	</div>
</div>
