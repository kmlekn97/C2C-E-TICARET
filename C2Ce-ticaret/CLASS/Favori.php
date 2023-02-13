<?php
/**
 * 
 */
class Favori
{

	private $favoriler_id;
	private $urun_id;
	private $kullanici_id;
	private $favori_fiyat;
	private $favori_durum;
	
	function __construct($favoriler_id,$urun_id,$kullanici_id,$favori_fiyat,$favori_durum)
	{
		$this->favoriler_id = $favoriler_id;
		$this->urun_id = $urun_id;
		$this->kullanici_id = $kullanici_id;
		$this->favori_fiyat = $favori_fiyat;
		$this->favori_durum = $favori_durum;
	}

	public function set_favoriler_id($favoriler_id) {
		$this->favoriler_id = $favoriler_id;
	}

	public function get_favoriler_id() {
		return $this->favoriler_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_favori_fiyat($favori_fiyat) {
		$this->favori_fiyat = $favori_fiyat;
	}

	public function get_favori_fiyat() {
		return $this->favori_fiyat;
	}

	public function set_favori_durum($favori_durum) {
		$this->favori_durum = $favori_durum;
	}

	public function get_favori_durum() {
		return $this->favori_durum;
	}
}
?>