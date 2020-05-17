<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public static function adaRestriksi($restriksi, $table_name, $permission_parameter ){
		$restriksi = json_decode($restriksi);
		if ( isset( $restriksi[$table_name] ) && $restriksi[$table_name][$permission_parameter] ) {
			return true;
		}
		return false;
	}
}
