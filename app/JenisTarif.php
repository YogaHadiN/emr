<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JenisTarif;
use Auth;

class JenisTarif extends Model
{

	public $incrementing = false;

	public function coa(){
		return $this->belongsTo('App\Coa');
	}
	public static function selectListById(){
		return JenisTarif::where('user_id', Auth::id())->pluck('jenis_tarif', 'id')->all();
	}
	
}
