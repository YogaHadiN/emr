<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Supplier;
use Auth;

class Supplier extends Model
{
	public static function selectList(){
		return array(null => '- Pilih Supplier -') + Supplier::where('user_id', Auth::id())->pluck('nama', 'id')->all();
	}
}
