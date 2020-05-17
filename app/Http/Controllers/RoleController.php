<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Input;
use Auth;
use App\Yoga;
use DB;

class RoleController extends Controller
{
	public function index(){
		$roles = Role::paginate(20);
		return view('roles.index', compact(
			'roles'
		));
	}
	public function create(){
		$tables = DB::select('SHOW TABLES');



		return view('roles.create', compact(
			'tables'
		));
	}
	public function edit($id){
		$role        = Role::find($id);
		$restriction = json_decode($role->restriction, true);

		$tables = DB::select('SHOW TABLES');
		return view('roles.edit', compact(
			'role',
			'restriction',
			'tables'
		));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$role              = new Role;
		$role->role        = Input::get('role');
		$role->restriction = Input::get('restriction');
		$role->save();
		$pesan = Yoga::suksesFlash('Role baru berhasil dibuat');
		return redirect('home/roles')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$role              = Role::find($id);
		$role->role        = Input::get('role');
		$role->restriction = Input::get('restriction');
		$role->save();

		$pesan = Yoga::suksesFlash('Role berhasil diupdate');
		return redirect('home/roles')->withPesan($pesan);
	}
	public function destroy($id){
		Role::destroy($id);
		$pesan = Yoga::suksesFlash('Role berhasil dihapus');
		return redirect('home/roles')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$roles     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$roles[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Role::insert($roles);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'role'      => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
}
