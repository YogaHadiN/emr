<?php

use Illuminate\Database\Seeder;

class IcdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$icds = DB::connection('mysql2')->table('icd10s')->get();

		foreach ($icds as $icd) {
			 DB::connection('mysql')->table('icds')->insert([
					'id'          => $icd->id,
					'diagnosaICD' => $icd->diagnosaICD,
					'admedika'    => $icd->admedika,
					'created_at'  => date('Y-m-d H:i:s'),
					'updated_at'  => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
