<?php
/**
 * 
 */
class Mesaj
{
	private $mesaj_id;
	private $mesaj_zaman;
	private $mesaj_detay;
	private $mesaj_konu;
	private $kullanici_gel;
	private $kullanici_gon;
	private $aciklama;
	private $mesaj_okunma;
	private $kullanici_id;
	
	function __construct($mesaj_id,$mesaj_zaman,$mesaj_detay,$mesaj_konu,$kullanici_gel,$kullanici_gon,$aciklama,$mesaj_okunma,$kullanici_id)
	{
		// code...
		$this->mesaj_id = $mesaj_id;
		$this->mesaj_zaman = $mesaj_zaman;
		$this->mesaj_detay = $mesaj_detay;
		$this->mesaj_konu = $mesaj_konu;
		$this->kullanici_gel = $kullanici_gel;
		$this->kullanici_gon = $kullanici_gon;
		$this->aciklama = $aciklama;
		$this->mesaj_okunma = $mesaj_okunma;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_mesaj_id($mesaj_id) {
		$this->mesaj_id = $mesaj_id;
	}

	public function get_mesaj_id() {
		return $this->mesaj_id;
	}

	public function set_mesaj_zaman($mesaj_zaman) {
		$this->mesaj_zaman = $mesaj_zaman;
	}

	public function get_mesaj_zaman() {
		return $this->mesaj_zaman;
	}

	public function set_mesaj_detay($mesaj_detay) {
		$this->mesaj_detay = $mesaj_detay;
	}

	public function get_mesaj_detay() {
		return $this->mesaj_detay;
	}

	public function set_mesaj_konu($mesaj_konu) {
		$this->mesaj_konu = $mesaj_konu;
	}

	public function get_mesaj_konu() {
		return $this->mesaj_konu;
	}

	public function set_kullanici_gel($kullanici_gel) {
		$this->kullanici_gel = $kullanici_gel;
	}

	public function get_kullanici_gel() {
		return $this->kullanici_gel;
	}

	public function set_kullanici_gon($kullanici_gon) {
		$this->kullanici_gon = $kullanici_gon;
	}

	public function get_kullanici_gon() {
		return $this->kullanici_gon;
	}

	public function set_aciklama($aciklama) {
		$this->aciklama = $aciklama;
	}

	public function get_aciklama() {
		return $this->aciklama;
	}

	public function set_mesaj_okunma($mesaj_okunma) {
		$this->mesaj_okunma = $mesaj_okunma;
	}

	public function get_mesaj_okunma() {
		return $this->mesaj_okunma;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>