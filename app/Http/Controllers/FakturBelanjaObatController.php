<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FakturBelanjaObat;
use App\PembelianObat;
use App\Obat;
use Input;
use Auth;
use App\Yoga;
use DB;
class FakturBelanjaObatController extends Controller
{
	public function index(){
		$faktur_belanja_obats = FakturBelanjaObat::where('user_id', Auth::id())->paginate(20);
		return view('faktur_belanja_obats.index', compact(
			'faktur_belanja_obats'
		));
	}
	public function create(){
		return view('faktur_belanja_obats.create');
	}
	public function edit($id){
		$faktur_belanja_obat = FakturBelanjaObat::find($id);
		return view('faktur_belanja_obats.edit', compact('faktur_belanja_obat'));
	}
	public function show($id){
		$faktur_belanja_obat = FakturBelanjaObat::find($id);
		/* return $faktur_belanja_obat->pembelianObat->first()->obat->merek; */
		return view('faktur_belanja_obats.show', compact('faktur_belanja_obat'));
	}
	public function store(Request $request){
		/* return Input::all(); */ 
		DB::beginTransaction();
		try {
			
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}
			$faktur_belanja_obat              = new FakturBelanjaObat;
			$faktur_belanja_obat->nomor_nota  = Input::get('nomor_nota');
			$faktur_belanja_obat->staf_id     = Input::get('staf_id');
			$faktur_belanja_obat->tanggal     = Yoga::datePrep(Input::get('tanggal'));
			$faktur_belanja_obat->diskon      = Input::get('diskon');
			$faktur_belanja_obat->user_id     = Auth::id();
			$faktur_belanja_obat->supplier_id = Input::get('supplier_id');
			$faktur_belanja_obat->save();

			$obat_ids    = Input::get('obat_id');
			$harga_belis = Input::get('harga_beli');
			$harga_juals = Input::get('harga_jual');
			$exp_dates   = Input::get('exp_date');
			$jumlahs     = Input::get('jumlah');

			$data = [];
			foreach ($obat_ids as $k => $obat_id) {
				if (!empty( $obat_id )) {
					$data[] = [
						'faktur_belanja_obat_id' => $faktur_belanja_obat->id,
						'obat_id'                => $obat_id,
						'user_id'                => Auth::id(),
						'harga_beli'             => $harga_belis[$k],
						'harga_jual'             => $harga_juals[$k],
						'exp_date'               => $exp_dates[$k],
						'jumlah'                 => $jumlahs[$k]
					];
				}
			}

			PembelianObat::insert($data);

			foreach ($data as $d) {
				$obat       = Obat::find($d['obat_id']);
				$obat->stok = $d['jumlah'] + $obat->stok ;
				$obat->save();
			}

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}




		$pesan = Yoga::suksesFlash('FakturBelanjaObat baru berhasil dibuat');
		return redirect('home/faktur_belanja_obats')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$faktur_belanja_obat     = FakturBelanjaObat::find($id);
		// Edit disini untuk simpan data
		$faktur_belanja_obat->save();
		$pesan = Yoga::suksesFlash('FakturBelanjaObat berhasil diupdate');
		return redirect('home/faktur_belanja_obats')->withPesan($pesan);
	}
	public function destroy($id){
		FakturBelanjaObat::destroy($id);
		$pesan = Yoga::suksesFlash('FakturBelanjaObat berhasil dihapus');
		return redirect('home/faktur_belanja_obats')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$faktur_belanja_obats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$faktur_belanja_obats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		FakturBelanjaObat::insert($faktur_belanja_obats);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'supplier_id' => 'required',
			'diskon'      => 'required|numeric',
			'staf_id'     => 'required',
			'obat_id'     => 'required',
			'tanggal'     => 'required|date_format:d-m-Y',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
