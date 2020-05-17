<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseStation extends Model
{
	public function staf(){
		return $this->belongsTo('App\Staf');
	}
	public function asisten(){
		return $this->belongsTo('App\Staf', 'asisten_id');
	}
	public function asuransi(){
		return $this->belongsTo('App\Asuransi');
	}
	public function pasien(){
		return $this->belongsTo('App\Pasien');
	}
	public function poli(){
		return $this->belongsTo('App\Poli');
	}
	public function transaksi(){
		return $this->hasMany('App\TransaksiPeriksa');
	}
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
}
