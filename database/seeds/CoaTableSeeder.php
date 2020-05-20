<?php

use Illuminate\Database\Seeder;

class CoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$coas = DB::connection('mysql2')->table('coas')->get();
		foreach ($coas as $coa) {
			 DB::connection('mysql')->table('coas')->insert([
					'id'              => $coa->id,
					'kelompok_coa_id' => $coa->kelompok_coa_id,
					'saldo_awal'      => $coa->saldo_awal,
					'coa'             => $coa->coa,
					'created_at'   => date('Y-m-d H:i:s'),
					'updated_at'   => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
