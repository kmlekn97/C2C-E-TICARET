<?php
/**
 * 
 */
require_once 'CLASS/Siparis.php';
class Siparis_Detay extends Siparis
{

	private $siparisdetay_id;
	private $siparis_id;
	private $kullanici_id;
	private $kullanici_idsatici;
	private $urun_id;
	private $urun_fiyat;
	private $urun_adet;
	private $siparisdetay_kargozaman;
	private $siparisdetay_kargoad;
	private $siparis_kargodurum;
	private $siparisdetay_kargono;
	private $siparis_kargoucret;
	private $siparisdetay_onay;
	private $siparisdetay_yorum;
	private $siparisdetay_onayzaman;
	private $iade_et;
	private $islem_kullanici_id;
	
	function __construct($siparisdetay_id,$siparis_id,$kullanici_id,$kullanici_idsatici,$urun_id,$urun_fiyat,$urun_adet,$siparisdetay_kargozaman,$siparisdetay_kargoad,$siparis_kargodurum,$siparisdetay_kargono,$siparis_kargoucret,$siparisdetay_onay,$siparisdetay_yorum,$siparisdetay_onayzaman,$iade_et,$islem_kullanici_id,$siparis_zaman,$siparis_odeme)
	{
		// code...
		$this->siparisdetay_id = $siparisdetay_id;
		$this->siparis_id = $siparis_id;
		$this->kullanici_id = $kullanici_id;
		$this->kullanici_idsatici = $kullanici_idsatici;
		$this->urun_id = $urun_id;
		$this->urun_fiyat = $urun_fiyat;
		$this->urun_adet = $urun_adet;
		$this->siparisdetay_kargozaman = $siparisdetay_kargozaman;
		$this->siparisdetay_kargoad = $siparisdetay_kargoad;
		$this->siparis_kargodurum = $siparis_kargodurum;
		$this->siparisdetay_kargono = $siparisdetay_kargono;
		$this->siparis_kargoucret = $siparis_kargoucret;
		$this->siparisdetay_onay = $siparisdetay_onay;
		$this->siparisdetay_yorum = $siparisdetay_yorum;
		$this->siparisdetay_onayzaman = $siparisdetay_onayzaman;
		$this->iade_et = $iade_et;
		$this->islem_kullanici_id = $islem_kullanici_id;
		$this->siparis_zaman = $siparis_zaman;
		$this->siparis_odeme = $siparis_odeme;
	}

	public function set_siparisdetay_id($siparisdetay_id) {
		$this->siparisdetay_id = $siparisdetay_id;
	}

	public function get_siparisdetay_id() {
		return $this->siparisdetay_id;
	}

	public function set_siparis_id($siparis_id) {
		$this->siparis_id = $siparis_id;
	}

	public function get_siparis_id() {
		return $this->siparis_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_kullanici_idsatici($kullanici_idsatici) {
		$this->kullanici_idsatici = $kullanici_idsatici;
	}

	public function get_kullanici_idsatici() {
		return $this->kullanici_idsatici;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_urun_fiyat($urun_fiyat) {
		$this->urun_fiyat = $urun_fiyat;
	}

	public function get_urun_fiyat() {
		return $this->urun_fiyat;
	}

	public function set_urun_adet($urun_adet) {
		$this->urun_adet = $urun_adet;
	}

	public function get_urun_adet() {
		return $this->urun_adet;
	}

	public function set_siparisdetay_kargozaman($siparisdetay_kargozaman) {
		$this->siparisdetay_kargozaman = $siparisdetay_kargozaman;
	}

	public function get_siparisdetay_kargozaman() {
		return $this->siparisdetay_kargozaman;
	}

	public function set_siparisdetay_kargoad($siparisdetay_kargoad) {
		$this->siparisdetay_kargoad = $siparisdetay_kargoad;
	}

	public function get_siparisdetay_kargoad() {
		return $this->siparisdetay_kargoad;
	}

	public function set_siparis_kargodurum($siparis_kargodurum) {
		$this->siparis_kargodurum = $siparis_kargodurum;
	}

	public function get_siparis_kargodurum() {
		return $this->siparis_kargodurum;
	}

	public function set_siparisdetay_kargono($siparisdetay_kargono) {
		$this->siparisdetay_kargono = $siparisdetay_kargono;
	}

	public function get_siparisdetay_kargono() {
		return $this->siparisdetay_kargono;
	}

	public function set_siparis_kargoucret($siparis_kargoucret) {
		$this->siparis_kargoucret = $siparis_kargoucret;
	}

	public function get_siparis_kargoucret() {
		return $this->siparis_kargoucret;
	}

	public function set_siparisdetay_onay($siparisdetay_onay) {
		$this->siparisdetay_onay = $siparisdetay_onay;
	}

	public function get_siparisdetay_onay() {
		return $this->siparisdetay_onay;
	}

	public function set_siparisdetay_yorum($siparisdetay_yorum) {
		$this->siparisdetay_yorum = $siparisdetay_yorum;
	}

	public function get_siparisdetay_yorum() {
		return $this->siparisdetay_yorum;
	}

	public function set_siparisdetay_onayzaman($siparisdetay_onayzaman) {
		$this->siparisdetay_onayzaman = $siparisdetay_onayzaman;
	}

	public function get_siparisdetay_onayzaman() {
		return $this->siparisdetay_onayzaman;
	}

	public function set_iade_et($iade_et) {
		$this->iade_et = $iade_et;
	}

	public function get_iade_et() {
		return $this->iade_et;
	}

	public function set_islem_kullanici_id($islem_kullanici_id) {
		$this->islem_kullanici_id = $islem_kullanici_id;
	}

	public function get_islem_kullanici_id() {
		return $this->islem_kullanici_id;
	}

	public function set_siparis_zaman($siparis_zaman) {
		$this->siparis_zaman = $siparis_zaman;
	}

	public function get_siparis_zaman() {
		return $this->siparis_zaman;
	}

	public function set_siparis_odeme($siparis_odeme) {
		$this->siparis_odeme = $siparis_odeme;
	}

	public function get_siparis_odeme() {
		return $this->siparis_odeme;
	}


}
?>