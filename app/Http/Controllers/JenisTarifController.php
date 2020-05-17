<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisTarif;
use Input;
use App\Yoga;
use DB;
use Auth;

class JenisTarifController extends Controller
{
	public function index(){
		$jenis_tarifs = JenisTarif::where('user_id', Auth::id())
				->where('coa_id', '>', 0)
				->paginate(15);
		return view('jenis_tarifs.index', compact(
			'jenis_tarifs'
		));
	}
	public function create(){
		return view('jenis_tarifs.create');
	}
	public function edit($id){
		$jenis_tarif = JenisTarif::find($id);
		return view('jenis_tarifs.edit', compact('jenis_tarif'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$jenis_tarif       = new JenisTarif;
		// Edit disini untuk simpan data
		$jenis_tarif->save();
		$pesan = Yoga::suksesFlash('JenisTarif baru berhasil dibuat');
		return redirect('jenis_tarifs')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$jenis_tarif     = JenisTarif::find($id);
		// Edit disini untuk simpan data
		$jenis_tarif->save();
		$pesan = Yoga::suksesFlash('JenisTarif berhasil diupdate');
		return redirect('jenis_tarifs')->withPesan($pesan);
	}
	public function destroy($id){
		JenisTarif::destroy($id);
		$pesan = Yoga::suksesFlash('JenisTarif berhasil dihapus');
		return redirect('jenis_tarifs')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$jenis_tarifs     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$jenis_tarifs[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		JenisTarif::insert($jenis_tarifs);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'jenis_tarif' => 'required',
			'coa_id'      => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
