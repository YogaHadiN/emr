<?php

use Illuminate\Database\Seeder;

class GenerikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$generiks = DB::connection('mysql2')->table('generiks')->get();

		foreach ($generiks as $generik) {
			 DB::connection('mysql')->table('generiks')->insert([
					'generik'                => $generik->generik,
					'pregnancy_safety_index' => $generik->pregnancy_safety_index,
					'peroral'                => $generik->peroral,
					'parenteral'             => $generik->parenteral,
					'topical'                => $generik->topical,
					'opthalmic'              => $generik->opthalmic,
					'vaginal'                => $generik->vaginal,
					'inhalation'             => $generik->inhalation,
					'lingual'                => $generik->lingual,
					'transdermal'            => $generik->transdermal,
					'nasal'                  => $generik->nasal,
					'created_at'   => date('Y-m-d H:i:s'),
					'updated_at'   => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
