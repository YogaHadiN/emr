	function tambahTarif(control){
		var body_table = $('#body_table').html();
		$(control).closest('tbody').append(body_table);
		$(control).html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>')
		.attr('onclick', 'delTarif(this);return false;')
		.prop('class', 'btn btn-danger btn-sm');
		var jenis_tarif_id = $(control).closest('tr').find('.selectpickerKasir').val();
		if ( jenis_tarif_id == 1  || jenis_tarif_id == 9) {
			$(control).prop('disabled', 'disabled');
		}
		$(control).closest('tr').next().find('.selectpickerKasir')
			.selectpicker({
			style: 'btn-default',
			size: 10,
			selectOnTab : true,
			style : 'btn-white'
		});
		$(control).closest('tr').next().find('.bootstrap-select').find('.btn').focus();
	}
	function delTarif(control){
		$(control).closest('tr').remove();
		biayaKeyUp();
	}
	function changeSelectTarif(control){
		console.log('control  :	');
		console.log($(control).val());
		if ($(control).val() != ''){
			if ($(control).closest('tr').find('.btn-success').is(":disabled")) {
				$(control).closest('tr').find('.btn-success').removeAttr("disabled");
				$(control).closest('tr').find('.biaya').removeAttr("disabled");
			} 
		} else {
			if (!$(control).closest('tr').find('.btn-success').is(":disabled")) {
				$(control).closest('tr').find('.btn-success').prop("disabled", "disabled");
				$(control).closest('tr').find('.biaya').val(0);
				if (!$(control).closest('tr').find('.biaya').is(":disabled")) {
					!$(control).closest('tr').find('.biaya').prop('disabled', 'true');
				}
			}
		}
		var jenis_tarif_id = $(control).val();
		if (jenis_tarif_id != null) {
			$.get(url + '/home/kasirs/getBiaya',
				{ jenis_tarif_id: jenis_tarif_id },
				function (data, textStatus, jqXHR) {
					$(control).closest('tr').find('.biaya').val(data);
					biayaKeyUp();
				}
			);
		} else {
			$(control).closest('tr').find('.biaya').val(0);
			biayaKeyUp();
		}
	}
	$('#tabel_nota').find('.selectpickerKasir')
		.selectpicker({
		style: 'btn-default',
		size: 10,
		selectOnTab : true,
		style : 'btn-white'
	});
	function biayaKeyUp(){
		var total_biaya = 0;
		$('#tabel_nota').find('.biaya').each(function(){
			total_biaya +=  parseInt( $(this).val() ) ;
		})
		$('#total_biaya').html(uang(total_biaya));
		var pembayaran = $('#pembayaran').val();
		var kembalian = parseInt(pembayaran) - parseInt(total_biaya);
		$('#kembalian').val(kembalian);
	}
	function pembayaranKeyUp(control){

	}
