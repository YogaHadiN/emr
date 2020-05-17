<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icd extends Model
{
	public $incrementing = false;

	public static function selectList(){
		$data = [];
		$icds = Icd::all();
		foreach ($icds as $icd) {
			$data[ $icd->id ] = $icd->diagnosaICD;
		}
		return $data;
	}
	
}
