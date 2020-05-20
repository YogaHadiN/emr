<?php

use Illuminate\Database\Seeder;

class PoliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$datas = [
			[
				'poli' =>'Poli Umum' ,
				'user_id' => '1',
			],
			[
				'poli' =>'Poli Gawat Darurat' ,
				'user_id' => '1',
			],
			[
				'poli' =>'Poli Estetika' ,
				'user_id' => '1',
			],
			[
				'poli' =>'Poli Gigi' ,
				'user_id' => '1',
			],
			[
				'poli' =>'Poli Kandungan' ,
				'user_id' => '1',
			]
		];

		App\Poli::insert($datas);
    }
}
