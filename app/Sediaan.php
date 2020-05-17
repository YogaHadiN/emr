<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sediaan;

class Sediaan extends Model
{
	public static function selectList(){
		return  Sediaan::pluck('sediaan', 'sediaan')->all();
	}
	
}
