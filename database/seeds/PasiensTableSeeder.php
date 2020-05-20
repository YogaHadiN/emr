<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Pasien;

class PasiensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
	 
		$pasiens = [];
		for($i = 1; $i <= 1000; $i++){
			$sex = rand(0,1);
			$pasiens[] = [
				'nama'          => $faker->name,
				'alamat'        => $faker->address,
				'sex'           => $sex,
				'asuransi_id'   => '1',
				'user_id'       => '1',
				'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
				'no_telp'       => $faker->e164PhoneNumber
			];
		}
		Pasien::insert($pasiens);
	}
}
