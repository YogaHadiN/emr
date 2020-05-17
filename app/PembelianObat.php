<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianObat extends Model
{
	public function obat(){
		return $this->belongsTo('App\Obat');
	}
}
