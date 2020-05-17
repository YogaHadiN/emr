<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPeriksa extends Model
{
	protected $guarded = ['id'];
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
	public function tarif(){
		return $this->belongsTo('App\Tarif');
	}
	public function asistenTindakan(){
		return $this->belongsTo('App\Staf', 'asisten_tindakan_id');
	}
}
