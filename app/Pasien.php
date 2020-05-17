<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
	public function panggilan(){
		return array(
					null => '-Panggilan-',
					'Tn' => 'Tn (Laki dewasa)',
					'Ny' => 'Ny (Wanita Dewasa Menikah)',
					'Nn' => 'Nn (Wanita Dewasa Belum Menikah)',
					'An' => 'An (Anak-anak diatas 3 tahun)',
					'By' => 'By (Anak2 dibawah 3 tahun)'
					);
	
	}

	public function statusPernikahan(){
		return array( 
			null     => '- Status Pernikahan -',
			'Pernah' => 'Pernah Menikah',
			'Belum'  => 'Belum Menikah'
		);
	}
	public function asuransi(){
		return $this->belongsTo('App\Asuransi');
	}
	public function getJeniskelaminAttribute(){
		$sex = $this->sex;
		if ($sex) {
			return 'Laki-laki';
		}
		return 'Wanita';
	}

	public function periksa(){
		return $this->hasMany('App\Periksa');
	}

	public function getUmurAttribute(){
		$tanggal_lahir = $this->tanggal_lahir;

		if (!empty( $tanggal_lahir )) {
			return Yoga::datediff( $tanggal_lahir, date('Y-m-d') );
		} else {
			return 'Tidak ada data Tanggal Lahir';
		}
	}
	public function alergi(){
		return $this->hasMany('App\Alergi');
	}
}
