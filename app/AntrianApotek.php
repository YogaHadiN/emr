<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntrianApotek extends Model
{
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
}
