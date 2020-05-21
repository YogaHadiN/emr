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
	public $input_nama;
	public $input_alamat;
	public $input_no_telp;
	public $input_password;

	/**
	* @param 
	*/
	public function __construct()
	{
		$this->input_nama          = Input::get('nama');
		$this->input_alamat        = Input::get('alamat');
		$this->input_no_telp       = Input::get('no_telp');
		$this->input_password      = Input::get('pass');
		$this->input_image         = Input::file('image');
		$this->input_ktp_image     = Input::file('ktp_image');
		$this->input_has_image     = Input::hasFile('image');
		$this->input_has_ktp_image = Input::hasFile('ktp_image');
		$this->input_user_id       = Auth::id();
	}
	
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
			/* dd(Input::all()); */ 
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$staf  = new Staf;
		$staf  = $this->inputData($staf);
		$pesan = Yoga::suksesFlash('Staf baru berhasil dibuat');
		return redirect('home/stafs')->withPesan($pesan);
	}
	public function update($id, Request $request){
		/* dd(Input::all()); */ 
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$staf  = Staf::find($id);
		$staf  = $this->inputData($staf);
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
	public function inputData($staf){
		$staf->nama         = $this->input_nama;
		$staf->alamat       = $this->input_alamat;
		$staf->no_telp      = $this->input_no_telp;
		if(!empty($this->input_pass)){
			$staf->password = $this->input_pass;
		}
		$staf->user_id      = Auth::id();
		$staf->save();
		$staf->image        = Yoga::uploadS3( $this->input_has_image, $this->input_image, 'image', 'img/staf', 'image', $staf );
		$staf->ktp_image    = Yoga::uploadS3( $this->input_has_ktp_image, $this->input_ktp_image, 'ktp', 'img/staf', 'ktp_image', $staf );
		$staf->save();
	}
		
}
