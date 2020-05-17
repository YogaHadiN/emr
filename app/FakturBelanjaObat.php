<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FakturBelanjaObat extends Model
{
	public function staf(){
		return $this->belongsTo('App\Staf');
	}
	public function supplier(){
		return $this->belongsTo('App\Supplier');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function pembelianObat(){
		return $this->hasMany('App\PembelianObat');
	}
	public function getTotalBelanjaAttribute(){

		$pembelianObats = $this->pembelianObat;

		$total_belanja = 0;
		foreach ($pembelianObats as $pembelian) {
			$total_belanja += $pembelian->harga_beli * $pembelian->jumlah;
		}

		return $total_belanja;
		
	}
	
}
