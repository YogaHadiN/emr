<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AturanMinum;

class AturanMinum extends Model
{
	public static function selectList(){
		return  AturanMinum::pluck('aturan_minum', 'id')->all();
	}
	
}
