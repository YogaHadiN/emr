@if( isset( $restriction[ $table->Tables_in_emr ] ) )
<td>
	<label class="checkbox-inline">
		@if( $restriction[  $table->Tables_in_emr  ]['read'] )
			<input type="checkbox" class="read" value="read" unchecked onchange="readChange(this);return false"> Read
		@else
			<input type="checkbox" class="read" value="read" checked onchange="readChange(this);return false"> Read
		@endif
	</label>
</td>
<td>
	<label class="checkbox-inline">
		@if( $restriction[  $table->Tables_in_emr  ]['create'] )
		  <input type="checkbox" class="create" value="create" unchecked onchange="createChange(this);return false"> Create
		@else
		  <input type="checkbox" class="create" value="create" checked onchange="createChange(this);return false"> Create
		@endif
	</label>
</td>
<td>
	<label class="checkbox-inline">
		@if( $restriction[  $table->Tables_in_emr  ]['update'] )
		  <input type="checkbox" class="update" value="update" unchecked onchange="updateChange(this);return false"> Update
		@else
		  <input type="checkbox" class="update" value="update" checked onchange="updateChange(this);return false"> Update
		@endif
	</label>
</td>
<td>
	<label class="checkbox-inline">
		@if( $restriction[  $table->Tables_in_emr  ]['delete'] )
		  <input type="checkbox" class="delete" value="delete" unchecked onchange="deleteChange(this);return false"> Delete
		@else
		  <input type="checkbox" class="delete" value="delete" checked onchange="deleteChange(this);return false"> Delete
		@endif
	</label>
</td>
@else
	@include('roles.tidis')
@endif
