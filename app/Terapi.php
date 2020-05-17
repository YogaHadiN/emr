<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terapi extends Model
{
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
	public function obat(){
		return $this->belongsTo('App\Obat');
	}
	public function signa(){
		return $this->belongsTo('App\Signa');
	}
	public function aturanMinum(){
		return $this->belongsTo('App\AturanMinum');
	}
}
