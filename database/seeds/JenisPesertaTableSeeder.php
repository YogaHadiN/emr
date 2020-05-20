<?php

use Illuminate\Database\Seeder;
use App\JenisPeserta;

class JenisPesertaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		JenisPeserta::truncate();
		$data = [
			'peserta',
			'suami',
			'istri',
			'anak'
		];

		foreach ($data as $d) {
			$jp                = new JenisPeserta;
			$jp->jenis_peserta = $d;
			$jp->user_id = 1;
			$jp->save();
		}
		
    }
}
