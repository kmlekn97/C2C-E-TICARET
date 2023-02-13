<?php
/**
 * 
 */
class Kullanici
{
	private $kullanici_id;
	private $subMerchantKey;
	private $kullanici_magaza;
	private $magaza_adi;
	private $kullanici_magazafoto;
	private $kullanici_zaman;
	private $kullanici_sonzaman;
	private $kullanici_sonip;
	private $kullanici_resim;
	private $kullanici_tc;
	private $kullanici_banka;
	private $kullanici_iban;
	private $kullanici_ad;
	private $kullanici_soyad;
	private $kullanici_mail;
	private $kullanici_gsm;
	private $kullanici_password;
	private $kullanici_adres;
	private $kullanici_il;
	private $kullanici_ilce;
	private $kullanici_unvan;
	private $kullanici_tip;
	private $kullanici_vdaire;
	private $kullanici_vno;
	private $misafir_no;
	private $kullanici_yetki;
	private $kullanici_durum;
	
	function __construct($kullanici_id,$subMerchantKey,$kullanici_magaza,$magaza_adi,$kullanici_magazafoto,$kullanici_zaman,$kullanici_sonzaman,$kullanici_sonip,$kullanici_resim,$kullanici_tc,$kullanici_banka,$kullanici_iban,$kullanici_ad,$kullanici_soyad,$kullanici_mail,$kullanici_gsm,$kullanici_password,$kullanici_adres,$kullanici_il,$kullanici_ilce,$kullanici_unvan,$kullanici_tip,$kullanici_vdaire,$kullanici_vno,$misafir_no,$kullanici_yetki,$kullanici_durum)
	{
		// code...
		$this->kullanici_id = $kullanici_id;
		$this->subMerchantKey = $subMerchantKey;
		$this->kullanici_magaza = $kullanici_magaza;
		$this->magaza_adi = $magaza_adi;
		$this->kullanici_magazafoto = $kullanici_magazafoto;
		$this->kullanici_zaman = $kullanici_zaman;
		$this->kullanici_sonzaman = $kullanici_sonzaman;
		$this->kullanici_sonip = $kullanici_sonip;
		$this->kullanici_resim = $kullanici_resim;
		$this->kullanici_tc = $kullanici_tc;
		$this->kullanici_banka = $kullanici_banka;
		$this->kullanici_iban = $kullanici_iban;
		$this->kullanici_ad = $kullanici_ad;
		$this->kullanici_soyad = $kullanici_soyad;
		$this->kullanici_mail = $kullanici_mail;
		$this->kullanici_gsm = $kullanici_gsm;
		$this->kullanici_password = $kullanici_password;
		$this->kullanici_adres = $kullanici_adres;
		$this->kullanici_il = $kullanici_il;
		$this->kullanici_ilce = $kullanici_ilce;
		$this->kullanici_unvan = $kullanici_unvan;
		$this->kullanici_tip = $kullanici_tip;
		$this->kullanici_vdaire = $kullanici_vdaire;
		$this->kullanici_vno = $kullanici_vno;
		$this->misafir_no = $misafir_no;
		$this->kullanici_yetki = $kullanici_yetki;
		$this->kullanici_durum = $kullanici_durum;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_subMerchantKey($subMerchantKey) {
		$this->subMerchantKey = $subMerchantKey;
	}

	public function get_subMerchantKey() {
		return $this->subMerchantKey;
	}

	public function set_kullanici_magaza($kullanici_magaza) {
		$this->kullanici_magaza = $kullanici_magaza;
	}

	public function get_kullanici_magaza() {
		return $this->kullanici_magaza;
	}

	public function set_magaza_adi($magaza_adi) {
		$this->magaza_adi = $magaza_adi;
	}

	public function get_magaza_adi() {
		return $this->magaza_adi;
	}

	public function set_kullanici_magazafoto($kullanici_magazafoto) {
		$this->kullanici_magazafoto = $kullanici_magazafoto;
	}

	public function get_kullanici_magazafoto() {
		return $this->kullanici_magazafoto;
	}

	public function set_kullanici_zaman($kullanici_zaman) {
		$this->kullanici_zaman = $kullanici_zaman;
	}

	public function get_kullanici_zaman() {
		return $this->kullanici_zaman;
	}

	public function set_kullanici_sonzaman($kullanici_sonzaman) {
		$this->kullanici_sonzaman = $kullanici_sonzaman;
	}

	public function get_kullanici_sonzaman() {
		return $this->kullanici_sonzaman;
	}

	public function set_kullanici_sonip($kullanici_sonip) {
		$this->kullanici_sonip = $kullanici_sonip;
	}

	public function get_kullanici_sonip() {
		return $this->kullanici_sonzaman;
	}

	public function set_kullanici_resim($kullanici_resim) {
		$this->kullanici_resim = $kullanici_resim;
	}

	public function get_kullanici_resim() {
		return $this->kullanici_resim;
	}

	public function set_kullanici_tc($kullanici_tc) {
		$this->kullanici_tc = $kullanici_tc;
	}

	public function get_kullanici_tc() {
		return $this->kullanici_tc;
	}

	public function set_kullanici_banka($kullanici_banka) {
		$this->kullanici_banka = $kullanici_banka;
	}

	public function get_kullanici_banka() {
		return $this->kullanici_banka;
	}

	public function set_kullanici_iban($kullanici_iban) {
		$this->kullanici_iban = $kullanici_iban;
	}

	public function get_kullanici_iban() {
		return $this->kullanici_iban;
	}

	public function set_kullanici_ad($kullanici_ad) {
		$this->kullanici_ad = $kullanici_ad;
	}

	public function get_kullanici_ad() {
		return $this->kullanici_ad;
	}

	public function set_kullanici_soyad($kullanici_soyad) {
		$this->kullanici_soyad = $kullanici_soyad;
	}

	public function get_kullanici_soyad() {
		return $this->kullanici_soyad;
	}

	public function set_kullanici_mail($kullanici_mail) {
		$this->kullanici_mail = $kullanici_mail;
	}

	public function get_kullanici_mail() {
		return $this->kullanici_mail;
	}

	public function set_kullanici_gsm($kullanici_gsm) {
		$this->kullanici_gsm = $kullanici_gsm;
	}

	public function get_kullanici_gsm() {
		return $this->kullanici_gsm;
	}

	public function set_kullanici_password($kullanici_password) {
		$this->kullanici_password = $kullanici_password;
	}

	public function get_kullanici_password() {
		return $this->kullanici_password;
	}

	public function set_kullanici_adres($kullanici_adres) {
		$this->kullanici_adres = $kullanici_adres;
	}

	public function get_kullanici_adres() {
		return $this->kullanici_adres;
	}

	public function set_kullanici_il($kullanici_il) {
		$this->kullanici_il = $kullanici_il;
	}

	public function get_kullanici_il() {
		return $this->kullanici_il;
	}

	public function set_kullanici_ilce($kullanici_ilce) {
		$this->kullanici_ilce = $kullanici_ilce;
	}

	public function get_kullanici_ilce() {
		return $this->kullanici_ilce;
	}

	public function set_kullanici_unvan($kullanici_unvan) {
		$this->kullanici_unvan = $kullanici_unvan;
	}

	public function get_kullanici_unvan() {
		return $this->kullanici_unvan;
	}

	public function set_kullanici_tip($kullanici_tip) {
		$this->kullanici_tip = $kullanici_tip;
	}

	public function get_kullanici_tip() {
		return $this->kullanici_tip;
	}

	public function set_kullanici_vdaire($kullanici_vdaire) {
		$this->kullanici_vdaire = $kullanici_vdaire;
	}

	public function get_kullanici_vdaire() {
		return $this->kullanici_vdaire;
	}

	public function set_kullanici_vno($kullanici_vno) {
		$this->kullanici_vno = $kullanici_vno;
	}

	public function get_kullanici_vno() {
		return $this->kullanici_vno;
	}

	public function set_misafir_no($misafir_no) {
		$this->misafir_no = $misafir_no;
	}

	public function get_misafir_no() {
		return $this->misafir_no;
	}

	public function set_kullanici_yetki($kullanici_yetki) {
		$this->kullanici_yetki = $kullanici_yetki;
	}

	public function get_kullanici_yetki() {
		return $this->kullanici_yetki;
	}

	public function set_kullanici_durum($kullanici_durum) {
		$this->kullanici_durum = $kullanici_durum;
	}

	public function get_kullanici_durum() {
		return $this->kullanici_durum;
	}
}
?>