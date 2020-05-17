<div class="barcode">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<button class="btn btn-info btn-block" type="button" onclick='refresh();return false;'>Refresh</button>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<a href="{{ $url }}/{{ $random_string }}">
					<img src="{{ url('home/qrcode') }}/?text={{ $url }}/{{ $random_string }}"  alt="">
				</a>
		</div>
	</div>
</div>
