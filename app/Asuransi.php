<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
	public function jenisPeserta(){
		return array(
					null => ' - pilih asuransi -',  
		            "P" => 'Peserta',
		            "S" => 'Suami',
		            "I" => 'Istri',
		            "A" => 'Anak'
		);
	}
}
