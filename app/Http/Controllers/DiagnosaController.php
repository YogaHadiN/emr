<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnosa;
use Input;
use App\Yoga;
use DB;

class DiagnosaController extends Controller
{
	public function index(){
		$diagnosas = Diagnosa::paginate(15);
		return view('diagnosas.index', compact(
			'diagnosas'
		));
	}
	public function create(){
		return view('diagnosas.create');
	}
	public function edit($id){
		$diagnosa = Diagnosa::find($id);
		return view('diagnosas.edit', compact('diagnosa'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$diagnosa       = new Diagnosa;
		// Edit disini untuk simpan data
		$diagnosa->save();
		$pesan = Yoga::suksesFlash('Diagnosa baru berhasil dibuat');
		return redirect('home/diagnosas')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$diagnosa     = Diagnosa::find($id);
		// Edit disini untuk simpan data
		$diagnosa->save();
		$pesan = Yoga::suksesFlash('Diagnosa berhasil diupdate');
		return redirect('home/diagnosas')->withPesan($pesan);
	}
	public function destroy($id){
		Diagnosa::destroy($id);
		$pesan = Yoga::suksesFlash('Diagnosa berhasil dihapus');
		return redirect('home/diagnosas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$diagnosas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$diagnosas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Diagnosa::insert($diagnosas);
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
