<?php

use Illuminate\Database\Seeder;

class TarifTableSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$query  = "SELECT * ";
		$query .= "FROM tarifs ";
		$query .= "WHERE ";
		$query .= "asuransi_id = 0; ";
		$data = DB::select($query);
		$tarifs = DB::connection('mysql2')->select($query);

		foreach ($tarifs as $tarif) {
			if (is_null($tarif->bhp_items)) {
				$tarif->bhp_items = '[]';
			}
			 DB::connection('mysql')->table('tarifs')->insert([
					'jenis_tarif_id'   => $tarif->jenis_tarif_id,
					'biaya'            => $tarif->biaya,
					'asuransi_id'      => '1',
					'user_id'          => '1',
					'jasa_dokter'      => $tarif->jasa_dokter,
					'bhp_items'        => $tarif->bhp_items,
					'created_at'   => date('Y-m-d H:i:s'),
					'updated_at'   => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
