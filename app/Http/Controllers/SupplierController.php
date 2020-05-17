<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Input;
use Auth;
use App\Yoga;
use DB;
class SupplierController extends Controller
{
	public function index(){
		$suppliers = Supplier::where('user_id', Auth::id())->paginate(20);
		return view('suppliers.index', compact(
			'suppliers'
		));
	}
	public function create(){
		return view('suppliers.create');
	}
	public function edit($id){
		$supplier = Supplier::find($id);
		return view('suppliers.edit', compact('supplier'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$supplier          = new Supplier;
		$supplier->nama    = Input::get('nama');
		$supplier->alamat  = Input::get('alamat');
		$supplier->email   = Input::get('email');
		$supplier->no_telp = Input::get('no_telp');
		$supplier->user_id = Auth::id();
		$supplier->save();

		$pesan = Yoga::suksesFlash('Supplier baru berhasil dibuat');
		return redirect('home/suppliers')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$supplier          = Supplier::find($id);
		$supplier->nama    = Input::get('nama');
		$supplier->alamat  = Input::get('alamat');
		$supplier->email   = Input::get('email');
		$supplier->no_telp = Input::get('no_telp');
		$supplier->user_id = Auth::id();
		$supplier->save();
		$pesan = Yoga::suksesFlash('Supplier berhasil diupdate');
		return redirect('home/suppliers')->withPesan($pesan);
	}
	public function destroy($id){
		Supplier::destroy($id);
		$pesan = Yoga::suksesFlash('Supplier berhasil dihapus');
		return redirect('home/suppliers')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$suppliers     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$suppliers[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Supplier::insert($suppliers);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'nama'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
