<h2>Buat {{ ucwords(str_replace ("_", " ", $table)) }}</h2>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="input-group">
			{!! Form::text($table . '_text', null, array(
				'id'          => $table .'_text',
				'class'       => 'form-control',
				'placeholder' => 'Masukkan ' .  ucwords(str_replace ("_", " ", $table)) . ' Baru... '
			))!!}
			<div class="input-group-btn">
			  <button class="btn btn-info" onclick="submit{{ str_replace(' ', '', ucwords(str_replace ("_", " ", $table)))  }}(this);return false;" type="button">
					<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
					Submit
			  </button>
			</div>
		</div>
	</div>
</div>

