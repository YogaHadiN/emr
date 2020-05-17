<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
	public $incrementing = false;
	public function kelompokCoa(){
		return $this->belongsTo('App\KelompokCoa');
	}
}
