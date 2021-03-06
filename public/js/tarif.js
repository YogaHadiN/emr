searchAjax();
function searchAjax(key = 0) {

	var tarif                = $('#tarif').val();
	var displayed_rows         = $('#displayed_rows').val();

	$.get(base + '/home/tarifs/search/ajax',
		{
			'tarif':                tarif,
			'displayed_rows':         displayed_rows,
			'key':                    key
		},
		function (result, textStatus, jqXHR) {
			data  = result.data;
			key   = result.key;
			pages = result.pages;
			rows  = result.rows;

			var temp = '';
			if (data.length > 0) {
				for (var i = 0, len = data.length; i < len; i++) {
					temp += '<tr>';
					temp += '<td class="id hide">';
					temp += data[i].id
					temp += '</td>';
					temp += '<td class="tindakan">';
					temp += data[i].jenis_tarif
					temp += '</td>';
					temp += '<td class="biaya">';
					temp += uang(data[i].biaya)
					temp += '</td>';
					temp += '<td class="jasa_dokter">';
					temp += uang(data[i].jasa_dokter)
					temp += '</td>';
					temp += '<td class="bahan_habis_pakai">';

					var bhp = $.parseJSON(data[i]['bhp_items'])
					if (bhp.length > 0) {
						temp += '<ul>'
						for (var n = 0, lgt = bhp.length; n < lgt; n++) {
							temp += '<li>'
							temp += bhp[n]['merek'] + ' ' + bhp[n]['jumlah']
							temp += '</li>'
						}
						temp += '</ul>'
					}
					temp += '</td>';
					temp += '<td nowrap="" class="autofit action"> <form method="POST" action="' + base + '/home/obats/' + data[i]["id"]+ '" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+  $('meta[name="csrf-token"]').attr('content') +'"> <a class="btn btn-warning btn-sm" href="' + base + '/home/obats/' + data[i]["id"] + '/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> <button class="btn btn-danger btn-sm" onclick="return confirm(\"Anda yakin ingin menghapus ' + data[i]["id"]+ ' - ' + data[i]['tindakan'] + '?\")" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button> </form> </td>'
					temp += '</tr>';
				}
			} else {
				var colspan = $('#ajax_container').closest('table').find('th').length;
				temp += '<tr>';
				temp += '<td colspan="' + colspan + '" class="text-center">';
				temp += 'Tidak ada data untuk ditampilkan'
				temp += '</td>';
				temp += '</tr>';
			}
			$('#ajax_container').html(temp);
			$('#paging').twbsPagination({
				startPage: parseInt(key) +1,
				totalPages: pages,
				visiblePages: 7,
				onPageClick: function (event, page) {
					searchAjax(parseInt( page ) -1);
				}
			});
			$('#rows').html(numeral( rows ).format('0,0'));
		}
	);
}
function clearAndSelect(key = 0){
	if($('#paging').data("twbs-pagination")){
		$('#paging').twbsPagination('destroy');
	}
	searchAjax(key);
}
var timeout;
$("body").on('keyup', '.ajaxselect', function () {
	loaderGif();
	window.clearTimeout(timeout);
	timeout = window.setTimeout(function(){
		clearAndSelect();
		console.log('exec');
	},600);
});
function loaderGif(){
	var colspan = $('#ajax_container').closest('table').find('thead tr').find('th:not(.displayNone)').length;
	$('#ajax_container').html(
		"<td colspan='" +colspan+ "'><img class='loader' src='" +base+ "/img/loader.gif' /></td>"
	)
}
