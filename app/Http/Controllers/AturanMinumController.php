<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AturanMinum;
use Input;
use App\Yoga;
use DB;

class AturanMinumController extends Controller
{
	public function index(){
		return view('aturan_minums.index');
	}
	public function create(){
		return view('aturan_minums.create');
	}
	public function edit($id){
		$aturan_minum = AturanMinum::find($id);
		return view('aturan_minums.edit', compact('aturan_minum'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$aturan_minum               = new AturanMinum;
		$aturan_minum->aturan_minum = Input::get('aturan_minum');
		$aturan_minum->save();

		$pesan = Yoga::suksesFlash('AturanMinum baru berhasil dibuat');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$aturan_minum               = AturanMinum::find($id);
		$aturan_minum->aturan_minum = Input::get('aturan_minum');
		$aturan_minum->save();
		$pesan = Yoga::suksesFlash('AturanMinum berhasil diupdate');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function destroy($id){
		AturanMinum::destroy($id);
		$pesan = Yoga::suksesFlash('AturanMinum berhasil dihapus');
		return redirect('home/aturan_minums')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$aturan_minums     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$aturan_minums[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		AturanMinum::insert($aturan_minums);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'aturan_minum'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function searchAjax(){
		$aturan_minum   = Input::get('aturan_minum');
		$displayed_rows = Input::get('displayed_rows');
		$key            = Input::get('key');
		$data           = $this->queryData($aturan_minum, $displayed_rows, $key);
		$count          = $this->queryData($aturan_minum, $displayed_rows, $key, true)[0]->jumlah;
		$pages          = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($aturan_minum,$displayed_rows, $key, $count = false){
		$pass = $key * $displayed_rows;

		$query  = "SELECT ";
		if (!$count) {
			$query .= "id, ";
			$query .= "aturan_minum ";
		} else {
			$query .= "count(id) as jumlah ";
		}
		$query .= "FROM aturan_minums ";
		$query .= "WHERE ";
		$query .= "(aturan_minum like '%{$aturan_minum}%') ";
		/* $query .= "GROUP BY p.id "; */
		$query .= "ORDER BY created_at DESC ";

		if (!$count) {
			$query .= "LIMIT {$pass}, {$displayed_rows} ";
		}
		return DB::select($query);
	}
	
}
