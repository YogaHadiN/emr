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
	public function searchAjax(){
		$generik                = Input::get('generik');
		$pregnancy_safety_index = Input::get('pregnancy_safety_index');
		$displayed_rows         = Input::get('displayed_rows');
		$key                    = Input::get('key');
		$data                   = $this->queryData($generik, $pregnancy_safety_index, $displayed_rows, $key);
		$count                  = $this->queryData($generik, $pregnancy_safety_index, $displayed_rows, $key, true)[0]->jumlah;
		$pages                  = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($generik, $pregnancy_safety_index, $displayed_rows, $key, $count = false){
		$pass = $key * $displayed_rows;

		$query  = "SELECT ";
		if (!$count) {
			$query .= "id, ";
			$query .= "generik, ";
			$query .= "pregnancy_safety_index ";
		} else {
			$query .= "count(id) as jumlah ";
		}
		$query .= "FROM generiks ";
		$query .= "WHERE ";
		$query .= "(generik like '%{$generik}%') ";
		$query .= "AND (pregnancy_safety_index like '%{$pregnancy_safety_index}%') ";
		/* $query .= "GROUP BY p.id "; */
		$query .= "ORDER BY created_at DESC ";

		if (!$count) {
			$query .= "LIMIT {$pass}, {$displayed_rows} ";
		}
		return DB::select($query);
	}
}
