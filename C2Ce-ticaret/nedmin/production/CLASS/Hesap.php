<?php
/**
 * 
 */
class Hesap
{

	private $hesap_id;
	private $hesap_adi;
	private $hesap_tarih;
	private $hesap_iban;
	private $durum;
	private $kullanici_id;
	
	function __construct($hesap_id,$hesap_adi,$hesap_tarih,$hesap_iban,$durum,$kullanici_id)
	{
		// code...
		$this->hesap_id = $hesap_id;
		$this->hesap_adi = $hesap_adi;
		$this->hesap_tarih = $hesap_tarih;
		$this->hesap_iban = $hesap_iban;
		$this->durum = $durum;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_hesap_id($hesap_id) {
		$this->hesap_id = $hesap_id;
	}

	public function get_hesap_id() {
		return $this->hesap_id;
	}

	public function set_hesap_adi($hesap_adi) {
		$this->hesap_adi = $hesap_adi;
	}

	public function get_hesap_adi() {
		return $this->hesap_adi;
	}

	public function set_hesap_tarih($hesap_tarih) {
		$this->hesap_tarih = $hesap_tarih;
	}

	public function get_hesap_tarih() {
		return $this->hesap_tarih;
	}

	public function set_hesap_iban($hesap_iban) {
		$this->hesap_iban = $hesap_iban;
	}

	public function get_hesap_iban() {
		return $this->hesap_iban;
	}

	public function set_durum($durum) {
		$this->durum = $durum;
	}

	public function get_durum() {
		return $this->durum;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>