$('.show_tab_diagnosa').on('shown.bs.tab', function (e) {
	$('#icd_ajax_search').select2('focus');
}) 
$('#tindakan_table').find('select')
		.selectpicker({
		style: 'btn-default',
		container: 'body',
		size: 10,
		selectOnTab : true,
		style : 'btn-white'
	}).closest('tr').find('button').removeClass('disabled');


function dummySubmit(control){
	if(validatePass2(control)){
		$('#submit').click();
	}
}
function addTindakan(control){
	if ( $(control).closest('tr').find('select').val()  == '') {
		alert('Jenis Tindakan Harus Diisi untuk menambah');
		validasi($(control).closest('tr').find('.bootstrap-select'), 'Harus Diisi');
		$(control).closest('tr').find('.dropdown-toggle').focus();
	} else {
		var tindakan_temp = $('#tarif_temp').html();
		$('#tindakan_table').append(tindakan_temp);
		$(control).closest('tr').next().find('select')
			.selectpicker({
			style: 'btn-default',
			container: 'body',
			size: 10,
			selectOnTab : true,
			style : 'btn-white'
		});
		$(control).closest('tr').next().find('.dropdown-toggle').focus();
		if($(control).closest('table tr').length > 0){
			$(control).closest('td').html('<button class="btn btn-primary btn-sm btn-danger" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>');
		}else {
			$(control).closest('td').html('<button class="btn btn-primary btn-sm" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>');
		}
	}
}
function rowDel(control){
	var table = $(control).closest('table').find('tbody');
	$(control).closest('tr').remove();
	if(table.find('tr').length > 1){
		table.find('tr').last().find('.action').html('<button class="btn btn-primary btn-sm" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button> <button class="btn btn-danger btn-sm" type="button" onclick="rowDel(this);return false;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>')
	}else {
		table.find('tr').last().find('.action').html('<button class="btn btn-primary btn-sm" type="button" onclick="addTindakan(this);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>')
	}
}
function tarifSelectChange(control){
	var selectVal = $(control).val();
	console.log(selectVal);
	if( !selectVal ){
		if( !$(control).closest('tr').find('.btn-primary').hasClass('disabled') ){
			$(control).closest('tr').find('.btn-primary').addClass('disabled');
		}
	} else {
		$(control).closest('tr').find('.disabled').removeClass('disabled');
	}
}

$('#icd_ajax_search').select2(ajax_search('periksa/icd/cari', 'Cari ICD ....' ));
$('#diagnosa_ajax_search').select2(ajax_search('periksa/diagnosa/cari', 'Pilih Diagnosa ... '));
$('#select_generik_id').select2(ajax_search('periksa/generik/cari', 'Pilih Generik ... '));

function buatDiagnosa(control){

	if ( $(control).val() == '' ) {
		if ( !$('#button_submit').hasClass('disabled') ) {
			$('#button_submit').addClass('disabled')
		}
	} else {
		if ( $('#button_submit').hasClass('disabled') ) {
			$('#button_submit').removeClass('disabled')
		}
	}

	var icd = $(control).val();
	$.get(base + '/periksa/pilih/diagnosa/fromIcd',
		{ id: icd },
		function (data, textStatus, jqXHR) {
			var temp = '';
			if ( $('#diagnosa_entry').hasClass('hide')) {
				$('#diagnosa_entry').removeClass('hide');
			}
			if (data.length > 0) {
				for (var i = 0, len = data.length; i < len; i++) {
					temp += '<tr>';
					temp += '<td class="diagnosa">';
					temp += data[i].diagnosa;
					temp += '</td>';
					temp += '<td class="hide diagnosaICD">';
					temp += data[i].diagnosaICD;
					temp += '</td>';
					temp += '<td class="hide icd_id">';
					temp += data[i].icd_id;
					temp += '</td>';
					temp += '<td>';
					temp += '<button type="button" class="btn btn-info btn-sm" onclick="tentukanDiagnosa(this, ' + data[i].diagnosa_id + ');return false;">Pilih</button>'
					temp += '</td>';
					temp += '</tr>';
				}
				$('#diagnosaContainer').html(temp);
				if ( $('#diagnosa_entry').find('.diagnosa_ada').hasClass('hide')) {
					$('#diagnosa_entry').find('.diagnosa_ada').removeClass('hide');
				}
			}
		}
	);
}
function tentukanDiagnosa(control, i){
	var diagnosa    = $(control).closest('tr').find('.diagnosa').html();
	var diagnosaICD = $(control).closest('tr').find('.diagnosaICD').html();
	var icd_id      = $(control).closest('tr').find('.icd_id').html();
	var text_select = diagnosa + ' (' + icd_id + ' - ' + diagnosaICD + ')';
	updateAndClear(text_select, i);
}
function diagnosaBaru(control){
	if ( !$('#buat_baru').val() == '' ) {
		var icd_id        = $('#icd_ajax_search').val();
		var diagnosa_baru = $('#buat_baru').val();

		$.post(base + '/periksas/diagnosa/baru',
			{ 
				icd_id: icd_id ,
				diagnosa: diagnosa_baru
			},
			function (data, textStatus, jqXHR) {
				data = $.trim(data);
				if ( data != null ) {
					var diagnosaICD = $( "#icd_ajax_search option:selected" ).text()
					var text_select = diagnosa_baru + ' (' + diagnosaICD + ')';
					updateAndClear(text_select, data);
				} else {
					alert('buat diagnosa baru gagal');
				}
			}
		);
	} else {
		alert('Nama diagnosa harus diisi');
		validasi($('#buat_baru'), 'Harus Diisi');
	}
}
function updateAndClear( text_select, i ){
	$("#diagnosa_ajax_search").append('<option selected="selected" value="'+i+'">' + text_select + '</option>');
	$("#diagnosa_ajax_search").val(i).trigger('change');
	kembali();
}
function kembali(){
	$('.nav-tabs a[href="#status"]').tab('show');
	$('#diagnosa_ajax_search').select2('focus');
	$('#buat_baru').val('');
	$('#diagnosaContainer').html('');
	$('#icd_ajax_search').empty();
	if ( !$('#diagnosa_entry').find('.diagnosa_ada').hasClass('hide')) {
		$('#diagnosa_entry').find('.diagnosa_ada').addClass('hide');
	}
	if (!$('#diagnosa_entry').hasClass('hide')) {
		$('#diagnosa_entry').addClass('hide');
	}
	$('#button_submit').attr('disabled', 'true')
}

function kembaliTerapi(){
	$('.nav-tabs a[href="#status"]').tab('show');
	$('#diagnosa_ajax_search').select2('focus');
	$('#buat_baru').val('');
	$('#diagnosaContainer').html('');
	$('#icd_ajax_search').empty();
	if ( !$('#diagnosa_entry').find('.diagnosa_ada').hasClass('hide')) {
		$('#diagnosa_entry').find('.diagnosa_ada').addClass('hide');
	}
	if (!$('#diagnosa_entry').hasClass('hide')) {
		$('#diagnosa_entry').addClass('hide');
	}
	$('#button_submit').attr('disabled', 'true')

}
function showDiagnosaTab(){
	$('.show_tab_diagnosa').tab('show');
}
function removeAlergi(control){
	var id = $(control).closest('tr').find('.id').html();
	var generik = $(control).closest('tr').find('.generik').html();
	var pasien_id = $('#pasien_id').val();
	if (confirm( 'Apa Anda yakin mau menghapus ' + generik + ' dari daftar alergi pasien ini?' )) {
		$.post(base + '/alergies/hapus',
			{ 
				id:        id,
				pasien_id: pasien_id
			},
			function (data, textStatus, jqXHR) {
				console.log('data keluar');
				console.log(jumlahBaris($(control)) < 2);
				console.log( $.trim( data ) != '' );
				if (jumlahBaris( $(control) )< 2) {
					console.log('this is it');
					$(control).closest('tr').html(
						'<td class="text-center" colspan="2">Tidak ada data</td>'
					);
				} else {
					$(control).closest('tr').remove();
				}
				resetOption();
			}
		);
	}
}
function submitAlergi(control){
	var generik_id = $('#select_generik_id').val();
	var pasien_id = $('#pasien_id').val();
	$.post(base + '/periksas/alergi/tambah',
		{ 
			generik_id : generik_id,
			pasien_id : pasien_id
		},
		function (data, textStatus, jqXHR) {
			refreshDataAlergi(data);
			$(control).closest('tr').find('.dropdown-toggle').focus();
		}
	);
}
function changeGenerik(control){
	if ( $(control).val() == '' ) {
		if ( !$('#submit_alergi').hasClass('disabled') ) {
			 $('#submit_alergi').addClass('disabled');
		}
	} else {
		if ( $('#submit_alergi').hasClass('disabled') ) {
			 $('#submit_alergi').removeClass('disabled');
		}
	}
}
function refreshDataAlergi(data){
	if (data.length > 0) {
		var temp = '';
		for (var i = 0, len = data.length; i < len; i++) {
			temp += '<tr>';
			temp += '<td class="id hide">';
			temp += data[i].id;
			temp += '</td>';
			temp += '<td class="generik_id hide">';
			temp += data[i].generik_id;
			temp += '</td>';
			temp += '<td class="generik">';
			temp += data[i].generik;
			temp += '</td>';
			temp += '<td>';
			temp += '<button type="button" class="btn btn-danger" onclick="removeAlergi(this);return false;"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button>';
			temp += '</td>';
			temp += '</tr>';
		}
		$('#alergi_container').html(temp);
	} else {
		$('#alergi_container').html('<tr><td class="text-center" colspan="2">Tidak ada data</td></tr>');
	}
	resetOption();

}
function resetOption(){
	$('#select_generik_id').empty();
	if ( !$('#submit_alergi').hasClass('disabled') ) {
		 $('#submit_alergi').addClass('disabled');
	}
}
function jumlahBaris(control) {
	 return control.closest('tbody').find('tr').length;
}
