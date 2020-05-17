var data = {};
if ( $('#json_data').val() != '' ) {
	data = $('#json_data').val();
	data = JSON.parse(data);
} 
function readChange(control){
	console.log('readChange');
	if( control.checked ){
		$(control).closest('tr').find('.create').prop('checked', true);
		$(control).closest('tr').find('.update').prop('checked', true);
		$(control).closest('tr').find('.delete').prop('checked', true);
		$(control).closest('tr').find('.create').attr('disabled', false);
		$(control).closest('tr').find('.update').attr('disabled', false);
		$(control).closest('tr').find('.delete').attr('disabled', false);
	} else {
		$(control).closest('tr').find('.create').prop('checked', false);
		$(control).closest('tr').find('.create').attr('disabled', true);

		$(control).closest('tr').find('.update').prop('checked', false);
		$(control).closest('tr').find('.update').attr('disabled', true);

		$(control).closest('tr').find('.delete').prop('checked', false);
		$(control).closest('tr').find('.delete').attr('disabled', true);
	}
	updateData(control);
}

function createChange(control){
	console.log('createChange');
	updateData(control);
}

function updateChange(control){
	console.log('updateChange');
	updateData(control);
}

function deleteChange(control){
	console.log('deleteChange');
	updateData(control);
}

function updateData(ini){
	var table_name = $(ini).closest('tr').find('.table_name').html();
	if(cekIfAnyUnchecked(ini)){
		var read = !$(ini).closest('tr').find('.read').prop('checked');
		var update = !$(ini).closest('tr').find('.update').prop('checked');
		var del = !$(ini).closest('tr').find('.delete').prop('checked');
		var create = !$(ini).closest('tr').find('.create').prop('checked');
		

		data[table_name] = {
				'read' : read,
				'update' : update,
				'delete' : del,
				'create' : create
			};


	} else {
		delete data[table_name];
	}
	console.log('data update');
	console.log(data);
	$('#json_data').val( JSON.stringify(data) );
}

function cekIfAnyUnchecked(control){
	var unchecked = false;
	$(control).closest('tr').find('input').each(function(){
		console.log('checked this');
		console.log($(this).prop('checked'));
		if(
			$(this).prop('checked') == false
		){
			unchecked = true;
			return false;
		}
	});
	return unchecked;
}




