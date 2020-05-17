<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Generik;

class Generik extends Model
{
	public static function selectList(){
		return  Generik::pluck('generik', 'id')->all();
	}
}
