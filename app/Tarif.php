<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tarif;
use Auth;

class Tarif extends Model
{
	public static function selectList($asuransi_id){
		$data = [];
		$tarifs = Tarif::with('jenisTarif')->where('user_id', Auth::id())->where('asuransi_id', $asuransi_id)->get();
		foreach ($tarifs as $tarif) {
			$data[$tarif->id] =  $tarif->jenisTarif->jenis_tarif;
		}
		return $data;
	}

	public function jenisTarif(){
		return $this->belongsTo('App\JenisTarif');
	}
	
}
