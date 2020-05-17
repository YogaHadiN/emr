<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergi extends Model
{
	public function pasien(){
		return $this->belongsTo('App\Pasien');
	}
	public function generik(){
		return $this->belongsTo('App\Generik');
	}
}
