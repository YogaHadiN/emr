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
		return view('tarifs.index');
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
	public function searchAjax(){
		$tarif                = Input::get('tarif');
		$displayed_rows         = Input::get('displayed_rows');
		$key                    = Input::get('key');
		$data                   = $this->queryData($tarif, $displayed_rows, $key);
		$count                  = $this->queryData($tarif, $displayed_rows, $key, true)[0]->jumlah;
		$pages                  = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($tarif, $displayed_rows, $key, $count = false){
		$pass = $key * $displayed_rows;

		$query  = "SELECT ";
		if (!$count) {
			$query .= "ta.id as id, ";
			$query .= "jenis_tarif, ";
			$query .= "biaya, ";
			$query .= "jasa_dokter, ";
			$query .= "bhp_items ";
		} else {
			$query .= "count(ta.id) as jumlah ";
		}
		$query .= "FROM tarifs as ta ";
		$query .= "JOIN jenis_tarifs as je on je.id = ta.jenis_tarif_id ";
		$query .= "WHERE ";
		$query .= "(jenis_tarif like '%{$tarif}%') ";
		/* $query .= "GROUP BY p.id "; */
		$query .= "ORDER BY ta.created_at DESC ";

		if (!$count) {
			$query .= "LIMIT {$pass}, {$displayed_rows} ";
		}
		return DB::select($query);
	}
	
}
