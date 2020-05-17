<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
}
