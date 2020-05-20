<?php

use Illuminate\Database\Seeder;

class TerapiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$terapis = DB::connection('mysql2')->table('terapis')->get();
		$datas = [];
		foreach ($terapis as $model) {
			$data[] = [
					'obat_id'           => $model->merek_id,
					'signa'             => $model->signa,
					'aturan_minum'      => $model->aturan_minum,
					'jumlah'            => $model->jumlah,
					'harga_beli_satuan' => $model->harga_beli_satuan,
					'harga_jual_satuan' => $model->harga_jual_satuan,
					'periksa_id'        => $model->periksa_id,
					'user_id'           => 1
			];
		}
		App\Terapi::insert($data);
    }
}
