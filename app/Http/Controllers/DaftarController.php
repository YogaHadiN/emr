<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Daftar;
use App\Asuransi;
use App\Pasien;
use Input;
use App\Yoga;
use DB;
use Auth;

class DaftarController extends Controller
{
	public function index(){
		$daftars = Daftar::where('user_id', Auth::id())->orderBy('waktu', 'desc')->get();
		return view('daftars.index', compact(
			'daftars'
		));
	}
	public function create($id){
		$pasien = Pasien::find( $id );
		$ps               = new Pasien;
		$as               = new Asuransi;
		$statusPernikahan = $ps->statusPernikahan();
		$panggilan        = $ps->panggilan();
		$asuransi_list         = [
			null => '- Pilih Pembayaran -',
			'1' => 'Biaya Pribadi'
		];
		if ($pasien->asuransi_id > 1) {
			$asuransi_list[$pasien->asuransi_id] = $pasien->asuransi->nama_asuransi;
		}
		$jenis_peserta    = $as->jenisPeserta();
		$peserta          = [ null => '- Pilih -', '0' => 'Peserta Klinik', '1' => 'Bukan Peserta Klinik'];
		$poli             = Yoga::poliList();
		$staf             = Yoga::stafList();
		$pasien_id             = $id;
		return view('daftars.create', compact(
			'poli',
			'pasien',
			'staf',
			'peserta',
			'jenis_peserta',
			'asuransi_list'
		));
	}
	public function edit($id){

		$daftar = Daftar::find($id);
		$ps               = new Pasien;
		$as               = new Asuransi;
		$statusPernikahan = $ps->statusPernikahan();
		$panggilan        = $ps->panggilan();
		$asuransi_list         = [
			'1' => 'Biaya Pribadi'
		];
		if ($daftar->pasien->asuransi_id > 1) {
			$asuransi_list[$pasien->asuransi_id] = $pasien->asuransi->nama_asuransi;
		}
		$jenis_peserta    = $as->jenisPeserta();
		$peserta          = [ null => '- Pilih -', '0' => 'Peserta Klinik', '1' => 'Bukan Peserta Klinik'];
		$poli             = Yoga::poliList();
		$staf             = Yoga::stafList();
		return view('daftars.edit', compact(
			'daftar',
			'poli',
			'staf',
			'peserta',
			'jenis_peserta',
			'asuransi_list'
		));
	}
	public function store(Request $request){
		/* return Input::all(); */ 
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$daftar              = new Daftar;
		$daftar->pasien_id   = Input::get('pasien_id');
		$daftar->asuransi_id = Input::get('asuransi_id');
		$daftar->poli_id     = Input::get('poli_id');
		$daftar->staf_id     = Input::get('staf_id');
		$daftar->waktu       = Input::get('waktu');
		$daftar->user_id     = Auth::id();
		$daftar->save();


		$pasien = Pasien::find( Input::get('pasien_id') );
		$pesan = Yoga::suksesFlash('<strong>' . $pasien->nama. '</strong> BERHASIL didaftarkan');
		return redirect('home/pasiens')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$daftar              = Daftar::find($id);
		$daftar->asuransi_id = Input::get('asuransi_id');
		$daftar->poli_id     = Input::get('poli_id');
		$daftar->staf_id     = Input::get('staf_id');
		$daftar->save();

		$pesan = Yoga::suksesFlash('Daftar berhasil diupdate');
		return redirect('home/daftars')->withPesan($pesan);
	}
	public function destroy($id){
		Daftar::destroy($id);
		$pesan = Yoga::suksesFlash('Daftar berhasil dihapus');
		return redirect('home/daftars')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$daftars     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$daftars[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Daftar::insert($daftars);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'pasien_id'   => 'required',
			'asuransi_id' => 'required',
			'poli_id'     => 'required',
			'staf_id'     => 'required',
			'waktu'     => 'required|date'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
