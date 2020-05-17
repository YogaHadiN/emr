<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obat;

class Obat extends Model
{
	public static function selectList(){
		return Obat::pluck('merek', 'id')->all();
	}
	public static function selectListById($id){
		$obat    = Obat::find( $id );
		$formula = $obat->formula;
		return Obat::where('id', '>', 3)->where('formula', $formula)->pluck('merek', 'id')->all();
	}
	public function komposisi(){
		return $this->hasMany('App\Komposisi');
	}
}


