<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NurseStation;
use Input;
use App\Yoga;
use App\Daftar;
use DB;
use Auth;

class NurseStationController extends Controller
{	
	public function index(){
		$nurse_stations = NurseStation::where('user_id', Auth::id())->get();
		return view('nurse_stations.index', compact(
			'nurse_stations'
		));
	}
	public function create($id){


		$daftar = Daftar::find( $id );
		$asuransi_list = [
			null => '- Pilih Pembayaran -',
			1 => 'Biaya Pribadi'
		];
		if ($daftar->pasien->asuransi_id > 1) {
			$asuransi_list[$daftar->pasien->asuransi_id] = $daftar->pasien->asuransi->nama_asuransi;
		}
		return view('nurse_stations.create', compact(
			'daftar',
			'asuransi_list'
		));
	}
	public function edit($id){
		$nurse_station = NurseStation::find($id);
		return view('nurse_stations.edit', compact('nurse_station'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$daftar                              = Daftar::find( Input::get('id') );
		$nurse_station                       = new NurseStation;
		$nurse_station->asuransi_id          = $daftar->asuransi_id;
		$nurse_station->poli_id              = $daftar->poli_id;
		$nurse_station->pasien_id            = $daftar->pasien_id;
		$nurse_station->staf_id              = $daftar->staf_id;
		$nurse_station->waktu                = $daftar->waktu;
		if ( !empty( Input::get('hamil') ) ) {
			$nurse_station->hamil            = Input::get('hamil');
		}
		$nurse_station->tinggi_badan         = Input::get('tinggi_badan');
		$nurse_station->berat_badan          = Input::get('berat_badan');
		$nurse_station->suhu                 = Input::get('suhu');
		$nurse_station->asisten_id           = Input::get('asisten_id');
		if ( !empty( Input::get('kecelakaan_kerja') ) ) {
			$nurse_station->kecelakaan_kerja = Input::get('kecelakaan_kerja');
		}
		$nurse_station->sistolik             = Input::get('sistolik');
		$nurse_station->diastolik            = Input::get('diastolik');
		$nurse_station->user_id              = Auth::id();

		if($nurse_station->save()){
			$daftar->delete();
		}
		$pesan = Yoga::suksesFlash('pasien <strong>' . $daftar->pasien->nama . '</strong> berhasil masuk antrian poli <strong>' . $daftar->poli->poli) . '</strong>';
		return redirect('home/daftars')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$nurse_station                   = NurseStation::find($id);
		$nurse_station->hamil            = Input::get('hamil');
		$nurse_station->tinggi_badan     = Input::get('tinggi_badan');
		$nurse_station->berat_badan      = Input::get('berat_badan');
		$nurse_station->suhu             = Input::get('suhu');
		$nurse_station->asisten_id       = Input::get('asisten_id');
		$nurse_station->kecelakaan_kerja = Input::get('kecelakaan_kerja');
		$nurse_station->sistolik         = Input::get('sistolik');
		$nurse_station->diastolik        = Input::get('diastolik');
		$nurse_station->save();
		$poli_id = $nurse_station->poli_id;
		$pesan = Yoga::suksesFlash('NurseStation berhasil diupdate');
		return redirect('home/polis/' . $poli_id)->withPesan($pesan);
	}
	public function destroy($id){
		$antrian = NurseStation::find($id);
		$nama_pasien = $antrian->pasien->nama;
		$poli_id = $antrian->poli_id;
		$poli = $antrian->poli->poli;
		$antrian->delete();
		$pesan = Yoga::suksesFlash($nama_pasien . ' BERHASIL dihapus dari antrian ' . $poli);
		return redirect('home/polis/' . $poli_id)->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$nurse_stations     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$nurse_stations[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		NurseStation::insert($nurse_stations);
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
}
