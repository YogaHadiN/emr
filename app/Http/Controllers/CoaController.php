<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coa;
use Input;
use App\Yoga;
use DB;

class CoaController extends Controller
{
	public function index(){
		$coas = Coa::paginate(15);
		return view('coas.index', compact(
			'coas'
		));
	}
	public function create(){
		return view('coas.create');
	}
	public function edit($id){
		$coa = Coa::find($id);
		return view('coas.edit', compact('coa'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$coa       = new Coa;
		// Edit disini untuk simpan data
		$coa->save();
		$pesan = Yoga::suksesFlash('Coa baru berhasil dibuat');
		return redirect('home/coas')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$coa     = Coa::find($id);
		// Edit disini untuk simpan data
		$coa->save();
		$pesan = Yoga::suksesFlash('Coa berhasil diupdate');
		return redirect('home/coas')->withPesan($pesan);
	}
	public function destroy($id){
		Coa::destroy($id);
		$pesan = Yoga::suksesFlash('Coa berhasil dihapus');
		return redirect('home/coas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$coas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$coas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Coa::insert($coas);
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
