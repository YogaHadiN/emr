<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obat;
use Auth;
use App\AturanMinum;
use App\Signa;



class Periksa extends Model
{

	private $puyer       = false;
	private $add         = false;
	private $finishPuyer = false;
	public function asuransi(){
		return $this->belongsTo('App\Asuransi');
	}
	public function pasien(){
		return $this->belongsTo('App\Pasien');
	}
	public function staf(){
		return $this->belongsTo('App\Staf');
	}
	public function diagnosa(){
		return $this->belongsTo('App\Diagnosa');
	}
	public function asisten(){
		return $this->belongsTo('App\Staf', 'asisten_id');
	}
	public function nurseStation(){
		return $this->belongsTo('App\NurseStation');
	}
	public function transaksiPeriksa(){
		return $this->hasMany('App\TransaksiPeriksa');
	}
	public function terapis(){
		return $this->hasMany('App\Terapi');
	}
	
	public function getTerapiTempAttribute(){
		
		$terapis =  json_decode($this->terapi, true);
		$obatPuyer = false;
		$puyer = false;
		$add   = false;
		$temp  = '<table class="table table-condensed">';
		$temp  .= '<tbody>';
		foreach($terapis as $i => $d) {
			if ( ( isset( $terapis[$i-1] ) && $terapis[$i-1]['signa_id'] == '2' ) && ( $d['obat_id'] == '1' || $d['obat_id'] == '3' )  ){
				// signa_id = 2 puyer
				// obat_id = 1 kertas puyer sablon
				// obat_id = 3 kertas puyer biasa
				$finishPuyer = true;
				$puyer       = false;
				$add         = false;
				$temp .= '<tr>';
				$temp .= '<td></td>';
				$temp .= '<td style="border-bottom:1px solid #000;">Buat menjadi ' . $d['jumlah'] . ' puyer</td>';
				$temp .= '<td style="border-bottom:1px solid #000;">' . $d['aturan_minum_text']. '</td>';
				$temp .= '</tr>';
			} else if ( ( isset( $terapis[$i-1] ) && $terapis[$i-1]['signa_id'] == '1' ) && $d['obat_id'] == '2'  ){
				$finishAdd   = true;
				$finishPuyer = false;
				$puyer       = false;
				$add         = false;
				$temp .= '<tr>';
				$temp .= '<td></td>';
				$temp .= '<td style="border-bottom:1px solid #000;">S masukkan ke dalam sirup  ' . $d['signa_text'] . '</td>';
				$temp .= '<td style="border-bottom:1px solid #000;">' . $d['aturan_minum_text']. '</td>';
				$temp .= '</tr>';
			}else if ( $d['signa_id'] >  2) { //signa_id > 3 = tipe resep standar
				$temp .= '<tr>';
				$temp .= '<td>R/</td>';
				$temp .= '<td>' . $d['obat_text']. '</td>';
				$temp .= '<td>No ' . $d['jumlah']. '</td>';
				$temp .= '</tr>';
				$temp .= '<tr>';
				$temp .= '<td></td>';
				$temp .= '<td style="border-bottom:1px solid #000;">' . $d['signa_text']. '</td>';
				$temp .= '<td style="border-bottom:1px solid #000;">' . $d['aturan_minum_text']. '</td>';
				$temp .= '</tr>';
			} else if ( $d['signa_id'] == '2' && ( isset( $terapis[$i-1] ) && $terapis[$i-1]['signa_id'] == '2' )){
				$this->kondisikanSeleksiPuyer();
				$temp .= '<tr>';
				$temp .= '<td></td>';
				$temp .= '<td>' . $d['obat_text']. '</td>';
				$temp .= '<td>No ' . $d['jumlah']. '</td>';
				$temp .= '</tr>';
			} else if ( $d['signa_id'] == '2' ){
				$this->kondisikanSeleksiPuyer();
				$temp .= '<tr>';
				$temp .= '<td>R/</td>';
				$temp .= '<td>' . $d['obat_text']. '</td>';
				$temp .= '<td>No ' . $d['jumlah']. '</td>';
				$temp .= '</tr>';
			} else if ( $d['signa_id'] == '1' && ( isset( $terapis[$i-1] ) && $terapis[$i-1]['signa_id'] == '1' )){
				$this->kondisikanSeleksiAdd();
				$temp .= '<tr>';
				$temp .= '<td></td>';
				$temp .= '<td>' . $d['obat_text']. '</td>';
				$temp .= '<td>No ' . $d['jumlah']. '</td>';
				$temp .= '</tr>';
			} else if ( $d['signa_id'] == '1' ){
				$this->kondisikanSeleksiAdd();
				if (!$obatPuyer) {
					$obatPuyer = true;
				}
				$temp .= '<tr>';
				$temp .= '<td>R/</td>';
				$temp .= '<td>' . $d['obat_text']. '</td>';
				$temp .= '<td>fls No. ' . $d['jumlah']. '</td>';
				$temp .= '</tr>';
				$temp .= '<tr>';
				$temp .= '<td colspan="3" style="text-align:center">ADD</td>';
				$temp .= '</tr>';
			}
		}
		$temp  .= '</tbody>';
		$temp  .= '</table>';
		return $temp;
	}
	private function kondisikanSeleksiPuyer(){
		$finishPuyer = false;
		$puyer       = true;
		$add         = false;
	}
	private function kondisikanSeleksiAdd(){
		$finishPuyer = false;
		$puyer       = false;
		$add         = true;
	}

	public function getTerapiApotekAttribute(){
		$terapi = $this->terapis;
		$data = [];
		foreach ($terapi as $t) {
			$data[] = [
				'tipe_resep_id'     => $t->tipe_resep_id,
				'signa_id'          => $t->signa_id,
				'signa_text'        => $t->obat->signa,
				'obat_id'           => $t->obat_id,
				'obat_text'         => $t->obat->merek,
				'aturan_minum_id'   => $t->aturan_minum_id,
				'aturan_minum_text' => $t->aturanMinum->aturan_minum,
				'jumlah'            => $t->jumlah,
				'harga_beli_satuan' => $t->obat->harga_beli,
				'harga_jual_satuan' => $t->obat->harga_jual,
				'periksa_id'        => $this->id,
				'nurse_station_id'  => $this->nurse_station_id,
				'user_id'           => Auth::id()
			];
		}	
		return json_encode( $data );
	}
	public function getTanggalAttribute(){
		$waktu = $this->waktu_datang;
		return date("d-m-Y", strtotime($waktu));
	}
	
	public function getJamAttribute(){
		$waktu = $this->waktu_datang;
		return date("H:i:s", strtotime($waktu));
	}
	public function getTotalBiayaAttribute(){

		$total_biaya = 0;
		foreach (json_decode($this->nota) as $nota) {
			$total_biaya += (int) $nota->biaya;
		}

		return $total_biaya;
		
	}
	
}
