searchAjax();
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
function searchAjax(key = 0) {
	var merek          = $('#merek').val();
	var generik        = $('#generik').val();
	var displayed_rows = $('#displayed_rows').val();

	$.get(base + '/home/obats/search/ajax',
		{
			'merek':          merek,
			'displayed_rows': displayed_rows,
			'generik':        generik,
			'key':            key
		},
		function (result, textStatus, jqXHR) {
			data  = result.data;
			key   = result.key;
			pages = result.pages;
			rows  = result.rows;
			console.log('data');
			console.log(data);
			console.log(key);


			var temp = '';
			if (data.length > 0) {
				for (var i = 0, len = data.length; i < len; i++) {
					temp += '<tr>';
					temp += '<td class="id">';
					temp += data[i]['id']
					temp += '</td>';
					temp += '<td class="merek">';
					temp += data[i]['merek']
					temp += '</td>';
					temp += '<td class="formula"><ul>';
					for (var n = 0, lgt = data[i]['komposisi'].length; n < lgt; n++) {
						temp += '<li>';
						temp += data[i]['komposisi'][n]['generik'];
						temp += ' ';
						temp += data[i]['komposisi'][n]['bobot'];
						temp += '</li>';
					}
					temp += '</ul></td>';
					temp += '<td class="jumlah">';
					temp += data[i].jumlah
					temp += '</td>';
					temp += '<td nowrap="" class="autofit action"> <form method="POST" action="' + base + '/home/obats/' + data[i]["id"]+ '" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+  $('meta[name="csrf-token"]').attr('content') +'"> <a class="btn btn-warning btn-sm" href="' + base + '/home/obats/' + data[i]["id"] + '/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> <button class="btn btn-danger btn-sm" onclick="return confirm(\"Anda yakin ingin menghapus ' + data[i]["id"]+ ' - ' + data[i]['merek'] + '?\")" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button> </form> </td>'
					temp += '</tr>';

					console.log('data.length');
					console.log(data.length);
					console.log('i');
					console.log(i);
					console.log('i < len');
					console.log(i < len);
				}
			} else {
				var colspan = $('#ajax_container').closest('table').find('th').length;
				temp += '<tr>';
				temp += '<td colspan="' + colspan + '" class="text-center">';
				temp += 'Tidak ada data untuk ditampilkan'
				temp += '</td>';
				temp += '</tr>';
			}
			console.log('i akhir');
			console.log(i);
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
