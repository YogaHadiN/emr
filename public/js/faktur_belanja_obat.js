$('#tableObat .selectpickers')
	.selectpicker({
	style: 'btn-default',
	size: 10,
	selectOnTab : true,
	style : 'btn-white'
});
function tambahObat(control){
	var temp = $('#tempTambahObat').html();
	$(control).closest('tbody').append(temp);
	$(control).closest('tr').next().find('.selectpickers')
		.selectpicker({
		style: 'btn-default',
		size: 10,
		selectOnTab : true,
		style : 'btn-white'
	});
	$(control).closest('tr').next().find('.tanggal')
		.datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true,
		format: 'dd-mm-yyyy'
	});
	$(control).closest('tr').find('.btn-primary')
		.removeClass('btn-primary')
		.addClass('btn-danger')
		.html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>')
		.attr('onclick', 'delObat(this); return false');
	$(control).closest('tr').next().find('.btn-white').focus();
}

function delObat(control){
	$(control).closest('tr').remove();
}

function changeObat(control){
	disableIfNoValue(control);
	isiHargaBeliHargaJual(control);
}

function disableIfNoValue(control){
	var obat_id = $(control).val();
	if ( obat_id != '' ) {
		if ( $(control).closest('tr').find('.action').is(":disabled") ) {
			 $(control).closest('tr').find('.action').removeAttr('disabled');
		}
	} else if( obat_id == ''   ) {
		if ( !$(control).closest('tr').find('.action').is(":disabled") ) {
			 $(control).closest('tr').find('.action').prop('disabled', true);
		}
	}
}
function isiHargaBeliHargaJual(control){
	var obat_id = $(control).val();


	$.get('/home/faktur_belanja_obats/ajaxGetObat',
		{ 'obat_id': obat_id },
		function (data, textStatus, jqXHR) {
			$(control).closest('tr').find('.harga_beli').val( data['harga_beli'] );
			$(control).closest('tr').find('.harga_jual').val( data['harga_jual'] );
		}
	);
}
