<?php

use Illuminate\Database\Seeder;
use App\JenisTarif;

class JenisTarifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$jenis_tarifs = DB::connection('mysql2')->table('jenis_tarifs')->get();
		$timestamp    = date('Y-m-d H:i:s');
		
		foreach ($jenis_tarifs as $jenis_tarif) {
			try {

				 DB::connection('mysql')->table('jenis_tarifs')->insert([
					'id'          => $jenis_tarif->id,
					'jenis_tarif' => $jenis_tarif->jenis_tarif,
					'coa_id'      => $jenis_tarif->coa_id,
					'user_id'     => '1',
					'created_at' => $timestamp,
					'updated_at' => $timestamp
				 ]);

			} catch (\Exception $e) {
				DB::statement('Update jenis_tarifs set id = 0 where id = 1;');
				$jt              = new JenisTarif;
				$jt->id          = $jenis_tarif->id ;
				$jt->jenis_tarif = $jenis_tarif->jenis_tarif ;
				$jt->coa_id      = $jenis_tarif->coa_id ;
				$jt->user_id     = '1';
				$jt->save();
			}
		}
    }
}
