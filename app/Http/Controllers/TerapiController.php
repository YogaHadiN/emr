<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terapi;
use App\NurseStation;
use App\Periksa;
use App\Signa;
use App\AturanMinum;
use Input;
use App\Yoga;
use App\Obat;
use App\AntrianApotek;
use DB;
use Auth;
class TerapiController extends Controller
{
	public $input_q;
	/**
	* @param 
	*/
	public function __construct()
	{
		$this->input_q = Input::get('q');
	}
			
	private $json_container;
	private $nurse_station_id;
	private $nama_pasien;
	private $poli_id;
	public function index(){
		$terapis = Terapi::all();
		return view('terapis.index', compact(
			'terapis'
		));
	}
	public function create($id){
		$nurse_station = NurseStation::find( $id );
		if ( !is_null( $nurse_station->periksa->terapi ) ) {
			return redirect('home/terapis/' . $id . '/edit');
		}
		$json_terapi = '[]';
		/* dd( $json_terapi ); */
		return view('terapis.create', compact(
			'nurse_station',
			'json_terapi'
		));
	}
	public function edit($id){
		$nurse_station = NurseStation::find( $id );
		$periksa       = Periksa::find( $nurse_station->periksa_id );
		$terapi        = Terapi::where('periksa_id', $nurse_station->periksa_id)->get();
		$json_terapi   = [];
		
		foreach ($terapi as $t) {
			$obat = Obat::find( $t->obat_id );
			$json_terapi[] = [
				'tipe_resep_id'     => $t->tipe_resep_id,
				'standar_text'      => $t->standar_text,
				'obat_id'           => $t->obat_id,
				'obat_text'         => $obat->merek,
				'signa_id'          => $t->signa_id,
				'signa_text'        => Signa::find( $t->signa_id )->signa,
				'aturan_minum_id'   => $t->aturan_minum_id,
				'aturan_minum_text' => AturanMinum::find( $t->aturan_minum_id )->aturan_minum,
				'jumlah'            => $t->jumlah
			];
		}

		$json_terapi = json_encode( $json_terapi );
		return view('terapis.edit', compact(
			'nurse_station',
			'json_terapi'
		));
	}

	public function store(Request $request){
		/* return Input::get('json_container'); */
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}

			$this->json_container   = Input::get('json_container');
			$this->nurse_station_id = Input::get('nurse_station_id');
			$this->updateStore();
			
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash('Terapi baru untuk ' . $this->nama_pasien . ' berhasil dibuat');
		return redirect('home/polis/' . $this->poli_id)->withPesan($pesan);
	}
	public function update($id, Request $request){

		/* return Input::get('json_container'); */
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}

			$this->json_container   = Input::get('json_container');
			$this->nurse_station_id = Input::get('nurse_station_id');
			$this->updateStore();
			
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash('Terapi untuk ' . $this->nama_pasien . ' berhasil diupdate');
		return redirect('home/polis/' . $this->poli_id)->withPesan($pesan);
	}
	public function destroy($id){
		Terapi::destroy($id);
		$pesan = Yoga::suksesFlash('Terapi berhasil dihapus');
		return redirect('terapis')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$terapis     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$terapis[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Terapi::insert($terapis);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
		
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	private function updateStore(){
			$terapis          = json_decode($this->json_container, true);
			$nurse_station    = NurseStation::find( $this->nurse_station_id );

			$data = [];
			$timestamp = date('Y-m-d H:i:s');
			
			$terapi_json = [];

			foreach ($terapis as $terapi) {
				$obat = Obat::find( $terapi['obat_id'] );
				$data[] = [
					'signa_id'          => $terapi['signa_id'],
					'obat_id'           => $terapi['obat_id'],
					'aturan_minum_id'   => $terapi['aturan_minum_id'],
					'tipe_resep_id'     => $terapi['tipe_resep_id'],
					'jumlah'            => $terapi['jumlah'],
					'harga_beli_satuan' => $obat->harga_beli,
					'harga_jual_satuan' => $obat->harga_jual,
					'periksa_id'        => $nurse_station->periksa_id,
					'nurse_station_id'  => $nurse_station->id,
					'created_at'        => $timestamp,
					'updated_at'        => $timestamp,
					'user_id'           => Auth::id()
				];

				$terapi_json[] = [
					'signa_id'          => $terapi['signa_id'],
					'signa_text'        => $terapi['signa_text'],
					'aturan_minum_text' => $terapi['aturan_minum_text'],
					'harga_beli_satuan' => $obat->harga_beli,
					'harga_jual_satuan' => $obat->harga_jual,
					'obat_id'           => $terapi['obat_id'],
					'obat_text'         => $terapi['obat_text'],
					'aturan_minum_id'   => $terapi['aturan_minum_id'],
					'jumlah'            => $terapi['jumlah']
				];
			}

			Terapi::where('periksa_id', $nurse_station->periksa_id)->delete();
			Terapi::insert($data);

			$periksa         = Periksa::find( $nurse_station->periksa_id );
			$periksa->terapi = json_encode($terapi_json);

			usort($terapi_json, function($a, $b) {
				return $a['obat_id'] <=> $b['obat_id'];
			});

			$periksa->terapi_sort = json_encode($terapi_json);
			$periksa->save();

			$this->nama_pasien = $periksa->pasien->nama;

			$antrian_apotek             = new AntrianApotek;
			$antrian_apotek->periksa_id = $nurse_station->periksa_id;
			$antrian_apotek->user_id    = Auth::id();
			$antrian_apotek->save();

			$this->poli_id = $nurse_station->poli_id;
			$nurse_station->delete();
	}


	/**
	* undocumented function
	*
	* @return void
	*/
	public function obatAjax()
	{
		return $this->cariObat();
	}
	/**
	* undocumented function
	*
	* @return void
	*/
	public function obatAjaxCustom($jenis_obat)
	{
		return $this->cariObat($jenis_obat);
	}
	/**
	* undocumented function
	*
	* @return void
	*/
	private function cariObat($jenis_obat = null)
	{
		$param   = $this->input_q;
		$params = explode(" ", $param);

		$query   = "SELECT ";
		$query  .= "ob.id, ";
		$query  .= "merek, ";
		$query  .= "bobot, ";
		$query  .= "generik ";
		$query  .= "FROM obats as ob ";
		$query  .= "JOIN komposisis as ko on ko.obat_id = ob.id ";
		$query  .= "JOIN generiks as ge on ge.id = ko.generik_id ";
		$query  .= "WHERE ";
		foreach ($params as $k => $p) {
			if ($k > 0) {
				$query  .= "and ";
			}
			$query  .= "(generik like '%{$p}%' ";
			$query  .= "or ";
			$query  .= "merek like '%{$p}%') ";
		}
		if (isset($jenis_obat)) {
			if ($jenis_obat == 'puyer') {
				$query  .= "AND (sediaan = 'capsul' or sediaan = 'tablet' ) ";
			}
			if ($jenis_obat == 'add') {
				$query  .= "AND (sediaan = 'dry syrup') ";
			}
		}
		$query  .= "LIMIT 15;";
		$data    = DB::select($query);
		$result  = [];
		foreach ($data as $d) {
			$result[$d->id]['merek'] = $d->merek;
			$q  = "SELECT ";
			$q .= "bobot, ";
			$q .= "generik ";
			$q .= "FROM komposisis as ko ";
			$q .= "JOIN generiks as ge on ge.id = ko.generik_id ";
			$q .= "WHERE obat_id = '{$d->id}';";
			$dt = DB::select($q);
			$komposisis = [];
			foreach ($dt as $da) {
				$komposisis[] = $da->generik . ' ' . $da->bobot;
			}
			$result[$d->id]['komposisis'] = $komposisis;
		}
		$res = [];
		foreach ($result as $k=> $r) {
			$html = '<div>' . $r['merek'] . '</div>';
			$html .= '<div><small><ul style="list-style-type:none;">';
			foreach ($r['komposisis'] as $c) {
				$html .= '<li>';
				$html .= $c;
				$html .= '</li>';
			}
			$html .= '</ul></small></div>';
			$res[] = [
				'id'    => $k,
				'text'  => $r['merek'],
				'title' => $r['merek'],
				'html'  => $html
			];
		}
		return $res;
	}
	public function signaSearch(){
		$param  = Input::get('q');
		$query  = "SELECT id, signa as text ";
		$query .= "FROM signas ";
		$query .= "WHERE signa like '%{$param}%' ";
		$query .= "LIMIT 10";
		return  DB::select($query);
	}
	public function aturanMinumSearch(){
		$param  = Input::get('q');
		$query  = "SELECT id, aturan_minum as text ";
		$query .= "FROM aturan_minums ";
		$query .= "WHERE aturan_minum like '%{$param}%' ";
		$query .= "LIMIT 10";
		return  DB::select($query);
	}
	public function createSigna(){
		$param = Input::get('param');
		try {
			return Signa::where('signa', trim($signa))->firstOrFail()->id;
		} catch (\Exception $e) {
			$signa        = new Signa;
			$signa->signa = $param;
			if ($signa->save()) {
				return $signa->id;
			}
		}
	}
	public function createAturanMinum(){
		$aturan_minum = Input::get('aturan_minum');
		try {
			return AturanMinum::where('aturan_minum', trim($aturan_minum))->firstOrFail()->id;
		} catch (\Exception $e) {
			$AturanMinum               = new AturanMinum;
			$AturanMinum->aturan_minum = $aturan_minum;
			if ($AturanMinum->save()) {
				return $AturanMinum->id;
			}
		}
	}
	
}
