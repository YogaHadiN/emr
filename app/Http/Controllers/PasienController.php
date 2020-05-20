<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Pasien;
use App\Asuransi;
use App\Events\photoDetected;
use App\Yoga;
use Image;
use Auth;
use Response;
use DB;
use Storage;
use File;

class PasienController extends Controller
{
		public $input_nama;
		public $input_asuransi_id;
		public $input_nama_peserta;
		public $input_nomor_asuransi;
		public $input_jenis_peserta_id;
		public $input_alamat;
		public $input_sex;
		public $input_tanggal_lahir;
		public $input_no_ktp;
		public $input_no_telp;
		public $input_nama_ayah;
		public $input_nama_ibu;
		public $input_riwayat_alergi_obat;
		public $input_riwayat_penyakit_dahulu;
		public $input_image;
		public $input_ktp_image;
		public $input_email;
		public $input_bpjs_image;
		public $input_nomor_asuransi_bpjs;
		public $input_nomor_ktp;
		private $random_string;
	/**
	* @param 
	*/
	public function __construct()
	{
		$this->input_nama                    = Input::get('nama');
		$this->input_asuransi_id             = Input::get('asuransi_id');
		$this->input_nama_peserta            = Input::get('nama_peserta');
		if ($this->input_asuransi_id > 1 && empty($this->input_nama_peserta)) {
			$this->input_nama_peserta        = $this->input_nama;
		}
		$this->input_nomor_asuransi          = Input::get('nomor_asuransi');
		$this->input_jenis_peserta_id        = Input::get('jenis_peserta_id');
		$this->input_alamat                  = Input::get('alamat');
		$this->input_sex                     = Input::get('sex');
		$this->input_tanggal_lahir           = Yoga::datePrep(Input::get('tanggal_lahir'));
		$this->input_no_ktp                  = Input::get('no_ktp');
		$this->input_no_telp                 = Input::get('no_telp');
		$this->input_nama_ayah               = Input::get('nama_ayah');
		$this->input_nama_ibu                = Input::get('nama_ibu');
		$this->input_riwayat_alergi_obat     = Input::get('riwayat_alergi_obat');
		$this->input_riwayat_penyakit_dahulu = Input::get('riwayat_penyakit_dahulu');
		$this->input_email                   = Input::get('email');
		$this->input_nomor_asuransi_bpjs     = Input::get('nomor_asuransi_bpjs');
		$this->input_nomor_ktp               = Input::get('nomor_ktp');
		$this->random_string                 = Input::get('random_string');
	}
	
	public function index(){

		$ps               = new Pasien;
		$as               = new Asuransi;
		$statusPernikahan = $ps->statusPernikahan();
		$panggilan        = $ps->panggilan();
		$asuransi         = Yoga::asuransiList();
		$jenis_peserta    = $as->jenisPeserta();
		$peserta          = [ null => '- Pilih -', '0' => 'Peserta Klinik', '1' => 'Bukan Peserta Klinik'];
		$poli             = Yoga::poliList();
		$staf             = Yoga::stafList();
		return view('pasiens.index', compact(
			'statusPernikahan',
			'panggilan',
			'peserta',
			'jenis_peserta',
			'asuransi',
			'poli',
			'staf'
		));
	}

	public function create(){
		$url           = url('/home/pasiens/image');
		$random_string = substr(str_shuffle(MD5(microtime())), 0, 10);
		$asuransis     = Asuransi::where('user_id', Auth::id())->pluck('nama_asuransi', 'id');
		$asuransis[1]  = 'Tidak Ada Asuransi';
		return view('pasiens.create', compact(
			'url',
			'random_string',
			'asuransis'
		));
	}

	public function store(){
		$messages = [

			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'tanggal_lahir' => 'date|date_format:d-m-Y',
			'nama'          => 'required',
			'sex'           => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$pasien = new Pasien;
		$pasien = $this->inputData($pasien);
		$pasien->save();
		$pesan = Yoga::suksesFlash('Pasien '. $pasien->id . '-' . $pasien->nama . ' <strong>BERHASIL</strong> diubah');
		return redirect('home/pasiens')->withPesan($pesan);
	}
	public function update($id){
		$messages = [

			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'tanggal_lahir' => 'date|date_format:d-m-Y',
			'nama'          => 'required',
			'tanggal_lahir' => 'required',
			'sex'           => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		$pasien = Pasien::find($id);
		$pasien = $this->inputData($pasien);
		$pasien->save();
		$pesan = Yoga::suksesFlash('Pasien '. $pasien->id . '-' . $pasien->nama . ' <strong>BERHASIL</strong> diubah');
		return redirect('home/pasiens')->withPesan($pesan);
	}
	
	public function edit($id){
		$pasien = Pasien::find( $id );
		$url    = url('/home/pasiens/image');

		if ($pasien->user_id != Auth::id()) {
			$pesan = Yoga::gagalFlash('Maaf anda tidak bisa mengakses pasien ini');
			return redirect('home')->withPesan($pesan);
		}
		$random_string = substr(str_shuffle(MD5(microtime())), 0, 10);

		$asuransis     = Asuransi::where('user_id', Auth::id())->pluck('nama_asuransi', 'id');
		$asuransis[1]  = 'Tidak Ada Asuransi';
		return view('pasiens.edit', compact(
			'pasien',
			'url',
			'random_string',
			'asuransis'
		));


	}
	
	public function selectPasien(){
		if(Input::ajax()){

			$ID_PASIEN     = Input::get('id');
		    $nama          = Input::get('nama');
    		$namaPasien    = $this->pecah(Input::get('nama'));
		    $alamats       = Input::get('alamat');
            $array         = str_split($alamats);
			$alamat        = $this->pecah($alamats);
		    $tanggalLahir  = Yoga::datePrep(Input::get('tanggal_lahir'));
		    $noTelp        = Input::get('no_telp');
		    $namaIbu       = $this->pecah(Input::get('nama_ibu'));
		    $namaAyah      = $this->pecah(Input::get('nama_ayah'));
		    $namaPeserta   = Input::get('nama_peserta');
		    $namaAsuransi  = Input::get('nama_asuransi');
		    $nomorAsuransi = Input::get('nomorAsuransi');


		    $displayed_rows = Input::get('displayed_rows');
		    $key            = Input::get('key');
			$data           = $this->queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key);


			$count          = $this->queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key, true)[0]->jumlah;
			$pages          = ceil( $count/ $displayed_rows );

			return [
				'data'  => $data,
				'pages' => $pages,
				'key'   => $key,
				'rows'  => $count
			];
		}
	}
	private function queryData($ID_PASIEN, $namaPasien, $alamat, $tanggalLahir, $noTelp, $namaAsuransi, $nomorAsuransi, $namaPeserta, $namaIbu, $namaAyah, $displayed_rows, $key, $count = false){
			$pass = $key * $displayed_rows;

			$query  = "SELECT ";
			if (!$count) {
				$query .= "p.asuransi_id, p.id as ID_PASIEN, ";
				$query .= "p.nama as namaPasien, ";
				$query .= "p.alamat, ";
				$query .= "p.tanggal_lahir as tanggalLahir, ";
				$query .= "p.no_telp as noTelp, ";
				$query .= "asu.nama_asuransi as namaAsuransi, ";
				$query .= "p.nomor_asuransi as nomorAsuransi, ";
				$query .= "p.nama_peserta as namaPeserta, ";
				$query .= "p.nama_ibu as namaIbu, ";
				$query .= "p.nama_ayah as namaAyah, ";
				$query .= "p.image as image ";
			} else {
				$query .= "count(p.id) as jumlah ";
			}
			$query .= "FROM pasiens as p left outer join asuransis as asu on p.asuransi_id = asu.id ";
			$query .= "WHERE ";
			$query .= "(p.id like '%{$ID_PASIEN}%' or p.id is null) ";
			$query .= "AND (p.nama like '%{$namaPasien}%' or p.nama is null) ";
			$query .= "AND (p.alamat like '%{$alamat}%' or p.alamat is null) ";
			$query .= "AND (p.tanggal_lahir like '%{$tanggalLahir}%' or p.tanggal_lahir is null) ";
			$query .= "AND (p.no_telp like '%{$noTelp}%' or p.no_telp is null) ";
			$query .= "AND (asu.nama_asuransi like '%{$namaAsuransi}%' or asu.nama_asuransi is null) ";
			$query .= "AND (p.nomor_asuransi like '%{$nomorAsuransi}%' or p.nomor_asuransi is null) ";
			$query .= "AND (p.nama_peserta like '%{$namaPeserta}%' or p.nama_peserta is null) ";
			$query .= "AND (p.nama_ibu like '%{$namaIbu}%' or p.nama_ibu is null) ";
			$query .= "AND (p.nama_ayah like '%{$namaAyah}%' or p.nama_ayah is null) ";
			$query .= "AND p.user_id = " . Auth::id() . " ";
			/* $query .= "GROUP BY p.id "; */
			$query .= "ORDER BY p.created_at DESC ";


			if (!$count) {
				$query .= "LIMIT {$pass}, {$displayed_rows} ";
			}

			return DB::select($query);
	}

	public function pecah($nama){
		$array      = str_split($nama);
		$namaPasien = '';
		if ( count($array) > 1 ) {
			foreach ($array as $arr) {
				$namaPasien .= $arr . '%';
			}
		}
		return $namaPasien;
	}
	private function returnNullIfEmpty($var){
		if ( empty($var) ) {
			return [
				'',
				'null'
			];
		} else {
			return [
				"'". $var . "'",
				"'". $var . "'"
			];
		}

	}
	private function returnZeroIfNull($var){
		if ( is_null($var) ) {
			return '0' ;
		} else {
			return '1';
		}
	}
	private function returnZeroIfNotSet($var){
		if ( !isset($var) ) {
			return '0' ;
		} else {
			return '1';
		}
	}
	public function photoCapture($id){
		$random_string = $id;
		return view('pasiens.image', compact(
			'random_string'
		));
	}
	public function destroy($id){
		$pasien      = Pasien::find( $id );
		$nama_pasien = $pasien->nama;
		if ($pasien->delete()) {
			$pesan = Yoga::suksesFlash('Pasien ' . $id . '-' . $nama_pasien . ' <strong>BERHASIL</strong> dihapus');
			return redirect('home/pasiens')->withPesan($pesan);
		} else {
			$pesan = Yoga::gagalFlash('Pasien ' . $id . '-' . $nama_pasien . ' <strong>GAGAL</strong> dihapus');
			return redirect('home/pasiens')->withPesan($pesan);
		}
	}
	public function storePhoto(){
		if ( Input::hasFile('gambar') ) {
			$filename = 'pasien-' . Input::get('random_string') . '.jpg';
			$file = Input::file('gambar');

			Storage::disk('local')->put($filename, File::get($file));
		} 
		if ( Input::hasFile('ktp') ) {
			$filename = 'ktp-' . Input::get('random_string') . '.jpg';
			$file = Input::file('ktp');
			Storage::disk('local')->put($filename, File::get($file));
		} 
		if ( Input::hasFile('bpjs') ) {
			$filename = 'bpjs-' . Input::get('random_string') . '.jpg';
			$file = Input::file('bpjs');
			Storage::disk('local')->put($filename, File::get($file));
		} 
		return Input::all(); 
		
		return Input::file('gambar'); 
	}
	public function userImagePath($filename){
		$file = Storage::disk('local')->get($filename);
		return $file;
	}
	public function cekImage(){
		$random_string = Input::get('random_string');	
		$filename = 'pasien-' . $random_string . '.jpg';
		$data = [
			'pasien' => null,
			'ktp'    => null,
			'bpjs'   => null
		];
		$array = [];
		foreach ($data as $k => $d) {
			$filename = $k . '-' . $random_string . '.jpg';
			if (Storage::disk('local')->has($filename)) {
				$array[] = [
					'label' => $k,
					'link' => $filename
				];
			}
		}
		return $array;
	}
	private function storeImage($filename, $filenametostore){
		$img = Image::make(Storage::disk('local')->get	($filename))->resize(800, 400, function($constraint) {
			$constraint->aspectRatio();
		});
		$img = $img->stream();
		Storage::disk('s3')->put( $filenametostore,  $img, 'public' );
	}
	public function photoTerdeteksi(){
		event(new photoDetected() );
	}
	public function riwayat($id){
		$pasien = Pasien::with('periksa.asuransi')->where( 'id', $id )->first();
		return view('pasiens.riwayat', compact(
			'pasien'
		));
	}
	/**
	* undocumented function
	*
	* @return void
	*/
	private function inputData($pasien)
	{
		$pasien->nama                    = $this->input_nama;
		$pasien->asuransi_id             = $this->input_asuransi_id;
		$pasien->nama_peserta            = $this->input_nama_peserta;
		$pasien->nomor_asuransi          = $this->input_nomor_asuransi;
		$pasien->jenis_peserta_id        = $this->input_jenis_peserta_id;
		$pasien->alamat                  = $this->input_alamat;
		$pasien->sex                     = $this->input_sex;
		$pasien->tanggal_lahir           = $this->input_tanggal_lahir;
		$pasien->no_ktp                  = $this->input_no_ktp;
		$pasien->no_telp                 = $this->input_no_telp;
		$pasien->nama_ayah               = $this->input_nama_ayah;
		$pasien->nama_ibu                = $this->input_nama_ibu;
		$pasien->riwayat_alergi_obat     = $this->input_riwayat_alergi_obat;
		$pasien->riwayat_penyakit_dahulu = $this->input_riwayat_penyakit_dahulu;
		$pasien->image                   = $this->input_image;
		$pasien->ktp_image               = $this->input_ktp_image;
		$pasien->email                   = $this->input_email;
		$pasien->bpjs_image              = $this->input_bpjs_image;
		$pasien->nomor_asuransi_bpjs     = $this->input_nomor_asuransi_bpjs;
		$pasien->nomor_ktp               = $this->input_nomor_ktp;
		$pasien->user_id                 = Auth::id();
		$pasien->save();
		$pasien->bpjs_image              = $this->imageUpload("pasiens", 'bpjs','bpjs_image', $pasien->id);
		$pasien->ktp_image               = $this->imageUpload("pasiens", 'ktp','ktp_image', $pasien->id);
		$pasien->image                   = $this->imageUpload("pasiens", 'pasien', 'image', $pasien->id);
		return $pasien;
	}
	/**
	* undocumented function
	*
	* @return void
	*/
	private function imageStore($pasien, $prefix)
	{
		$filename = $prefix . '-' . $this->random_string . '.jpg';
		if (Storage::disk('local')->has($filename)) {
			$filenametostore = 'pasiens/' . $prefix . $pasien->id .'.jpg';
			$this->storeImage($filename, $filenametostore);
			$pasien->image   = $filenametostore;
		}
		return $pasien;
	}
	
	public function imageUpload($folder, $pre, $fieldName, $id){
		if(Input::hasFile($fieldName) ) {

			$upload_cover = Input::file($fieldName);
			//mengambil extension
			$extension = $upload_cover->getClientOriginalExtension();

			$upload_cover = Image::make($upload_cover);
			$upload_cover->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			//membuat nama file random + extension
			$filename =	 $pre . $id . '.' . $extension;

			//menyimpan bpjs_image ke folder public/img
			$destination_path = public_path() . DIRECTORY_SEPARATOR . $folder;
			// Mengambil file yang di upload

			/* $upload_cover->save($destination_path . '/' . $filename); */
			Storage::disk('s3')->put( $destination_path . '/' . $filename,   $upload_cover->stream(), 'public' );
			
			//mengisi field bpjs_image di book dengan filename yang baru dibuat
			return $destination_path .'/'. $filename;
			
		} else {
			return null;
		}
	}
}
