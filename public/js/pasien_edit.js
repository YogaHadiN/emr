function dummySubmit(control){
	if( $('#asuransi_id').val() > 1 && $('#nomor_asuransi').val()== ''){
		alert('jika pasien memiliki asuransi, maka nomor asuransi harus diisi');
		validasi1($('#nomor_asuransi'), 'Jika Pasien Memiliki Asuransi, Nomor Asuransi Harus Diisi!!');
		return false;
	}
	if(validatePass2(control)){
		$(control).closest('div').find('.submit').click();
	}
}
function refresh(){
	$.get( url + '/home/pasiens/ajax/cekimage',
		{ 'random_string': random_string },
		function (data, textStatus, jqXHR) {
			var temp = '';
			for (var i = 0, len = data.length; i < len; i++) {
				temp += '<div class="row">';
				temp += '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
				temp += '<div class="panel panel-default">';
				temp += '<div class="panel-heading">';
				temp += '<h3 class="panel-title">' + data[i]['label']+ '</h3>';
				temp += '</div>';
				temp += '<div class="panel-body">';
				temp += '<img id="pasien_image" class="full-width" src="' + url + '/home/pasiens/pasienimage/' + data[i]['link']+ '" alt="" />';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
				temp += '</div>';
			}
			$('#image_container').html(temp);
		}
	);
}

