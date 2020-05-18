var array           = JSON.parse( $('#json_container').val() );
var data;
var puyer           = false;
var add             = false;
var rowDelete       = false;
var finishPuyer     = false;
var finishAdd       = false;
var obatPuyer       = false;
var obatStandar     = true;
var obatAdd         = false;
var templateStandar = '';
var url_param       = base + '/terapis/obat/cari/ajax';


function prevent(e) {
	alert('tekan');
	if (e.keyCode == 13) {
		e.preventDefault();
		return false;
	}
}
refreshSelectAjax(base + url_param);
setTimeout(function(){
	viewResep();
}, 500);
focusObat();

function dummySubmit(control){
	if( !add && !puyer ){
		$('#submit').click();
	} else {
		alert('Racikan Harus Diselesaikan terlebih dahulu');
		focusObat();
	}
}
function inputResep(control){
	rowDelete       = false;
	if (inputNotEmpty()) {
		if ( $('#json_container').val() == ''  ) {
			$('#json_container').val('[]');
		}
		changeStatusButton();
		collectData();
		pushData();
		viewResep();
		clearSelection();
	}
}
function collectData(){
	data = {
		'tipe_resep_id':     $('#tipe_resep').val(),
		'standar_text':      $('#tipe_resep option:selected').text(),
		'obat_id':           $('#nama_obat_ajax_search').val(),
		'obat_text':         $('#nama_obat_ajax_search').text(),
		'signa_id':          $('#signa').val(),
		'signa_text':        $('#signa option:selected').text(),
		'aturan_minum_id':   $('#aturan_minum').val(),
		'aturan_minum_text': $('#aturan_minum option:selected').text(),
		'jumlah':            $('#jumlah').val()
	};
	console.log(data);
}

function clearSelection(){
	$('#nama_obat_ajax_search').empty();
	if ( !puyer && !add ) {
		$('#signa').val('1').selectpicker('refresh');
		$('#aturan_minum').val('').selectpicker('refresh');
		$('#jumlah').val('');
	}
	focusObat();
}
function pushData(){
	array.push(data);
}

function viewResep(){
	puyer       = false;
	add         = false;
	var temp = '';
	console.log(array);
	for (var i = 0, len = array.length; i < len; i++) {
		if ( array[i].tipe_resep_id == '1' ) { // tipe resep tipe_resep
			console.log('obatPuyer level 1');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].signa_text+ '</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '3' ) && ( array[i].obat_id == '1' || array[i].obat_id == '3' )  ){
			console.log('obatPuyer level 2');
			console.log(obatPuyer);
			finishPuyer = true;
			puyer       = false;
			add         = false;
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">Buat menjadi ' + array[i].jumlah + ' puyer</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button>';
			temp += '<button type="button" onclick="editRacikan(' + i + ');return false;" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '3' )){
			kondisikanSeleksiPuyer();
			console.log('obatPuyer level 3');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '3' ){
			kondisikanSeleksiPuyer();
			console.log('obatPuyer level 4');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '2' ) && array[i].obat_id == '2'  ){
			finishAdd   = true;
			finishPuyer = false;
			puyer       = false;
			add         = false;
			console.log('obatPuyer level 5');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td style="border-bottom:1px solid #000;">S masukkan ke dalam sirup  ' + array[i].signa_text + '</td>';
			temp += '<td style="border-bottom:1px solid #000;">' + array[i].aturan_minum_text+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button>';
			temp += '<button type="button" onclick="editRacikan(' + i + ');return false;" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' && ( isset( array[i-1] ) && array[i-1].tipe_resep_id == '2' )){
			kondisikanSeleksiAdd();
			console.log('obatPuyer level 6');
			console.log(obatPuyer);
			temp += '<tr>';
			temp += '<td></td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>No ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
		} else if ( array[i].tipe_resep_id == '2' ){
			kondisikanSeleksiAdd();
			console.log('obatPuyer level 7');
			console.log(obatPuyer);
			if (!obatPuyer) {
				obatPuyer = true;
				gantiObatKeKapsulDanTablet();
			}
			temp += '<tr>';
			temp += '<td>R/</td>';
			temp += '<td>' + array[i].obat_text+ '</td>';
			temp += '<td>fls No. ' + array[i].jumlah+ '</td>';
			temp += '<td><button type="button" onclick="rowDel(' + i + ');return false;" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span	</button></td>';
			temp += '</tr>';
			temp += '<tr>';
			temp += '<td colspan="3" style="text-align:center">ADD</td>';
			temp += '<td></td>';
			temp += '</tr>';
		}
	}
	ubahFormatSelection();
	$('#resep').html(temp);
	var json = JSON.stringify(array);
	$('#json_container').val(json);
}
function rowDel(i){
	rowDelete = true;
	array.splice(i,1);
	viewResep();
}
function tipeResepChange(control){
	$('#nama_obat_ajax_search').empty();
	if ( $(control).val() == '3' ) {
		kondisikanSeleksiPuyer();
		gantiSeleksiPuyer();
	} else if ( $(control).val() == '2' ) {
		obatPuyer   = false;
		kondisikanSeleksiAdd();
		gantiSeleksiAdd();
	}
	focusObat();
}
function inputNotEmpty(){
	if(
        $('#tipe_resep').val()   == '' ||
		$('#nama_obat_ajax_search').val()         == '' ||
		$('#jumlah').val()       == '' ||
		$('#aturan_minum').val() == '' ||
		$('#signa').val()        == ''
	){
		alert('input harus diisi semua');
		focusObat();
		return false;
	}
	return true;
}

function focusObat(){
	setTimeout(function() {
		$('#nama_obat_ajax_search').select2('open');
		$(document).scrollTop($(document).height());
	}.bind(this), 100);
}

function endPuyer(){
	$('#selesaikanPuyer').fadeOut('slow');
	setValueNamaObatThenReadOnly('Kertas Puyer Biasa', 1);
	$('#signa').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#aturan_minum').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#jumlah').val('').focus();
}

function endAdd(){
	$('#selesaikanAdd').fadeOut('slow');
	setValueNamaObatThenReadOnly('Add Sirup', 2);
	$('#signa').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#aturan_minum').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#jumlah').val('0').fadeOut('slow');
	$('#signa').closest('.form-group').find('.dropdown-toggle').focus();

}
function isset(ref) { return typeof ref !== 'undefined' }
function ubahFormatSelection(){
	if (puyer) {
		gantiSeleksiPuyer();
	} else if( add ){
		gantiSeleksiAdd();
	} else {
		gantiSeleksiStandar();
	}
	focusObat();
}
function gantiSeleksiPuyer(){
	obatAdd   = false;
	obatStandar = false;
	$('#tipe_resep').val('3');
	
	if ( $('#tipe_resep').closest('.form-group').is(':visible') ) {
		$('#tipe_resep').closest('.form-group').fadeOut('slow', function(){
			if (rowDelete) {
				if ( $('#kembaliResepStandar').is(':visible') ) {
					$('#kembaliResepStandar').fadeOut('slow');
				}
				if ( $('#selesaikanAdd').is(':visible') ) {
					$('#selesaikanAdd').fadeOut('slow');
				}
				if ( $('#selesaikanPuyer').is(':hidden') ) {
					$('#selesaikanPuyer').fadeIn('slow');
				}
			} else {
				munculkanKembaliResepStandar();
			}
		});
	}
	 // $('#tipe_resep').val('3');
	if (!obatPuyer) {
		obatPuyer = true;
		$('#nama_obat_ajax_search').empty();
		gantiObatKeKapsulDanTablet();
	}

	$('#signa').val(2);
	if ( $('#signa').closest('.form-group').is(':visible') ) {
		$('#signa').closest('.form-group').fadeOut('slow');
	}

	$('#aturan_minum').val(1)
	if ( $('#aturan_minum').closest('.form-group').is(':visible') ) {
		$('#aturan_minum').closest('.form-group').fadeOut('slow');
	}
	if ( $('#nama_obat_ajax_search').closest('.form-group').is(':hidden') ) {
		$('#nama_obat_ajax_search').closest('.form-group').fadeIn('slow');
	}
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function gantiSeleksiAdd(){
	obatStandar = false;
	if ( $('#tipe_resep').closest('.form-group').is(':visible') ) {
		$('#tipe_resep').closest('.form-group').fadeOut('slow', function(){
			if (rowDelete) {
				if ( $('#kembaliResepStandar').is(':visible') ) {
					$('#kembaliResepStandar').fadeOut('slow');
				}
				if ( $('#selesaikanPuyer').is(':visible') ) {
					$('#selesaikanPuyer').fadeOut('slow');
				}
				if ( $('#selesaikanAdd').is(':hidden') ) {
					$('#selesaikanAdd').fadeIn('slow');
				}
			} else {
				munculkanKembaliResepStandar();
			}
		});
	}
	 // $('#tipe_resep').val('2');
	if (!obatAdd) {
		obatAdd = true;
		$('#nama_obat_ajax_search').empty();
		url_param = base + '/terapis/obat/cari/ajax/add'; 
	}

	$('#signa').val(1).selectpicker('refresh');
	if ( $('#signa').closest('.form-group').is(':visible') ) {
		$('#signa').closest('.form-group').fadeOut('slow');
	}

	$('#aturan_minum').val(1)
	if ( $('#aturan_minum').closest('.form-group').is(':visible') ) {
		$('#aturan_minum').closest('.form-group').fadeOut('slow');
	}
	if ( $('#nama_obat_ajax_search').closest('.form-group').is(':hidden') ) {
		$('#nama_obat_ajax_search').closest('.form-group').fadeIn('slow');
	}
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function gantiSeleksiStandar(){
	obatPuyer = false;
	obatAdd   = false;
	$('#tipe_resep').val('1').selectpicker('refresh');
	if ( $('#tipe_resep').closest('.form-group').is(':hidden') ) {
		$('#tipe_resep').closest('.form-group').fadeIn('slow', function(){
			if ( $('#selesaikanPuyer').is(':visible') ) {
				$('#selesaikanPuyer').fadeOut('slow');
			}
			if ( $('#selesaikanAdd').is(':visible') ) {
				$('#selesaikanAdd').fadeOut('slow');
			}
		});
	}
	if ( $('#selesaikanPuyer').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
	if ( $('#kembaliResepStandar').is(':visible') ) {
		$('#kembaliResepStandar').fadeOut('slow');
	}
	if ( $('#selesaikanAdd').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
	if (!obatStandar) {
		console.log('this laa');
		obatStandar = true;
		url_param = base + '/terapis/obat/cari/ajax'; 
	}

	$('#signa').val('');
	if ( $('#signa').closest('.form-group').is(':hidden') ) {
		$('#signa').closest('.form-group').fadeIn('slow');
	}
	$('#aturan_minum').val('')
	if ( $('#aturan_minum').closest('.form-group').is(':hidden') ) {
		$('#aturan_minum').closest('.form-group').fadeIn('slow');
	}
	if ( $('#nama_obat_ajax_search').closest('.form-group').is(':hidden') ) {
		$('#nama_obat_ajax_search').closest('.form-group').fadeIn('slow');
	}
	$('#nama_obat_ajax_search').attr("disabled", false).selectpicker('refresh');
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
}
function kondisikanSeleksiPuyer(){
	finishPuyer = false;
	puyer       = true;
	add         = false;
}
function kondisikanSeleksiAdd(){
	finishPuyer = false;
	puyer       = false;
	add         = true;
}
function gantiObatKeKapsulDanTablet(){
	console.log('log');
	console.log('this');
	url_param = base + '/terapis/obat/cari/ajax/puyer'; 
}
function getUrl() {
	return url_param;
}
function refreshSelectAjax(urlParam) {
	$('#nama_obat_ajax_search').select2({
		width: '100%',
		theme: "bootstrap",
		ajax: {
			url: function() {
				return getUrl();
			},
			dataType: 'json',
			// delay: 100,	
			data: function (params) {
			  return {
				q: params.term, // search term
				page: params.page
			  };
			},
			processResults: function (data, params) {
			  // parse the results into the format expected by Select2
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data, except to indicate that infinite
			  // scrolling can be used
			  params.page = params.page || 1;

			  return {
				results: data,
				pagination: {
				  more: (params.page * 30) < data.total_count
				}
			  };
			},
			cache: true
		},
		placeholder: 'Pilih Merek...',
		minimumInputLength: 1,
		dropdownPosition: 'below',
		selectOnClose: true,
		escapeMarkup: function(markup) {
			return markup;
		},
		templateResult: function(data) {
			return data.html;
		},
		templateSelection: function(data) {
			return data.text;
		}
	});
}
function kembaliResepStandar() {
	$('#selesaikanAdd').fadeOut('slow');
	$('#nama_obat_ajax_search').val('2').selectpicker('refresh').closest('.form-group').fadeOut('slow');
	$('#signa').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#aturan_minum').val('').selectpicker('refresh').closest('.form-group').fadeIn('slow');
	$('#jumlah').val('0').fadeOut('slow');
	$('#signa').closest('.form-group').find('.dropdown-toggle').focus();
}

function kembaliKeStandar() {
	if ( $('#kembaliResepStandar').is(':visible') ) {
		$('#kembaliResepStandar').fadeOut('slow');
	}
	if ( $('#selesaikanAdd').is(':visible') ) {
		$('#selesaikanAdd').fadeOut('slow');
	}
	if ( $('#selesaikanPuyer').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
	$('#tipe_resep').val('1').selectpicker('refresh');
	$('#tipe_resep').closest('.form-group').fadeIn('slow');
	$('#signa').val('').selectpicker('refresh');
	if ( $('#signa').closest('.form-group').is(':hidden') ) {
		$('#signa').closest('.form-group').fadeIn('slow');
	}
	$('#aturan_minum').val('').selectpicker('refresh');
	if ( $('#aturan_minum').closest('.form-group').is(':hidden') ) {
		$('#aturan_minum').closest('.form-group').fadeIn('slow');
	}
	if ( $('#jumlah').is(':hidden')) {
		$('#jumlah').fadeIn('slow');
	}
	focusObat();
}
function munculkanKembaliResepStandar() {
	if ( $('#kembaliResepStandar').is(':hidden') ) {
		$('#kembaliResepStandar').fadeIn('slow');
	}
	if ( $('#selesaikanAdd').is(':visible') ) {
		$('#selesaikanAdd').fadeOut('slow');
	}
	if ( $('#selesaikanPuyer').is(':visible') ) {
		$('#selesaikanPuyer').fadeOut('slow');
	}
}
function changeStatusButton() {
	if (add || puyer) {
		if ( $('#tipe_resep').closest('.form-group').is(':visible') ) {
			$('#tipe_resep').closest('.form-group').fadeOut('slow');
		}
	}
	
	if ( $('#kembaliResepStandar').is(':visible') ) {
		$('#kembaliResepStandar').fadeOut('slow');
	}
	if (puyer) {
		if ( $('#selesaikanAdd').is(':visible') ) {
			$('#selesaikanAdd').fadeOut('slow');
		}
		if ( $('#selesaikanPuyer').is(':hidden') ) {
			$('#selesaikanPuyer').fadeIn('slow');
		}
	}
	if (add) {
		if ( $('#selesaikanPuyer').is(':visible') ) {
			$('#selesaikanPuyer').fadeOut('slow');
		}
		if ( $('#selesaikanAdd').is(':hidden') ) {
			$('#selesaikanAdd').fadeIn('slow');
		}
	}
}
function setValueNamaObatThenReadOnly( text_select, i ){
	$("#nama_obat_ajax_search").append('<option selected="selected" value="'+i+'">' + text_select + '</option>');
	$("#nama_obat_ajax_search").val(i).trigger('change');
	$('#nama_obat_ajax_search').attr('disabled', 'disabled').trigger('change');
}
function editRacikan(i) {
	rowDelete = true;
	data            = [];
	// ambil baris array dengan tipe_resep yang sama mulai dari baris tombol ditekan ke atas
	while ( array[i]['tipe_resep_id'] == '3' ) {
		data.push(array[i]);
		i--;
	}
	// sebelum data dimasukkan, hapus dulu baris array yang akan dipindah
	array.splice(i + 1, data.length);
	// balik array sehingga baris array tombol yang ditekan menjadi yang terakhir lagi
	data.reverse();
	// hapus baris array tombol yang ditekan untuk menampilkan form racikan
	data.splice(data.length - 1, 1);
	// masukkan data ke array baris terakhir berurutan
	for (var i = 0, len = data.length; i < len; i++) {
		array.push(data[i]);
	}
	//tampilkan view
	viewResep();
}
