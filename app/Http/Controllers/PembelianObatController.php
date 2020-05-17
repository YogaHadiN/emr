<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PembelianObat;
use Input;
use App\Yoga;
use DB;
use Auth;

class PembelianObatController extends Controller
{
	public function index(){
		$pembelian_obats = PembelianObat::all();
		return view('pembelian_obats.index', compact(
			'pembelian_obats'
		));
	}
	public function create(){
		return view('pembelian_obats.create');
	}
	public function edit($id){
		$pembelian_obat = PembelianObat::find($id);
		return view('pembelian_obats.edit', compact('pembelian_obat'));
	}
	public function show($id){
		$pembelian_obat = PembelianObat::find($id);
		return view('pembelian_obats.show', compact('pembelian_obat'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$pembelian_obat       = new PembelianObat;
		// Edit disini untuk simpan data
		$pembelian_obat->save();
		$pesan = Yoga::suksesFlash('PembelianObat baru berhasil dibuat');
		return redirect('home/pembelian_obats')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$pembelian_obat     = PembelianObat::find($id);
		// Edit disini untuk simpan data
		$pembelian_obat->save();
		$pesan = Yoga::suksesFlash('PembelianObat berhasil diupdate');
		return redirect('home/pembelian_obats')->withPesan($pesan);
	}
	public function destroy($id){
		PembelianObat::destroy($id);
		$pesan = Yoga::suksesFlash('PembelianObat berhasil dihapus');
		return redirect('home/pembelian_obats')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$pembelian_obats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$pembelian_obats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		PembelianObat::insert($pembelian_obats);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'data'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
