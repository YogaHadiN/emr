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
		return view('coas.index');
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
	public function searchAjax(){
		$coa   = Input::get('coa');
		$kelompok_coa   = Input::get('kelompok_coa');
		$displayed_rows = Input::get('displayed_rows');
		$key            = Input::get('key');
		$data           = $this->queryData($coa,  $kelompok_coa, $displayed_rows, $key);
		$count          = $this->queryData($coa,  $kelompok_coa, $displayed_rows, $key, true)[0]->jumlah;
		$pages          = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($coa, $kelompok_coa, $displayed_rows, $key, $count = false){
		$pass = $key * $displayed_rows;

		$query  = "SELECT ";
		if (!$count) {
			$query .= "co.id as id, ";
			$query .= "coa, ";
			$query .= "kelompok_coa, ";
			$query .= "saldo_awal as saldo ";
		} else {
			$query .= "count(co.id) as jumlah ";
		}
		$query .= "FROM coas as co ";
		$query .= "JOIN kelompok_coas as ke on ke.id = co.kelompok_coa_id ";
		$query .= "WHERE ";
		$query .= "(coa like '%{$coa}%') ";
		$query .= "AND (kelompok_coa like '%{$kelompok_coa}%') ";
		$query .= "GROUP BY co.id ";
		$query .= "ORDER BY co.created_at DESC ";

		if (!$count) {
			$query .= "LIMIT {$pass}, {$displayed_rows} ";
		}
		return DB::select($query);
	}
	
}
