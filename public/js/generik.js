searchAjax();
function searchAjax(key = 0) {

	var generik                = $('#generik').val();
	var displayed_rows         = $('#displayed_rows').val();
	var pregnancy_safety_index = $('#pregnancy_safety_index').val();

	$.get(base + '/home/generiks/search/ajax',
		{
			'generik':                generik,
			'displayed_rows':         displayed_rows,
			'pregnancy_safety_index': pregnancy_safety_index,
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
					temp += '<td class="id">';
					temp += data[i].id
					temp += '</td>';
					temp += '<td class="generik">';
					temp += data[i].generik
					temp += '</td>';
					temp += '<td class="pregnancy_safety_index">';
					temp += data[i].pregnancy_safety_index
					temp += '</td>';
					temp += '</tr>';
				}
			} else {
				temp += '<tr>';
				temp += '<td colspan="3" class="text-center">';
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
function clearAndSelectGenerik(key = 0){
	if($('#paging').data("twbs-pagination")){
		$('#paging').twbsPagination('destroy');
	}
	searchAjax(key);
}
var timeout;
$("body").on('keyup', '.ajaxselectgenerik', function () {
	loaderGif();
	window.clearTimeout(timeout);
	timeout = window.setTimeout(function(){
		clearAndSelectGenerik();
		console.log('exec');
	},600);
});
function loaderGif(){
	var colspan = $('#ajax_container').closest('table').find('thead tr').find('th:not(.displayNone)').length;
	$('#ajax_container').html(
		"<td colspan='" +colspan+ "'><img class='loader' src='" +base+ "/img/loader.gif' /></td>"
	)
}
