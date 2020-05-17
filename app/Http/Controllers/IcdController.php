<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Icd;
use Input;
use App\Yoga;
use DB;

class IcdController extends Controller
{
	public function index(){
		$icds = Icd::paginate(20);
		return view('icds.index', compact(
			'icds'
		));
	}
	public function create(){
		return view('icds.create');
	}
	public function edit($id){
		$icd = Icd::find($id);
		return view('icds.edit', compact('icd'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$icd       = new Icd;
		// Edit disini untuk simpan data
		$icd->save();
		$pesan = Yoga::suksesFlash('Icd baru berhasil dibuat');
		return redirect('home/icds')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$icd     = Icd::find($id);
		// Edit disini untuk simpan data
		$icd->save();
		$pesan = Yoga::suksesFlash('Icd berhasil diupdate');
		return redirect('home/icds')->withPesan($pesan);
	}
	public function destroy($id){
		Icd::destroy($id);
		$pesan = Yoga::suksesFlash('Icd berhasil dihapus');
		return redirect('home/icds')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$icds     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$icds[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Icd::insert($icds);
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
