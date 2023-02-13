<?php
/**
 * 
 */
require_once 'CLASS/Urun_Ozelliklerim.php';
class Ozellik_Detay extends Urun_Ozelliklerim
{
	
	private $ozellik_detay_id;
	private $urun_ozellikleri_id;
	private $ozellik_detay;
	private $kullanici_id;

	function __construct($ozellik_detay_id,$urun_ozellikleri_id,$ozellik_detay,$kullanici_id,$alt_kategori_detay_id,$ozellik_adi,$ozellik_durum)
	{
		// code...
		$this->ozellik_detay_id = $ozellik_detay_id;
		$this->urun_ozellikleri_id = $urun_ozellikleri_id;
		$this->ozellik_detay = $ozellik_detay;
		$this->kullanici_id = $kullanici_id;
		$this->urun_ozellikleri_id = $urun_ozellikleri_id;
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->ozellik_adi = $ozellik_adi;
		$this->ozellik_durum = $ozellik_durum;
	}

	public function set_ozellik_detay_id($ozellik_detay_id) {
		$this->ozellik_detay_id = $ozellik_detay_id;
	}

	public function get_ozellik_detay_id() {
		return $this->ozellik_detay_id;
	}

	public function set_urun_ozellikleri_id($urun_ozellikleri_id) {
		$this->urun_ozellikleri_id = $urun_ozellikleri_id;
	}

	public function get_urun_ozellikleri_id() {
		return $this->urun_ozellikleri_id;
	}

	public function set_ozellik_detay($ozellik_detay) {
		$this->ozellik_detay = $ozellik_detay;
	}

	public function get_ozellik_detay() {
		return $this->ozellik_detay;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_alt_kategori_detay_id($alt_kategori_detay_id) {
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
	}

	public function get_alt_kategori_detay_id() {
		return $this->alt_kategori_detay_id;
	}

	public function set_ozellik_adi($ozellik_adi) {
		$this->ozellik_adi = $ozellik_adi;
	}

	public function get_ozellik_adi() {
		return $this->ozellik_adi;
	}

	public function set_ozellik_durum($ozellik_durum) {
		$this->ozellik_durum = $ozellik_durum;
	}

	public function get_ozellik_durum() {
		return $this->ozellik_durum;
	}
}
?>