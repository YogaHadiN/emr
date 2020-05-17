		function dummySubmit(control){
			alert('yuhuu');
			var submitNih = true;

			$('#tableTelp tbody tr').each( function(i){
				var telp = $(this).find('.no_telp').val();
				var jenis_telp = $(this).find('.jenis_telpon').val();

				console.log( telp == '' );
				console.log( jenis_telp == '' );

				if(
						(telp == '' && jenis_telp != '') ||
						(telp != '' && jenis_telp == '')
				  ){
					submitNih = false;
				}
			});
			if( submitNih ){
				siapSubmit(control);
			} else {
				alert('kolom telpon harus diisi semuanya atau dikosongkan semuanya');
			}
			console.log('submitNih : ' + submitNih);
		}

		function siapSubmit(control){
			if(validatePass2(control)){
				$('#submit').click();
			}
		}
		function tambahTelp(control){
			if(
					$(control).closest('tr').find('.jenis_telpon').val() != '' ||
					$(control).closest('tr').find('.no_telp').val() != ''
			  ){
				var html = $('#contoh').html();
				$(control).closest('tr').after(html);
				$(control).closest('tr').find('.fa').removeClass().addClass('fa fa-minus');
				$(control).closest('tr')
					.find('.btn-primary')
					.removeClass()
					.addClass('btn btn-danger btn-sm')
					.attr('onclick', 'kurangTelp(this);return false;');
			}
		}
		function kurangTelp(control){
			$(control).closest('tr').remove();
		}
