<?php

use Illuminate\Database\Seeder;

class DiagnosaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$diagnosas = DB::connection('mysql2')->table('diagnosas')->get();

		foreach ($diagnosas as $diagnosa) {
			 DB::connection('mysql')->table('diagnosas')->insert([
					'diagnosa'   => $diagnosa->diagnosa,
					'icd_id'     => $diagnosa->icd10_id,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
