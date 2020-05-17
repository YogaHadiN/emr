<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model;
use Input;
use App\Yoga;
use DB;
use Auth;

class TransaksiPeriksaController extends Controller
{
	public function index(){
		$transaksi_periksas	 = Model::all();
		return view('transaksi_periksas.index', compact(
			'transaksi_periksas'
		));
	}
	public function create($id){
		$nurse_station = NurseStation::find($id);
		return view('transaksi_periksas.create', compact(
			'nurse_station'
		));
	}
	public function edit($id){
		$transaksi_periksa = Model::find($id);
		return view('transaksi_periksas.edit', compact('transaksi_periksa'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$transaksi_periksa       = new Model;
		// Edit disini untuk simpan data
		$transaksi_periksa->save();
		$pesan = Yoga::suksesFlash('Model baru berhasil dibuat');
		return redirect('home/transaksi_periksas')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$transaksi_periksa     = Model::find($id);
		// Edit disini untuk simpan data
		$transaksi_periksa->save();
		$pesan = Yoga::suksesFlash('Model berhasil diupdate');
		return redirect('home/transaksi_periksas')->withPesan($pesan);
	}
	public function destroy($id){
		Model::destroy($id);
		$pesan = Yoga::suksesFlash('Model berhasil dihapus');
		return redirect('home/transaksi_periksas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$transaksi_periksas	     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$transaksi_periksas	[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Model::insert($transaksi_periksas);
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
