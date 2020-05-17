<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staf;
use Input;
use App\Yoga;
use DB;
use Auth;

class StafController extends Controller
{
	public function index(){
		$stafs = Staf::all();
		return view('stafs.index', compact(
			'stafs'
		));
	}
	public function create(){
		return view('stafs.create');
	}
	public function edit($id){
		$staf = Staf::find($id);
		return view('stafs.edit', compact('staf'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$staf          = new Staf;
		$staf->nama    = Input::get('nama');
		$staf->alamat  = Input::get('alamat');
		$staf->no_telp = Input::get('no_telp');
		if(!empty(Input::get('pass'))){
			$staf->password = Input::get('pass');
		}
		$staf->user_id = Auth::id();
		$staf->save();
		$pesan = Yoga::suksesFlash('Staf baru berhasil dibuat');
		return redirect('home/stafs')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$staf          = Staf::find($id);
		$staf->nama    = Input::get('nama');
		$staf->alamat  = Input::get('alamat');
		if(!empty(Input::get('pass'))){
			$staf->password = Input::get('pass');
		}
		$staf->no_telp = Input::get('no_telp');
		$staf->save();
		$pesan = Yoga::suksesFlash('Staf berhasil diupdate');
		return redirect('home/stafs')->withPesan($pesan);
	}
	public function destroy($id){
		Staf::destroy($id);
		$pesan = Yoga::suksesFlash('Staf berhasil dihapus');
		return redirect('home/stafs')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$stafs     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$stafs[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Staf::insert($stafs);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'nama'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
