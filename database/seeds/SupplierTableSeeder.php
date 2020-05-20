<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$supplier          = new Supplier;
		$supplier->nama    = 'Berkat';
		$supplier->alamat  = 'Pamulang';
		$supplier->no_telp = '0213434243';
		$supplier->email   = 'yoga_demdfsdfa';
		$supplier->user_id = 1;
		$supplier->save();
    }
}
