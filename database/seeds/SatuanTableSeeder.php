<?php

use Illuminate\Database\Seeder;
use App\Satuan;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$satuans = [
			"mg",
			"gr",
			"ui",
			"mcg",
			"%",
			"mg/ml"
		];

		$timestamp = date('Y-m-d H:i:s');
		$data = [];
		foreach ($satuans as $satuan) {
			$data[] = [
				'satuan'     => $satuan,
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Satuan::insert($data);
    }
}
