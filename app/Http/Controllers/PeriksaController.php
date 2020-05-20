<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Periksa;
use App\NurseStation;
use App\TransaksiPeriksa;
use App\Alergi;
use App\Tarif;
use Input;
use App\Yoga;
use App\Diagnosa;
use App\Icd;
use DB;
use PDF;
use Auth;

class PeriksaController extends Controller
{
	public function index(){
		$periksas = Periksa::all();
		return view('periksas.index', compact(
			'periksas'
		));
	}
	public function create($id){
		$nurse_station = NurseStation::with('asisten', 'staf', 'asuransi', 'pasien.alergi')->where('id',$id)->first();
		if ( !is_null($nurse_station->random_string) ) {
			return redirect('home/periksas/' . $nurse_station->periksa_id . '/edit');
		}
		$periksa_last         = $this->periksaLast($nurse_station);
		$tindakans            = TransaksiPeriksa::where('nurse_station_id', $id)->get();
		$tarif_id_jasa_dokter = Tarif::where('jenis_tarif_id', 1)->where('user_id', Auth::id())->where('asuransi_id', $nurse_station->asuransi_id)->first()->id;
		$tarif_selection      = Tarif::selectList( $nurse_station->asuransi_id );


		return view('periksas.create', compact(
			'nurse_station',
			'periksa_last',
			'tarif_selection',
			'tarif_id_jasa_dokter',
			'tindakans'
		));
	}
	public function edit($id){
		$periksa              = Periksa::with('pasien.alergi', 'nurseStation')->where('id',$id)->first();
		$tindakans            = TransaksiPeriksa::where('nurse_station_id', $periksa->nurse_station_id)->get();
		$periksa_last         = $this->periksaLast($periksa);
		$nurse_station        = NurseStation::find($periksa->nurse_station_id);
		$tarif_selection      = Tarif::selectList( $nurse_station->asuransi_id );
		$tarif_id_jasa_dokter = Tarif::where('jenis_tarif_id', 1)->where('user_id', Auth::id())->where('asuransi_id', $nurse_station->asuransi_id)->first()->id;
		/* return $tindakans; */
		return view('periksas.edit', compact(
			'periksa',
			'periksa_last',
			'tarif_selection',
			'tarif_id_jasa_dokter',
			'nurse_station',
			'tindakans'
		));
	}
	public function store(Request $request){
		DB::beginTransaction();
		try {
			if ($this->valid( Input::all() )) {
				return $this->valid( Input::all() );
			}

			$nurse_station_id = Input::get('nurse_station_id');
			$nurse_station    = NurseStation::find( $nurse_station_id );
			$transaksis       = TransaksiPeriksa::where('nurse_station_id', $nurse_station_id )->delete();
			$random_string    = substr(str_shuffle(MD5(microtime())), 0, 20);


			$periksa                        = new Periksa;
			$periksa->waktu_datang          = $nurse_station->waktu;
			$periksa->asuransi_id           = $nurse_station->asuransi_id;
			$periksa->pasien_id             = $nurse_station->pasien_id;
			$periksa->staf_id               = $nurse_station->staf_id;
			$periksa->anamnesa              = Input::get('anamnesa');
			$periksa->pemeriksaan_fisik     = Input::get('pemeriksaan_fisik');
			$periksa->pemeriksaan_penunjang = Input::get('pemeriksaan_penunjang');
			$periksa->diagnosa_id           = Input::get('diagnosa_id');
			$periksa->keterangan_diagnosa   = Input::get('keterangan_diagnosa');
			$periksa->poli                  = $nurse_station->poli->poli;
			$periksa->poli_id               = $nurse_station->poli_id;
			if ( !is_null( Input::get('hamil') ) ) {
				$periksa->hamil                 = Input::get('hamil');
			}
			$periksa->waktu_periksa         = Input::get('waktu_periksa');
			$periksa->berat_badan           = Input::get('berat_badan');
			$periksa->asisten_id            = $nurse_station->asisten_id;
			$periksa->kecelakaan_kerja      = $nurse_station->kecelakaan_kerja;
			$periksa->nomor_asuransi        = $nurse_station->pasien->nomor_asuransi;
			$periksa->nurse_station_id      = Input::get('nurse_station_id');
			$periksa->sistolik              = Input::get('sistolik');
			$periksa->diastolik             = Input::get('diastolik');
			$periksa->random_string         = $random_string;
			$periksa->user_id               = Auth::id();
			$periksa->save();

			$tindakans            = Input::get('tindakans');
			$keterangan_tindakans = Input::get('keterangan_tindakans');
			$data_tindakans = [];

			if ( count($tindakans) ) {
				foreach ($tindakans as $k => $tindakan) {
					$tarif = Tarif::find( $tindakan );
					if (!is_null($tindakan)) {
						$data_tindakans[] = [
							'periksa_id'             => $periksa->id,
							'tarif_id'               => $tarif->id,
							'biaya'                  => $tarif->biaya,
							'keterangan_pemeriksaan' => $keterangan_tindakans[$k],
							'user_id'                => Auth::id(),
							'nurse_station_id'       => Input::get('nurse_station_id')
						];
					}
				}
			}


			$periksa->transaksi             = json_encode($data_tindakans);
			$periksa->save();

			TransaksiPeriksa::insert($data_tindakans);

			$nurse_station->periksa_id    = $periksa->id;
			$nurse_station->random_string = $random_string;
			$nurse_station->save();

			$poli_id     = $nurse_station->poli_id;
			$nama_pasien = $periksa->pasien->nama;
			
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}

		$pesan = Yoga::suksesFlash( $periksa->pasien_id . '-'. $nama_pasien . ' berhasil diperiksa');
		return redirect('home/nurse_stations/' . $nurse_station->id . '/periksa/terapi')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}

		$nurse_station_id = Input::get('nurse_station_id');

		$nurse_station    = NurseStation::find( $nurse_station_id );

		$transaksis       = TransaksiPeriksa::where('nurse_station_id', $nurse_station_id )->delete();

		$periksa                        = Periksa::find($id);
		$periksa->waktu_datang          = $nurse_station->waktu;
		$periksa->asuransi_id           = $nurse_station->asuransi_id;
		$periksa->pasien_id             = $nurse_station->pasien_id;
		$periksa->staf_id               = $nurse_station->staf_id;
		$periksa->anamnesa              = Input::get('anamnesa');
		$periksa->pemeriksaan_fisik     = Input::get('pemeriksaan_fisik');
		$periksa->pemeriksaan_penunjang = Input::get('pemeriksaan_penunjang');
		$periksa->diagnosa_id           = Input::get('diagnosa_id');
		$periksa->keterangan_diagnosa   = Input::get('keterangan_diagnosa');
		$periksa->poli                  = $nurse_station->poli->poli;
		$periksa->poli_id               = $nurse_station->poli_id;
		$periksa->waktu_periksa         = Input::get('waktu_periksa');
		$periksa->berat_badan           = Input::get('berat_badan');
		$periksa->asisten_id            = $nurse_station->asisten_id;
		$periksa->kecelakaan_kerja      = $nurse_station->kecelakaan_kerja;
		$periksa->nomor_asuransi        = $nurse_station->pasien->nomor_asuransi;
		$periksa->nurse_station_id      = Input::get('nurse_station_id');
		$periksa->sistolik              = Input::get('sistolik');
		$periksa->diastolik             = Input::get('diastolik');
		$periksa->user_id               = Auth::id();
		$periksa->save();

		$tindakans            = Input::get('tindakans');
		$keterangan_tindakans = Input::get('keterangan_tindakans');
		$data_tindakans = [];

		if ( count($tindakans) ) {
			foreach ($tindakans as $k => $tindakan) {
				$tarif = Tarif::find( $tindakan );
				if (!is_null($tindakan)) {
					$data_tindakans[] = [
						'periksa_id'             => $periksa->id,
						'tarif_id'               => $tarif->id,
						'biaya'                  => $tarif->biaya,
						'keterangan_pemeriksaan' => $keterangan_tindakans[$k],
						'user_id'                => Auth::id(),
						'nurse_station_id'       => Input::get('nurse_station_id')
					];
				}
			}
		}

		$periksa->transaksi             = json_encode($data_tindakans);
		$periksa->save();

		TransaksiPeriksa::insert($data_tindakans);

		$periksa->save();
		$pesan = Yoga::suksesFlash('Periksa berhasil diupdate');
		return redirect('home/nurse_stations/' . $nurse_station_id . '/periksa/terapi')->withPesan($pesan);
	}
	public function transaksiPeriksa($id){
		$nurse_station = NurseStation::find( $id );
		$tarif = Tarif::where('user_id', Auth::id())->get()->get();
		return view('transaksi_periksas.create', compact(
			'tarif',
			'nurse_station'
		));
	}
	
	public function destroy($id){
		Periksa::destroy($id);
		$pesan = Yoga::suksesFlash('Periksa berhasil dihapus');
		return redirect('home/periksas')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$periksas     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$periksas[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Periksa::insert($periksas);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){

		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'anamnesa'         => 'required',
			'waktu_periksa'    => 'required|date',
			'diagnosa_id'      => 'required',
			'nurse_station_id' => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	public function statusPdf($id){
		$periksa = Periksa::with(
			'pasien', 
			'asuransi', 
			'diagnosa.icd',
			'staf'
		)->where('id', $id)->first();
        $pdf = PDF::loadView('pdfs.status', compact('periksa'))->setPaper('a5')->setOrientation('landscape')->setWarnings(false);
        return $pdf->stream();
	}
	public function strukPdf($id){
		$periksa = Periksa::find($id);
		$pdf = PDF::loadView('pdfs.struk', compact(
			'periksa'
		))
		->setOption('page-width', 72)
		->setOption('page-height', 297)
		->setOption('margin-top', 0)
		->setOption('margin-bottom', 0)
		->setOption('margin-right', 0)
		->setOption('margin-left', 0);
        return $pdf->stream();
	}
	public function icdCari(){
		$param = Input::get('q');
		$data = '%' . $param . '%';


		$query  = "SELECT id, concat(id, ' - ', diagnosaICD) as text ";
		$query .= "FROM icds ";
		$query .= "WHERE diagnosaICD like '{$data}' ";
		$query .= "LIMIT 15";
		return DB::select($query);
	}
	public function diagnosaCari(){
		$param = Input::get('q');
		$data = '%' . $param . '%';

		$query  = "SELECT dg.id, concat( diagnosa, ' (' , ic.id, ' - ', ic.diagnosaICD , ')') as text ";
		$query .= "FROM diagnosas as dg ";
		$query .= "JOIN icds as ic on ic.id = dg.icd_id ";
		$query .= "WHERE diagnosa like '{$data}' ";
		$query .= "LIMIT 15";
		return DB::select($query);
		
	}
	public function pilihDiagnosa(){
		$id = Input::get('id');
		$query  = "SELECT dg.id as diagnosa_id , diagnosa, diagnosaICD, icd_id ";
		$query .= "FROM diagnosas as dg ";
		$query .= "JOIN icds as ic on ic.id = dg.icd_id ";
		$query .= "WHERE icd_id = '{$id}';";
		return DB::select($query);

	}
	
	public function diagnosaBaru(){

		$icd_id             = Input::get('icd_id');
		

		$diagnosa           = new Diagnosa;
		$diagnosa->diagnosa = Input::get('diagnosa');
		$diagnosa->icd_id   = $icd_id;
		$diagnosa->user_id  = Auth::id();
		$diagnosa->save();

		return $diagnosa->id;

		
	}
	public function cariGenerik(){
		
		$param = Input::get('q');
		$query  = "SELECT id, generik as text ";
		$query .= "FROM generiks ";
		$query .= "WHERE generik like '%{$param}%' ";
		$query .= "LIMIT 15;";
		return DB::select($query);

	}
	
	public function tambahAlergi(){
		$generik_id = Input::get('generik_id');
		$pasien_id  = Input::get('pasien_id');

		$alergi             = new Alergi;
		$alergi->generik_id = $generik_id;
		$alergi->pasien_id  = $pasien_id;
		$alergi->save();

		$alergis = $alergi->pasien->alergi;

		$data = [];
		foreach ($alergis as $alergi) {
			$data[] = [
				'id'      => $alergi->id,
				'generik_id' => $alergi->generik_id,
				'generik' => $alergi->generik->generik
			];
		}

		return $data;

	}
	public function hapusAlergi(){
		$id        = Input::get('id');
		$pasien_id = Input::get('pasien_id');
		if (Alergi::destroy($id)) {
			$alergis = Alergi::where('pasien_id', $pasien_id)->get();
			$data = [];
			foreach ($alergis as $al) {
				$data[] = [
					'id'         => $al->id,
					'generik_id' => $al->generik_id,
					'generik'    => $al->generik->generik
				];
			}
			return $data;
		}
	}
	/**
	* undocumented function
	*
	* @return void
	*/
	private function periksaLast($nurse_station)
	{
		return Periksa::where('pasien_id', $nurse_station->pasien_id)->where('postKasir' , '1')->latest()->first();
	}
	/**
	* cari tindakan dengan ajax
	*
	* @return array
	*/
	public function tindakanCari($asuransi_id)
	{
		$param = Input::get('q');
		$query  = "SELECT id, generik as text ";
		$query .= "FROM generiks ";
		$query .= "WHERE generik like '%{$param}%' ";
		$query .= "LIMIT 15;";
		return DB::select($query);
	}

			
}
