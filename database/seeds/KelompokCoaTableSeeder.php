<?php

use Illuminate\Database\Seeder;

class KelompokCoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$kelompok_coas = DB::connection('mysql2')->table('kelompok_coas')->get();

		foreach ($kelompok_coas as $kelompok_coa) {
			 DB::connection('mysql')->table('kelompok_coas')->insert([
					'id'           => $kelompok_coa->id,
					'kelompok_coa' => $kelompok_coa->kelompok_coa,
					'created_at'   => date('Y-m-d H:i:s'),
					'updated_at'   => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
