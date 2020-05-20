<?php

use Illuminate\Database\Seeder;

class SediaanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$sediaans = DB::connection('mysql2')->table('sediaans')->get();

		foreach ($sediaans as $sediaan) {
			 DB::connection('mysql')->table('sediaans')->insert([
					'sediaan'    => $sediaan->sediaan,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
