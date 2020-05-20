<?php

use Illuminate\Database\Seeder;
use App\Asuransi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call(AsuransisTableSeeder::class);
		$this->call(AturanMinumTableSeeder::class);
		$this->call(CoaTableSeeder::class);
		$this->call(GenerikTableSeeder::class);
		$this->call(SupplierTableSeeder::class);
		$this->call(JenisPesertaTableSeeder::class);
		$this->call(JenisTarifTableSeeder::class);
		$this->call(KelompokCoaTableSeeder::class);
		$this->call(ObatTableSeeder::class);
		$this->call(PasiensTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(StafsTableSeeder::class);
		$this->call(TarifTableSeedeer::class);
		$this->call(UserTableSeeder::class);
		$this->call(PoliTableSeeder::class);
		$this->call(IcdTableSeeder::class);
		$this->call(DiagnosaTableSeeder::class);
		$this->call(SignaTableSeeder::class);
		$this->call(SediaanTableSeeder::class);
		$this->call(SatuanTableSeeder::class);
		/* $this->call(PeriksaTableSeeder::class); */
    }
}

