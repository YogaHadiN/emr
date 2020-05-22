searchAjax();
function searchAjax(key = 0) {

	var icd     = $('#icd').val();
	var icd_id     = $('#icd_id').val();
	var displayed_rows = $('#displayed_rows').val();

	$.get(base + '/home/icds/search/ajax',
		{
			'icd':            icd,
			'icd_id':         icd_id,
			'displayed_rows': displayed_rows,
			'key':            key
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
					temp += '<td class="diagnosaICD">';
					temp += data[i].diagnosaICD
					temp += '</td>';
					temp += '</tr>';
				}
			} else {
				temp += '<tr>';
				temp += '<td colspan="2" class="text-center">';
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
