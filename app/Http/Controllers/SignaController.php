<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signa;
use Input;
use Auth;
use App\Yoga;
use DB;

class SignaController extends Controller
{
	public function index(){
		$signas = Signa::paginate(20);
		return view('signas.index', compact(
			'signas'
		));
	}
	public function create(){
		return view('signas.create');
	}
	public function edit($id){
		$signa        = Signa::find($id);
		return view('signas.edit', compact('signa'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$signa        = new Signa;
		$signa->signa = Input::get('signa');
		$signa->save();
		$pesan = Yoga::suksesFlash('Signa baru berhasil dibuat');
		return redirect('home/signas')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$signa        = Signa::find($id);
		$signa->signa = Input::get('signa');
		$signa->save();
		$pesan = Yoga::suksesFlash('Signa berhasil diupdate');
		return redirect('home/signas')->withPesan($pesan);
	}
	public function destroy($id){
		Signa::destroy($id);
		$pesan = Yoga::suksesFlash('Signa berhasil dihapus');
		return redirect('home/signas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$signas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$signas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Signa::insert($signas);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'signa'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
