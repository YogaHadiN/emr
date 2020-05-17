<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Signa;

class Signa extends Model
{
	public static function selectList(){
		return  Signa::pluck('signa', 'id')->all();
	}
}
