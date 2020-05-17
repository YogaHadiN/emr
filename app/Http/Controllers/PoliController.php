<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poli;
use App\NurseStation;
use Input;
use App\Yoga;
use DB;
use Auth;

class PoliController extends Controller
{
	public function index(){
		$polis = Poli::all();
		return view('polis.index', compact(
			'polis'
		));
	}
	public function create(){
		return view('polis.create');
	}
	public function edit($id){
		$poli = Poli::find($id);
		return view('polis.edit', compact('poli'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$poli       = new Poli;
		// Edit disini untuk simpan data
		$poli->save();
		$pesan = Yoga::suksesFlash('Poli baru berhasil dibuat');
		return redirect('home/polis')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$poli     = Poli::find($id);
		// Edit disini untuk simpan data
		$poli->save();
		$pesan = Yoga::suksesFlash('Poli berhasil diupdate');
		return redirect('home/polis')->withPesan($pesan);
	}
	public function show($id){
		$antrians = NurseStation::where('poli_id', $id)
								->where('user_id', Auth::id())
								->orderBy('waktu', 'desc')
								->get();
		$poli = Poli::find( $id );
		return view('polis.show', compact(
			'antrians',
			'poli'
		));
	}
	
	public function destroy($id){
		Poli::destroy($id);
		$pesan = Yoga::suksesFlash('Poli berhasil dihapus');
		return redirect('home/polis')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$polis     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$polis[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Poli::insert($polis);
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
