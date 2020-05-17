		viewTelpon();
		viewAnak();
		function dummySubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function viewAnak(){
			var anaks = parseAnak();
			console.log(anaks);
			var temp = '';
			for (var i = 0; i < anaks.length; i++) {
				temp += '<tr>';
				temp += '<td class="i hide">' + i + '</td>';
				temp += '<td>' + anaks[i].nama + '</td>';
				temp += '<td> <button type="button" class="btn btn-danger btn-sm btn-block" onclick="hapusAnak(this); return false;">hapus</button> </td>';
				temp += '</tr>';
			}
			$('#body_anak').html(temp);
		}
		function parseAnak(){
			var anaks = $('#anaks').val();
			if($.trim(anaks) == ''){
				anaks = '[]';
			}
			anaks = JSON.parse(anaks);
			return anaks;
		}
		function inputAnak(control){
			var nama_anak = $(control).closest('tr').find('.nama_anak').val();
			var anaks = parseAnak();
			var newAnak = {
				'nama' : nama_anak
			};
			anaks.push(newAnak);
			anaks = JSON.stringify(anaks);
			$('#anaks').val(anaks);
			viewAnak();
			$('.nama_anak').val('');
			$('#nama_anak').focus();
		}
		function hapusAnak(control){
			var i = $(control).closest('tr').find('.i').html();
			var anaks = parseAnak();
			anaks.splice(i,1);
			anaks = JSON.stringify(anaks);
			$('#anaks').val(anaks);
			viewAnak();
			$('.nama_anak').val('');
			$('#nama_anak').focus();
		}
