<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diagnosa;

class Diagnosa extends Model
{
	public function icd(){
		return $this->belongsTo('App\Icd');
	}
	public static function selectList(){
		$data      = [];
		$diagnosas = Diagnosa::with('icd')->get();
		foreach ($diagnosas as $diagnosa) {
			$data[ $diagnosa->id ] = $diagnosa->diagnosa . ' - ' . $diagnosa->icd_id . ' | ' . $diagnosa->icd->diagnosaICD;
		}
		return $data;
	}
}
