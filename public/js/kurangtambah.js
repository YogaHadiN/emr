function tambah(control){
	if( $(control).closest('tr').find('.form').val() != '' ){
		var temp = $(control).closest('tr')[0].outerHTML;
		$(control).closest('tbody').append(temp);
		$(control).closest('tr').next().find('.form').val('');
		$(control).closest('tr').find('td.action').html('<button class="btn btn-danger btn-block" type="button" onclick="kurang(this);return false;"><i class="fa fa-minus" aria-hidden="true"></i></button>');
		$('.tanggal').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format: 'dd-mm-yyyy'
		});
	}
}

function kurang(control){
	$(control).closest('tr').remove();
}
