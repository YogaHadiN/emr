<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Satuan;

class Satuan extends Model
{
	public static function selectList(){
		return  Satuan::pluck('satuan', 'satuan')->all();
	}
}
