<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AntrianApotek;
use App\NurseStation;
use Input;
use Auth;
use App\Yoga;
use App\Signa;
use App\AturanMinum;
use App\Kasir;
use App\Terapi;
use App\Periksa;
use App\Obat;
use DB;

class AntrianApotekController extends Controller
{
	public function index(){
		$antrian_apoteks = AntrianApotek::with('periksa.asuransi', 'periksa.pasien')->get();
		return view('antrian_apoteks.index', compact(
			'antrian_apoteks'
		));
	}
	public function create($id){
		$antrian_apotek = AntrianApotek::with(
			'periksa.pasien', 
			'periksa.terapis.obat', 
			'periksa.terapis.signa',
			'periksa.terapis.aturanMinum'
		)->where('id', $id )->first();
		$formulas = [];
		foreach ($antrian_apotek->periksa->terapis as $terapi) {
			$formulas[] = $terapi->obat->formula;
		}
		$obats = Obat::whereIn('formula', $formulas)->get();
		$obat_list = [];

		foreach ($obats as $obat) {
			$obat_list[$obat->formula][$obat->id] = $obat->merek;
		}

		return view('antrian_apoteks.create', compact(
			'obat_list',
			'antrian_apotek'
		));
	}
	public function edit($id){
		$antrian_apotek = AntrianApotek::find($id);
		return view('antrian_apoteks.edit', compact('antrian_apotek'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		DB::beginTransaction();
		try {
			$id             = Input::get('antrian_apotek_id');
			$terapis        = json_decode(Input::get('terapi'), true);
			$antrian_apotek = AntrianApotek::find( $id );

			Terapi::where('periksa_id', $antrian_apotek->periksa_id)->delete();

			$data_terapis = [];
			$terapi_json = [];

			foreach ($terapis as $terapi) {
				$obat = Obat::find( $terapi['obat_id'] );
				$data_terapis[] = [
					'tipe_resep_id'     => $terapi['tipe_resep_id'],
					'signa_id'          => $terapi['signa_id'],
					'obat_id'           => $terapi['obat_id'],
					'aturan_minum_id'   => $terapi['aturan_minum_id'],
					'jumlah'            => $terapi['jumlah'],
					'harga_beli_satuan' => $obat->harga_beli,
					'harga_jual_satuan' => $obat->harga_jual,
					'periksa_id'        => $antrian_apotek->periksa_id,
					'nurse_station_id'  => $antrian_apotek->periksa->nurse_station_id,
					'user_id'           => Auth::id()
				];
				$terapi_json[] = [
					'signa_id'          => $terapi['signa_id'],
					'signa_text'        => Signa::find( $terapi['signa_id'] )->signa,
					'aturan_minum_text' => AturanMinum::find( $terapi['aturan_minum_id'] )->aturan_minum,
					'aturan_minum_id'   => $terapi['aturan_minum_id'],
					'obat_id'           => $terapi['obat_id'],
					'obat_text'         => $terapi['obat_text'],
					'jumlah'            => $terapi['jumlah']
				];
			}

			Terapi::insert($data_terapis);

			$periksa              = Periksa::find($antrian_apotek->periksa_id);
			$periksa->terapi      = json_encode($terapi_json);

			foreach ($terapis as $k=> $t) {
				$terapis[$k]['formula'] = Obat::find( $t['obat_id'] )->formula;
			}

			usort($terapi_json, function($a, $b) {
				return $a['obat_id'] <=> $b['obat_id'];
			});

			$periksa->terapi_sort = json_encode($terapi_json);
			$periksa->save();

			$antrian_apotek->delete();

			$kasir             = new Kasir;
			$kasir->user_id    = Auth::id();
			$kasir->periksa_id = $antrian_apotek->periksa_id;
			$kasir->save();

			$antrian_apotek->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash('AntrianApotek baru berhasil dibuat');
		return redirect('home/antrian_apoteks')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$antrian_apotek     = AntrianApotek::find($id);
		// Edit disini untuk simpan data
		$antrian_apotek->save();
		$pesan = Yoga::suksesFlash('AntrianApotek berhasil diupdate');
		return redirect('home/antrian_apoteks')->withPesan($pesan);
	}
	public function destroy($id){
		AntrianApotek::destroy($id);
		$pesan = Yoga::suksesFlash('AntrianApotek berhasil dihapus');
		return redirect('home/antrian_apoteks')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$antrian_apoteks     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$antrian_apoteks[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		AntrianApotek::insert($antrian_apoteks);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [

		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function kembalikan($id){

		DB::beginTransaction();
		try {
			
			$antrian_apotek = AntrianApotek::with('periksa')->where('id', $id)->first();

			$nurse_station                   = new NurseStation;
			$nurse_station->asuransi_id      = $antrian_apotek->periksa->asuransi_id;
			$nurse_station->poli_id          = $antrian_apotek->periksa->poli_id;
			$nurse_station->pasien_id        = $antrian_apotek->periksa->pasien_id;
			$nurse_station->staf_id          = $antrian_apotek->periksa->staf_id;
			$nurse_station->waktu            = $antrian_apotek->periksa->waktu_datang;
			$nurse_station->hamil            = $antrian_apotek->periksa->hamil;
			$nurse_station->tinggi_badan     = $antrian_apotek->periksa->tinggi_badan;
			$nurse_station->berat_badan      = $antrian_apotek->periksa->berat_badan;
			$nurse_station->suhu             = $antrian_apotek->periksa->suhu;
			$nurse_station->asisten_id       = $antrian_apotek->periksa->asisten_id;
			$nurse_station->kecelakaan_kerja = $antrian_apotek->periksa->kecelakaan_kerja;
			$nurse_station->sistolik         = $antrian_apotek->periksa->sistolik;
			$nurse_station->diastolik        = $antrian_apotek->periksa->diastolik;
			$nurse_station->random_string    = $antrian_apotek->periksa->random_string;
			$nurse_station->periksa_id       = $antrian_apotek->periksa_id;
			$nurse_station->diagnosa_id      = $antrian_apotek->periksa->diagnosa_id;
			$nurse_station->user_id          = Auth::id();
			$nurse_station->save();
			$nama = $antrian_apotek->periksa->pasien->nama;

			$periksa                   = Periksa::find($antrian_apotek->periksa_id);
			$periksa->nurse_station_id = $nurse_station->id;
			$periksa->save();

			$antrian_apotek->delete();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
		$pesan = Yoga::suksesFlash('Pasien ' . $nama . ' berhasil dikembalikan');
		return redirect('home/antrian_apoteks')->withPesan($pesan);
	}
}
