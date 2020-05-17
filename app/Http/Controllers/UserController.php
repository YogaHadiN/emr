<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Yoga;
use Input;

class UserController extends Controller
{
	public function index(){
		$users = User::all();
		return view('users.index', compact(
			'users'
		));
	}
	
	public function edit($id){
		$url  = url('/');
		$user = User::find( $id );
		return view('users.edit', compact(
			'user',
			'url'
		));
	}
	public function update($id){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'name'                  => 'required|min:3|max:50',
			'email'                 => 'email',
			'password_confirmation' => 'same:password_confirmation'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$user           = User::find( $id );
		$user->name     = Input::get('name');
		$user->email    = Input::get('email');
		if( !empty( Input::get('password') ) ){
			$user->password = bcrypt(Input::get('password'));
		}
		if( !empty( Input::get('image') ) ){
			$user->image = Input::get('image');
		}
		$user->alamat   = Input::get('alamat');
		$user->no_telp  = Input::get('no_telp');
		$user->save();

		$pesan = Yoga::suksesFlash('perubahan user baru <strong>BERHASIL</strong>');
		return redirect('home')->withPesan($pesan);
	}
	public function destroy($id){
		$user      = User::find( $id );
		$nama = $user->nama;
		$user->delete();
		$pesan = Yoga::suksesFlash(
			'User <strong>' . $id . '-' . $nama . '</strong> BERHASIL dihapus' 
		);
		return redirect('home/users')->withPesan($pesan);
	}
	public function photoCapture($id){
		return view('users.image', compact(
			''
		));	
	}
	
}
