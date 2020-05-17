<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif;
use Auth;
use Input;
use App\Yoga;
use DB;

class TarifController extends Controller
{
	public function index(){
		$tarifs = Tarif::where('user_id', Auth::id())->paginate(20);
		return view('tarifs.index', compact(
			'tarifs'
		));
	}
	public function create(){
		return view('tarifs.create');
	}
	public function edit($id){
		$tarif = Tarif::find($id);
		return view('tarifs.edit', compact('tarif'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$tarif       = new Tarif;
		// Edit disini untuk simpan data
		$tarif->save();
		$pesan = Yoga::suksesFlash('Tarif baru berhasil dibuat');
		return redirect('home/tarifs')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$tarif     = Tarif::find($id);
		// Edit disini untuk simpan data
		$tarif->save();
		$pesan = Yoga::suksesFlash('Tarif berhasil diupdate');
		return redirect('home/tarifs')->withPesan($pesan);
	}
	public function destroy($id){
		Tarif::destroy($id);
		$pesan = Yoga::suksesFlash('Tarif berhasil dihapus');
		return redirect('home/tarifs')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$tarifs     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$tarifs[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Tarif::insert($tarifs);
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
