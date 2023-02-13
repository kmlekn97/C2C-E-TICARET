<?php
/**
 * 
 */
require_once 'CLASS/Hesap.php';
class Cari_Islem extends Hesap
{

	private $hesap_islem_id;
	private $hesap_id;
	private $islem_tarih;
	private $islem_tip;
	private $islem_ucret;
	private $islem_aciklama;
	private $kullanici_id;
	private $gelir;
	private $gider;
	private $kargogider;
	
	function __construct($hesap_islem_id,$hesap_id,$islem_tarih,$islem_tip,$islem_ucret,$islem_aciklama,$kullanici_id,$hesap_adi,$hesap_tarih,$hesap_iban,$durum,$gelir,$gider,$kargogider)
	{
		// code...
		$this->hesap_islem_id = $hesap_islem_id;
		$this->hesap_id = $hesap_id;
		$this->islem_tarih = $islem_tarih;
		$this->islem_tip = $islem_tip;
		$this->islem_ucret = $islem_ucret;
		$this->islem_aciklama = $islem_aciklama;
		$this->kullanici_id = $kullanici_id;
		$this->hesap_adi = $hesap_adi;
		$this->hesap_tarih = $hesap_tarih;
		$this->hesap_iban = $hesap_iban;
		$this->durum = $durum;
		$this->gelir = $gelir;
		$this->gider = $gider;
		$this->kargogider = $kargogider;
	}

	public function set_hesap_islem_id($hesap_islem_id) {
		$this->hesap_islem_id = $hesap_islem_id;
	}

	public function get_hesap_islem_id() {
		return $this->hesap_islem_id;
	}

	public function set_hesap_id($hesap_id) {
		$this->hesap_id = $hesap_id;
	}

	public function get_hesap_id() {
		return $this->hesap_id;
	}

	public function set_islem_tarih($islem_tarih) {
		$this->islem_tarih = $islem_tarih;
	}

	public function get_islem_tarih() {
		return $this->islem_tarih;
	}

	public function set_islem_tip($islem_tip) {
		$this->islem_tip = $islem_tip;
	}

	public function get_islem_tip() {
		return $this->islem_tip;
	}

	public function set_islem_ucret($islem_ucret) {
		$this->islem_ucret = $islem_ucret;
	}

	public function get_islem_ucret() {
		return $this->islem_ucret;
	}

	public function set_islem_aciklama($islem_aciklama) {
		$this->islem_aciklama = $islem_aciklama;
	}

	public function get_islem_aciklama() {
		return $this->islem_aciklama;
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

	public function set_gelir($gelir) {
		$this->gelir = $gelir;
	}

	public function get_gelir() {
		return $this->gelir;
	}

	public function set_gider($gider) {
		$this->gider = $gider;
	}

	public function get_gider() {
		return $this->gider;
	}

	public function set_kargogider($kargogider) {
		$this->kargogider = $kargogider;
	}

	public function get_kargogider() {
		return $this->kargogider;
	}
}
?>