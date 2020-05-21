<h2>Buat Signa</h2>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="input-group">
			{!! Form::text('signa_text', null, array(
				'id'          => 'signa_text',
				'class'       => 'form-control',
				'placeholder' => 'Masukkan Signa Baru... '
			))!!}
			<div class="input-group-btn">
			  <button class="btn btn-info" onclick="submitSigna(this);return false;" type="button">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
					Submit
			  </button>
			</div>
		</div>
	</div>
</div>

