<?php

/*
|--------------------------------------------------------------------------
| Web Routes
a--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes(['verify' => true]);
Route::get('/', 'HomeController@index');
Route::group(['middleware' => ['verified']], function () {
	Route::get('home/pasiens/photo_terdeteksi', 'PasienController@photoTerdeteksi');
	Route::resource('home/asuransis', 'AsuransiController');
	Route::resource('home/suppliers', 'SupplierController');
	Route::resource('home/pasiens', 'PasienController');
	Route::resource('home/roles', 'RoleController');
	Route::resource('home/users', 'UserController');
	Route::resource('home/stafs', 'StafController');
	Route::get('home/generiks/search/ajax', 'GenerikController@searchAjax');
	Route::get('/home/obats/search/ajax', 'ObatController@searchAjax');
	Route::get('/home/aturan_minum/search/ajax', 'AturanMinumController@searchAjax');
	Route::get( '/home/signa/search/ajax', 'SignaController@searchAjax');
	Route::get( '/home/coa/search/ajax', 'CoaController@searchAjax');
	Route::get( '/home/tarifs/search/ajax', 'TarifController@searchAjax');
	Route::get( '/home/icds/search/ajax', 'IcdController@searchAjax');
	Route::get( '/home/diagnosas/search/ajax', 'DiagnosaController@searchAjax');
	Route::get('home/terapis/aturan_minum/cari', 'TerapiController@aturanMinumSearch');
	Route::get('home/terapis/signa/cari', 'TerapiController@signaSearch');
	Route::post( '/home/terapis/create/signa', 'TerapiController@createSigna');
	Route::post( '/home/terapis/create/aturan_minum', 'TerapiController@createAturanMinum');

	Route::resource('home/generiks', 'GenerikController');
	Route::get('home/terapis/jenis_obat_standar', 'ObatController@jenisObatStandar');
	Route::get('home/terapis/jenis_obat_add', 'ObatController@jenisObatAdd');
	Route::resource('home/obats', 'ObatController');
	Route::resource('home/coas', 'CoaController');
	Route::get('home/terapis/jenis_obat_puyer', 'ObatController@jenisObatPuyer');
	Route::get('home/nurse_stations/{id}/periksa/terapi', 'TerapiController@create');
	Route::get('terapis/obat/cari/ajax', 'TerapiController@obatAjax');
	Route::get('terapis/obat/cari/ajax/{jenis_obat}', 'TerapiController@obatAjaxCustom');
	Route::get('home/terapis/signa', 'TerapiController@signaCreate');
	Route::get('home/terapis/aturan_minum', 'TerapiController@aturanMinumCreate');

	Route::resource('home/terapis', 'TerapiController');
	Route::post('home/antrian_apoteks/{id}/kembalikan', 'AntrianApotekController@kembalikan');
	Route::get('home/pasiens/{id}/riwayat', 'PasienController@riwayat');
	Route::get('home/transaksi_periksa/{id}/create', 'PeriksaController@transaksiPeriksa');
	Route::get('home/nursestation/{id}/create', 'NurseStationController@create');
	Route::get('home/antrian_apoteks/{id}/periksa', 'AntrianApotekController@create');
	Route::resource('home/nurse_stations', 'NurseStationController');
	Route::resource('home/kelompok_coas', 'KelompokCoaController');
	Route::resource('home/aturan_minums', 'AturanMinumController');
	Route::resource('home/antrian_apoteks', 'AntrianApotekController');
	Route::post('home/kasirs/{id}/kembalikan', 'KasirController@kembalikan');
	Route::get('home/kasirs/{id}/create', 'KasirController@create');
	Route::get('periksa/icd/cari', 'PeriksaController@icdCari');
	Route::get('periksa/diagnosa/cari', 'PeriksaController@diagnosaCari');
	Route::get('periksa/tindakan/cari/{asuransi_id}', 'PeriksaController@tindakanCari');

	Route::get( 'periksa/pilih/diagnosa/fromIcd', 'PeriksaController@pilihDiagnosa');
	Route::post( 'periksas/diagnosa/baru', 'PeriksaController@diagnosaBaru');
	Route::get('periksa/generik/cari', 'PeriksaController@cariGenerik');
	Route::post('periksas/alergi/tambah', 'PeriksaController@tambahAlergi');
	Route::post( 'alergies/hapus', 'PeriksaController@hapusAlergi');



	Route::get('home/kasirs/getBiaya', 'KasirController@getBiaya');
	Route::get('home/transaksis/pengeluaran', 'KasirController@pengeluaran');
	Route::get('home/faktur_belanja_obats/ajaxGetObat', 'KasirController@ajaxGetObat');
	Route::resource('home/faktur_belanja_obats', 'FakturBelanjaObatController');

	Route::resource('home/kasirs', 'KasirController');
	Route::resource('home/polis', 'PoliController');
	Route::resource('home/jenis_tarifs', 'JenisTarifController');
	Route::resource('home/tarifs', 'TarifController');
	Route::resource('home/icds', 'IcdController');
	Route::get('home/nurse_stations/{id}/periksa/diagnosas/create', 'DiagnosaController@create');
	Route::resource('home/diagnosas', 'DiagnosaController');
	Route::get('home/transaksi_periksas/{id}/create', 'TransaksiPeriksaController@create');
	Route::resource('home/transaksis', 'TransaksiPeriksaController');
	Route::resource('home/signas', 'SignaController');
	Route::get('home/nurse_stations/{id}/periksa', 'PeriksaController@create');
	Route::get('home/periksas/{id}/status/pdf', 'PeriksaController@statusPdf');
	Route::get('home/periksas/{id}/struk/pdf', 'PeriksaController@strukPdf');
	Route::resource('home/periksas', 'PeriksaController');
	Route::get('home/pasiens/{id}/daftar', 'DaftarController@create');
	Route::resource('home/daftars', 'DaftarController');
	Route::get('home/pasiens/ajax/selectpasien', 'PasienController@selectPasien');
	Route::get('home/pasiens/ajax/cekimage', 'PasienController@cekImage');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('home/qrcode', 'QrcodeController@index');
	Route::get('home/pasiens/pasienimage/{filename}', 'PasienController@userImagePath');
});
Route::get('home/pasiens/image/{id}', 'PasienController@photoCapture');
Route::post('home/pasiens/image', 'PasienController@storePhoto');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
