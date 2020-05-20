<?php

use Illuminate\Database\Seeder;

class PeriksaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$periksas = DB::connection('mysql2')->table('periksas')->get();
		foreach ($periksas as $periksa) {
			$data[] = [
					'waktu_datang'                     => $periksa->waktu_datang,
					'asuransi_id'                      => 1,
					'pasien_id'                        => $periksa->pasien_id,
					'staf_id'                          => 1,
					'anamnesa'                         => $periksa->anamnesa,
					'pemeriksaan_fisik'                => $periksa->pemeriksaan_fisik,
					'pemeriksaan_penunjang'            => $periksa->pemeriksaan_penunjang,
					'diagnosa_id'                      => $periksa->diagnosa_id,
					'keterangan_diagnosa'              => $periksa->keterangan_diagnosa,
					'terapi'                           => $periksa->terapi,
					'piutang'                          => $periksa->piutang,
					'tunai'                            => $periksa->tunai,
					'poli'                             => $periksa->poli,
					'waktu_periksa'                    => date('Y-m-d H:i:s'),
					'waktu_masuk_apotek'               => date('Y-m-d H:i:s'),
					'transaksi'                        => $periksa->transaksi,
					'berat_badan'                      => $periksa->berat_badan,
					'satisfaction_index'               => $periksa->satisfaction_index,
					'piutang_dibayar'                  => $periksa->piutang_dibayar,
					'tanggal_piutang_dibayar_asuransi' => $periksa->tanggal_piutang_dibayar_asuransi,
					'asisten_id'                       => $periksa->asisten_id,
					'waktu_selesai_apotek'             => date('Y-m-d H:i:s'),
					'kecelakaan_kerja'                 => $periksa->kecelakaan_kerja,
					'resepluar'                        => $periksa->resepluar,
					'pembayaran'                       => $periksa->pembayaran,
					'kembalian'                        => $periksa->kembalian,
					'nomor_asuransi'                   => $periksa->nomor_asuransi,
					'nurse_station_id'                 => $periksa->nurse_station_id,
					'sistolik'                         => $periksa->sistolik,
					'diastolik'                        => $periksa->diastolik,
					'user_id'                          => 1
			];
		}
		App\Periksa::insert($data);
    }
}
