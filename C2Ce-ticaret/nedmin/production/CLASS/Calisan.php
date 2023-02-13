<?php
/**
 * 
 */
class Calisan
{

	private $calisan_id;
	private $calisan_ad;
	private $calisan_soyad;
	private $calisan_maas;
	private $kullanici_id;
	private $calisan_departman;
	private $calisan_unvan;
	private $islem_kullanici_id;
	private $toplammaas;
	
	function __construct($calisan_id,$calisan_ad,$calisan_soyad,$calisan_maas,$kullanici_id,$calisan_departman,$calisan_unvan,$islem_kullanici_id,$toplammaas)
	{
		// code...
		$this->calisan_id = $calisan_id;
		$this->calisan_ad = $calisan_ad;
		$this->calisan_soyad = $calisan_soyad;
		$this->calisan_maas = $calisan_maas;
		$this->kullanici_id = $kullanici_id;
		$this->calisan_departman = $calisan_departman;
		$this->calisan_unvan = $calisan_unvan;
		$this->islem_kullanici_id = $islem_kullanici_id;
		$this->toplammaas = $toplammaas;
	}

	public function set_calisan_id($calisan_id) {
		$this->calisan_id = $calisan_id;
	}

	public function get_calisan_id() {
		return $this->calisan_id;
	}

	public function set_calisan_ad($calisan_ad) {
		$this->calisan_ad = $calisan_ad;
	}

	public function get_calisan_ad() {
		return $this->calisan_ad;
	}

	public function set_calisan_soyad($calisan_soyad) {
		$this->calisan_soyad = $calisan_soyad;
	}

	public function get_calisan_soyad() {
		return $this->calisan_soyad;
	}

	public function set_calisan_maas($calisan_maas) {
		$this->calisan_maas = $calisan_maas;
	}

	public function get_calisan_maas() {
		return $this->calisan_maas;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_calisan_departman($calisan_departman) {
		$this->calisan_departman = $calisan_departman;
	}

	public function get_calisan_departman() {
		return $this->calisan_departman;
	}

	public function set_calisan_unvan($calisan_unvan) {
		$this->calisan_unvan = $calisan_unvan;
	}

	public function get_calisan_unvan() {
		return $this->calisan_unvan;
	}

	public function set_islem_kullanici_id($islem_kullanici_id) {
		$this->islem_kullanici_id = $islem_kullanici_id;
	}

	public function get_islem_kullanici_id() {
		return $this->islem_kullanici_id;
	}

	public function set_toplammaas($toplammaas) {
		$this->toplammaas = $toplammaas;
	}

	public function get_toplammaas() {
		return $this->toplammaas;
	}
}
?>