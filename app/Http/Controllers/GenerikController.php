<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generik;
use Input;
use App\Yoga;
use DB;

class GenerikController extends Controller
{
	public function index(){
		$generiks = Generik::paginate(20);
		return view('generiks.index', compact(
			'generiks'
		));
	}
	public function create(){
		return view('generiks.create');
	}
	public function edit($id){
		$generik = Generik::find($id);
		return view('generiks.edit', compact('generik'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$generik       = new Generik;
		// Edit disini untuk simpan data
		$generik->save();
		$pesan = Yoga::suksesFlash('Generik baru berhasil dibuat');
		return redirect('home/generiks')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$generik     = Generik::find($id);
		// Edit disini untuk simpan data
		$generik->save();
		$pesan = Yoga::suksesFlash('Generik berhasil diupdate');
		return redirect('home/generiks')->withPesan($pesan);
	}
	public function destroy($id){
		Generik::destroy($id);
		$pesan = Yoga::suksesFlash('Generik berhasil dihapus');
		return redirect('home/generiks')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$generiks     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$generiks[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Generik::insert($generiks);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'generik'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
