<?php

use Illuminate\Database\Seeder;

class SignaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$signas = DB::connection('mysql2')->table('signas')->get();

		foreach ($signas as $signa) {
			 DB::connection('mysql')->table('signas')->insert([
					'signa'      => $signa->signa,
					'user_id'    => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
			 ]);
		}
    }
}
