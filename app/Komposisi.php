<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komposisi extends Model
{
	public function generik(){
		return $this->belongsTo('App\Generik');
	}
}
