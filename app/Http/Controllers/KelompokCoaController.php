<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokCoa;
use Input;
use App\Yoga;
use DB;

class KelompokCoaController extends Controller
{
	public function index(){
		$kelompok_coas = KelompokCoa::all();
		return view('kelompok_coas.index', compact(
			'kelompok_coas'
		));
	}
	public function create(){
		return view('kelompok_coas.create');
	}
	public function edit($id){
		$kelompok_coa = KelompokCoa::find($id);
		return view('kelompok_coas.edit', compact('kelompok_coa'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$kelompok_coa       = new KelompokCoa;
		// Edit disini untuk simpan data
		$kelompok_coa->save();
		$pesan = Yoga::suksesFlash('KelompokCoa baru berhasil dibuat');
		return redirect('home/kelompok_coas')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$kelompok_coa     = KelompokCoa::find($id);
		// Edit disini untuk simpan data
		$kelompok_coa->save();
		$pesan = Yoga::suksesFlash('KelompokCoa berhasil diupdate');
		return redirect('home/kelompok_coas')->withPesan($pesan);
	}
	public function destroy($id){
		KelompokCoa::destroy($id);
		$pesan = Yoga::suksesFlash('KelompokCoa berhasil dihapus');
		return redirect('home/kelompok_coas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$kelompok_coas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$kelompok_coas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		KelompokCoa::insert($kelompok_coas);
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
