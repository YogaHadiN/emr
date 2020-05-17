function dummySubmit(control){
	if(validatePass2(control)){
		$('#submit').click();
	}
}
function tambahKomposisi(control){
	var generik = $(control).closest('tr').find('select.generik').val();
	var satuan = $(control).closest('tr').find('select.satuan').val();
	var bobot = $(control).closest('tr').find('.bobot').val();

	if(
		generik != '' &&
		satuan != '' &&
		bobot != ''
	){
		var temp = $('#komposisi_template').html();
		$(control).closest('tr').after(temp);
		$(control).closest('tr').next().find('select').selectpicker({
			style: 'btn-default',
			size: 10,
			selectOnTab : true,
			style : 'btn-white'
		});

		$(control).closest('tr').next().find('select.generik').closest('.dropdown').find('.dropdown-toggle').focus();
		$(control).find('.glyphicon-plus')
			.removeClass('glyphicon-plus')
			.addClass('glyphicon-minus');
		$(control)
			.removeClass('btn-success')
			.addClass('btn-danger')
			.attr('onclick', 'delKomposisi(this);return false;');
	} else {
		alert('komponen komposisi generik, bobot dan satuan harus lengkap')
	}
}
function delKomposisi(control){
	$(control).closest('tr').remove();

}

