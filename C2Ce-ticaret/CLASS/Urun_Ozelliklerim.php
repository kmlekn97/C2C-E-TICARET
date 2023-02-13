<?php
/**
 * 
 */
class Urun_Ozelliklerim
{

	private $urun_ozellikleri_id;
	private $alt_kategori_detay_id;
	private $ozellik_adi;
	private $ozellik_durum;
	private $kullanici_id;
	
	function __construct($urun_ozellikleri_id,$alt_kategori_detay_id,$ozellik_adi,$ozellik_durum,$kullanici_id)
	{
		// code...
		$this->urun_ozellikleri_id = $urun_ozellikleri_id;
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->ozellik_adi = $ozellik_adi;
		$this->ozellik_durum = $ozellik_durum;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_urun_ozellikleri_id($urun_ozellikleri_id) {
		$this->urun_ozellikleri_id = $urun_ozellikleri_id;
	}

	public function get_urun_ozellikleri_id() {
		return $this->urun_ozellikleri_id;
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

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

}
?>