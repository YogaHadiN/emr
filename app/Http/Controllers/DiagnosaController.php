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
		return view('diagnosas.index');
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
	public function searchAjax(){
		$diagnosa       = Input::get('diagnosa');
		$diagnosaICD    = Input::get('diagnosaICD');
		$icd_id         = Input::get('icd_id');
		$displayed_rows = Input::get('displayed_rows');
		$key            = Input::get('key');
		$data           = $this->queryData($diagnosa, $diagnosaICD, $icd_id, $displayed_rows, $key);
		$count          = $this->queryData($diagnosa, $diagnosaICD, $icd_id, $displayed_rows, $key, true)[0]->jumlah;
		$pages          = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($diagnosa, $diagnosaICD, $icd_id, $displayed_rows, $key, $count = false){
		$pass = $key * $displayed_rows;

		$query  = "SELECT ";
		if (!$count) {
			$query .= "ic.id as icd_id, ";
			$query .= "dg.id as id, ";
			$query .= "diagnosa, ";
			$query .= "diagnosaICD ";
		} else {
			$query .= "count(dg.id) as jumlah ";
		}
		$query .= "FROM diagnosas as dg ";
		$query .= "JOIN icds as ic on ic.id = dg.icd_id ";
		$query .= "WHERE ";
		$query .= "(diagnosaICD like '%{$diagnosaICD}%') ";
		$query .= "AND (diagnosa like '%{$diagnosa}%') ";
		$query .= "AND (icd_id like '%{$icd_id}%') ";
		/* $query .= "GROUP BY p.id "; */
		/* $query .= "ORDER BY dg.created_at DESC "; */

		if (!$count) {
			$query .= "LIMIT {$pass}, {$displayed_rows} ";
		}
		/* dd( $query ); */

		return DB::select($query);
	}
	
}
