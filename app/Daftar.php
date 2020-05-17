<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
	public function pasien(){
		return $this->belongsTo('App\Pasien');
	}
	public function staf(){
		return $this->belongsTo('App\Staf');
	}
	public function asuransi(){
		return $this->belongsTo('App\Asuransi');
	}
	public function poli(){
		return $this->belongsTo('App\Poli');
	}
}
