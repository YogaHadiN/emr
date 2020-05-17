<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asuransi;
use App\Yoga;
use Input;
use Auth;

class AsuransiController extends Controller
{
	public static function boot(){
		parent::boot();
		self::deleting(function($model){
			
		});
	}
	
	public function index(){
		$user_id = Auth::id();
		$asuransis = Asuransi::all();
		return view('asuransis.index', compact(
			'asuransis'
		));
	}
	public function create(){
		return view('asuransis.create', compact(
			''
		));
	}
	
	public function edit($id){
		$asuransi = Asuransi::find( $id );
		return view('asuransis.edit', compact(
			'asuransi'
		));
	}
	public function store(){
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'nama_asuransi' => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
			$asuransi                = new Asuransi;
			$asuransi->nama_asuransi = Input::get('nama_asuransi');
			$asuransi->no_telp       = Input::get('no_telp');
			$asuransi->alamat        = Input::get('alamat');
			$asuransi->save();

			$pesan = Yoga::suksesFlash('pambuatan asuransi baru <strong>BERHASIL</strong>');
			return redirect('home/asuransis')->withPesan($pesan);
	}

	public function update($id){
			$messages = [
				'required' => ':attribute Harus Diisi',
			];
			$rules = [
				'nama_asuransi' => 'required'
			];
			
			$validator = \Validator::make(Input::all(), $rules, $messages);
			
			if ($validator->fails())
			{
				return \Redirect::back()->withErrors($validator)->withInput();
			}
			$asuransi                = Asuransi::find( $id );
			$asuransi->nama_asuransi = Input::get('nama_asuransi');
			$asuransi->no_telp       = Input::get('no_telp');
			$asuransi->alamat        = Input::get('alamat');
			$asuransi->save();

			$pesan = Yoga::suksesFlash('perubahan asuransi baru <strong>BERHASIL</strong>');
			return redirect('home/asuransis')->withPesan($pesan);
	}
	public function destroy($id){
		$asuransi      = Asuransi::find( $id );
		$nama_asuransi = $asuransi->nama_asuransi;
		$asuransi->delete();
		$pesan = Yoga::suksesFlash(
			'Asuransi <strong>' . $id . '-' . $nama_asuransi . '</strong> BERHASIL dihapus' 
		);
		return redirect('home/asuransis')->withPesan($pesan);
		
	}
}
