<?php
/**
 * 
 */
require_once 'CLASS/Siparis.php';
class Iade extends Siparis
{

	private $iade_id;
	private $iade_turu;
	private $iade_aciklama;
	private $iade_tarihi;
	private $kullanici_id;
	private $siparis_id;
	private $urun_id;
	private $kargo_no;
	private $kargo_ucret;
	private $iade_durum;
	
	function __construct($iade_id,$iade_turu,$iade_aciklama,$iade_tarihi,$kullanici_id,$siparis_id,$urun_id,$kargo_no,$kargo_ucret,$iade_durum,$siparis_zaman,$kullanici_idsatici,$siparis_odeme)
	{
		// code...
		$this->iade_id = $iade_id;
		$this->iade_turu = $iade_turu;
		$this->iade_aciklama = $iade_aciklama;
		$this->iade_tarihi = $iade_tarihi;
		$this->kullanici_id = $kullanici_id;
		$this->siparis_id = $siparis_id;
		$this->urun_id = $urun_id;
		$this->kargo_no = $kargo_no;
		$this->kargo_ucret = $kargo_ucret;
		$this->iade_durum = $iade_durum;
		$this->siparis_zaman = $siparis_zaman;
		$this->kullanici_idsatici = $kullanici_idsatici;
		$this->siparis_odeme = $siparis_odeme;
	}

	public function set_iade_id($iade_id) {
		$this->iade_id = $iade_id;
	}

	public function get_iade_id() {
		return $this->iade_id;
	}

	public function set_iade_turu($iade_turu) {
		$this->iade_turu = $iade_turu;
	}

	public function get_iade_turu() {
		return $this->iade_turu;
	}

	public function set_iade_aciklama($iade_aciklama) {
		$this->iade_aciklama = $iade_aciklama;
	}

	public function get_iade_aciklama() {
		return $this->iade_aciklama;
	}

	public function set_iade_tarihi($iade_tarihi) {
		$this->iade_tarihi = $iade_tarihi;
	}

	public function get_iade_tarihi() {
		return $this->iade_tarihi;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_siparis_id($siparis_id) {
		$this->siparis_id = $siparis_id;
	}

	public function get_siparis_id() {
		return $this->siparis_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_kargo_no($kargo_no) {
		$this->kargo_no = $kargo_no;
	}

	public function get_kargo_no() {
		return $this->kargo_no;
	}

	public function set_kargo_ucret($kargo_ucret) {
		$this->kargo_ucret = $kargo_ucret;
	}

	public function get_kargo_ucret() {
		return $this->kargo_ucret;
	}

	public function set_iade_durum($iade_durum) {
		$this->iade_durum = $iade_durum;
	}

	public function get_iade_durum() {
		return $this->iade_durum;
	}

	public function set_siparis_zaman($siparis_zaman) {
		$this->siparis_zaman = $siparis_zaman;
	}

	public function get_siparis_zaman() {
		return $this->siparis_zaman;
	}

	public function set_kullanici_idsatici($kullanici_idsatici) {
		$this->kullanici_idsatici = $kullanici_idsatici;
	}

	public function get_kullanici_idsatici() {
		return $this->kullanici_idsatici;
	}

	public function set_siparis_odeme($siparis_odeme) {
		$this->siparis_odeme = $siparis_odeme;
	}

	public function get_siparis_odeme() {
		return $this->siparis_odeme;
	}
}
?>