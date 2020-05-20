<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kasir;
use App\Periksa;
use App\Tarif;
use App\Obat;
use App\AntrianApotek;
use Input;
use App\Yoga;
use App\JenisTarif;
use DB;
use Auth;

class KasirController extends Controller
{
	public function index(){
		$kasirs = Kasir::all();
		return view('kasirs.index', compact(
			'kasirs'
		));
	}
	public function create($id){
		$kasir = Kasir::with(
			'periksa.pasien', 
			'periksa.asuransi',
			'periksa.asisten',
			'periksa.terapis.obat',
			'periksa.staf'
		)->where('id', $id )->first();

		$jenis_tarif_list = JenisTarif::selectListById();

		$total_biaya_obat = 0;
		foreach ($kasir->periksa->terapis as $terapi) {
			$total_biaya_obat += $terapi->jumlah * $terapi->obat->harga_jual;
		}

		$total_biaya_tindakan = 0;
		foreach ($kasir->periksa->transaksiPeriksa as $transaksi) {
			$total_biaya_tindakan += $transaksi->biaya;
		}

		$total_biaya = $total_biaya_tindakan + $total_biaya_obat;
		return view('kasirs.create', compact(
			'kasir', 
			'jenis_tarif_list',
			'total_biaya',
			'total_biaya_obat'
		));
	}
	public function edit($id){
		$kasir = Kasir::find($id);
		return view('kasirs.edit', compact('kasir'));
	}
	public function store(Request $request){
		/* return Input::all(); */ 
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}

			$jenis_tarif_ids = Input::get('jenis_tarif_id');
			$biaya           = Input::get('biaya');
			$periksa_id      = Input::get('periksa_id');
			$kasir_id        = Input::get('kasir_id');

			$nota = [];

			foreach ($jenis_tarif_ids as $k => $jenisTarif) {
				if (!is_null($jenisTarif)) {
					$nota[] = [
						'jenis_tarif' => JenisTarif::find($jenisTarif)->jenis_tarif,
						'biaya'       => $biaya[$k]
					];
				}
			}

			$periksa             = Periksa::find($periksa_id);
			$periksa->nota       = json_encode( $nota );
			$periksa->pembayaran = Input::get('pembayaran');
			$periksa->kembalian  = Input::get('kembalian');
			$periksa->postKasir  = 1;
			$periksa->save();

			foreach ($periksa->terapis as $terapi) {
				$obat       = Obat::find($terapi->obat_id);
				$obat->stok = $obat->stok - $terapi->jumlah;
				$obat->save();
			}

			Kasir::destroy( $kasir_id );
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
		$pesan = Yoga::suksesFlash('Pasien <strong>' . $periksa->pasien->nama . ' </strong> berhasil selesai proses Kasir');
		return redirect('home/kasirs')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$kasir     = Kasir::find($id);
		// Edit disini untuk simpan data
		$kasir->save();
		$pesan = Yoga::suksesFlash('Kasir berhasil diupdate');
		return redirect('home/kasirs')->withPesan($pesan);
	}
	public function destroy($id){
		Kasir::destroy($id);
		$pesan = Yoga::suksesFlash('Kasir berhasil dihapus');
		return redirect('home/kasirs')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$kasirs     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$kasirs[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Kasir::insert($kasirs);
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

			$kasir = Kasir::find($id);

			$nama = $kasir->periksa->pasien->nama;

			$antrian_apotek             = new AntrianApotek;
			$antrian_apotek->periksa_id = $kasir->periksa_id;
			$antrian_apotek->user_id    = Auth::id();
			$antrian_apotek->save();

			$kasir->delete();

			
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash(
			$nama . ' BERHASIL dikembalikan ke antrian apotek'
		);
		return redirect()->back()->withPesan($pesan);

		
	}
	public function getBiaya(){
		$jenis_tarif_id = Input::get('jenis_tarif_id'); 
		$tarif = Tarif::where('jenis_tarif_id', $jenis_tarif_id)->where('user_id', Auth::id())->first();
		return $tarif->biaya;
	}
	
	public function pembelianObat(){
		return view('kasirs.pembelianObat', compact(
			''
		));
		
	}
	public function ajaxGetObat(){

		$obat_id = Input::get('obat_id');
		$obat    = Obat::find( $obat_id );
		return [
			'harga_beli' => $obat->harga_beli,
			'harga_jual' => $obat->harga_jual,
		];
	}
	
}
