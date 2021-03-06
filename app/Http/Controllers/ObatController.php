<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use Input;
use App\Yoga;
use App\Komposisi;
use App\Generik;
use DB;
use Auth;

class ObatController extends Controller
{
	public function index(){
		$obats = Obat::where('id', '>', 3)
			->where('user_id', Auth::id())
			->paginate(20);

		$generik_ids = [];
		foreach ($obats as $obat) {
			$formula = $obat->formula;
			foreach (json_decode($formula) as $form) {
				$generik_ids[] = $form->generik_id;
			}

		}

		$data = Generik::whereIn('id', $generik_ids)->get();
		
		$generiks = [];
		foreach ($data as $d) {
			$generiks[$d->id] = $d->generik;
		}

		return view('obats.index', compact(
			'obats',
			'generiks'
		));
	}
	public function create(){
		return view('obats.create');
	}
	public function edit($id){
		$obat = Obat::find($id);
		return view('obats.edit', compact('obat'));
	}
	public function store(Request $request){
		/* return Input::all(); */ 
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}

		$generik_id = Input::get('generik');
		$satuan     = Input::get('satuan');
		$bobot      = Input::get('bobot');


		$formula = [];
		foreach ($generik_id as $k => $generik) {
			if ( !empty( $generik ) ) {
				$formula[] = [
					'generik_id' => $generik,
					'generik'    => Generik::find( $generik )->generik,
					'bobot'      => $bobot[$k] . ' ' . $satuan[$k]
				];
			}
		}

		$formula_json = json_encode($formula);

		$merek = ucfirst(Input::get('merek')) . ' ' .  Input::get('sediaan');
		if ( count( $formula ) == 1 ) {
			$merek .= ' ' . $formula[0]['bobot'];
		}

		DB::beginTransaction();
		try {
			
			$obat                  = new Obat;
			$obat->merek           = $merek;
			$obat->formula         = $formula_json;
			$obat->fornas          = Input::get('fornas');
			$obat->sediaan         = Input::get('sediaan');
			$obat->aturan_minum_id = Input::get('aturan_minum_id');
			$obat->peringatan      = Input::get('peringatan');
			$obat->tidak_dipuyer   = Input::get('tidak_dipuyer');
			$obat->verified        = Input::get('verified');
			$obat->save();

			foreach ($formula as $f) {
				$komposisi             = new Komposisi;
				$komposisi->obat_id    = $obat->id;
				$komposisi->generik_id = $f['generik_id'];
				$komposisi->bobot      = $f['bobot'];
				$komposisi->save();
			}

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash('Obat baru berhasil dibuat');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}

		DB::beginTransaction();
		try {
			
			$generik_id = Input::get('generik');
			$bobot      = Input::get('bobot');


			$formula = [];

			foreach ($generik_id as $k => $generik) {
				if ( !empty( $generik ) ) {
					$formula[] = [
						'generik_id' => $generik,
						'generik'    => Generik::find( $generik )->generik,
						'bobot'      => $bobot[$k]
					];
				}
			}

			$formula_json = json_encode($formula);
			$obat                  = Obat::find($id);
			$obat->merek           = Input::get('merek');
			$obat->formula         = $formula_json;
			$obat->fornas          = Input::get('fornas');
			$obat->sediaan         = Input::get('sediaan');
			$obat->aturan_minum_id = Input::get('aturan_minum_id');
			$obat->peringatan      = Input::get('peringatan');
			$obat->tidak_dipuyer   = Input::get('tidak_dipuyer');
			$obat->verified        = Input::get('verified');
			$obat->save();

			Komposisi::where('obat_id', $id)->delete();

			foreach ($formula as $f) {
				$komposisi             = new Komposisi;
				$komposisi->obat_id    = $obat->id;
				$komposisi->generik_id = $f['generik_id'];
				$komposisi->bobot      = $f['bobot'];
				$komposisi->save();
			}

			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash('Obat berhasil diupdate');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function destroy($id){
		Obat::destroy($id);
		$pesan = Yoga::suksesFlash('Obat berhasil dihapus');
		return redirect('home/obats')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$obats     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$obats[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Obat::insert($obats);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'merek'           => 'required',
			'fornas'          => 'required',
			'sediaan'         => 'required',
			'aturan_minum_id' => 'required',
			'tidak_dipuyer'   => 'required',
			'verified'        => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function jenisObatPuyer(){
		$obats = Obat::where('sediaan','capsul')->orWhere('sediaan','tablet')->pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}
		return $data;
	}
	public function jenisObatAdd(){
		$obats = Obat::where('sediaan','dry syrup')->pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}
		return $data;
	}
	public function jenisObatStandar(){
		$obats = Obat::pluck('merek', 'id')->all();
		$data = [];
		foreach ($obats as $k => $obat) {
			$data[] = [
				'value' => $k,
				'text' => $obat
			];
		}
		return $data;
	}
	public function searchAjax(){
		$merek          = Input::get('merek');
		$generik        = Input::get('generik');
		$displayed_rows = Input::get('displayed_rows');
		$key            = Input::get('key');
		$data           = $this->queryData($merek, $generik, $displayed_rows, $key);
		$count          = $this->queryData($merek, $generik, $displayed_rows, $key, true)[0]->jumlah;
		$pages          = ceil( $count/ $displayed_rows );

		return [
			'data'  => $data,
			'pages' => $pages,
			'key'   => $key,
			'rows'  => $count
		];
	}
	private function queryData($merek, $generik, $displayed_rows, $key, $count = false){
		$pass  = $key * $displayed_rows;
		$query = "SELECT ";
		if (!$count) {
			$query .= "ob.id as id, ";
			$query .= "merek, ";
			$query .= "generik, ";
			$query .= "bobot, ";
			$query .= "stok as jumlah ";
		} else {
			$query .= "count(*) as jumlah ";
		}
		if ($count) {
			$query .= "FROM (SELECT ob.id from obats ob ";
		} else {
			$query .= "FROM obats as ob ";
		}
		$query .= "LEFT JOIN komposisis as ko on ko.obat_id = ob.id ";
		$query .= "LEFT JOIN generiks as ge on ge.id = ko.generik_id ";
		$query .= "WHERE ";
		$query .= "(ob.merek like '%{$merek}%') AND ";
		$query .= "(generik like '%{$generik}%' or generik is null) ";
		if ($count) {
			$query .= "GROUP BY ob.id) d;";
		} else {
			$query .= "GROUP BY ob.id ORDER BY ob.created_at DESC LIMIT {$pass}, {$displayed_rows}";
		}

		$result = DB::select($query);

		if ($count) {
			return $result;
		} else {
			$ob_id = [];
			$dataResult = [];
			foreach ($result as $r) {
				$ob_id[] = $r->id;
				$dataResult[ $r->id ]['id'] = $r->id;
				$dataResult[ $r->id ]['merek'] = $r->merek;
				$dataResult[ $r->id ]['jumlah'] = $r->jumlah;
			}
			$komposisis = Komposisi::with('generik')->whereIn('obat_id', $ob_id)->get();
			$data_komposisi = [];
			foreach ($komposisis as $komposisi) {
				if (isset($komposisi->generik_id)) {
					$data_komposisi[ $komposisi->obat_id ][] = [
						'generik' => $komposisi->generik->generik,
						'bobot'   => $komposisi->bobot
					];
				}
			}
			foreach ($dataResult as $k => $dr) {
				if (isset( $data_komposisi[$k] )) {
					$dataResult[$k]['komposisi'] = $data_komposisi[$k];
				} else {
					$dataResult[$k]['komposisi'] = [];
				}
			}
			$result = [];
			foreach ($dataResult as $dr) {
				$result[] = $dr;
			}
			return $result;
		}
	}
}
