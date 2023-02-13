<?php
require_once 'CLASS/Alt_kategori.php';
class Alt_kategori_detay extends Alt_kategori
{
	private $alt_kategori_detay_id;
	private $alt_kategori_detay_ad;
	private $alt_kategori_detay_sira;
	private $alt_kategori_detay_durum;
	private $alt_kategori_detay_seourl;

	
	function __construct($alt_kategori_detay_id,$alt_kategori_detay_ad,$alt_kategori_detay_sira,$alt_kategori_detay_durum,$alt_kategori_detay_seourl,$alt_kategori_id,$alt_kategori_ad,$alt_kategori_sira,$alt_kategori_durum,$alt_kategori_seourl,$kategori_id,$kullanici_id)
	{
		// code...
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->alt_kategori_detay_ad = $alt_kategori_detay_ad;
		$this->alt_kategori_detay_sira = $alt_kategori_detay_sira;
		$this->alt_kategori_detay_durum = $alt_kategori_detay_durum;
		$this->alt_kategori_detay_seourl = $alt_kategori_detay_seourl;
		$this->alt_kategori_id = $alt_kategori_id;
		$this->alt_kategori_ad = $alt_kategori_ad;
		$this->alt_kategori_sira = $alt_kategori_sira;
		$this->alt_kategori_durum = $alt_kategori_durum;
		$this->alt_kategori_seourl = $alt_kategori_seourl;
		$this->kategori_id = $kategori_id;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_alt_kategori_detay_id($alt_kategori_detay_id) {
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
	}

	public function get_alt_kategori_detay_id() {
		return $this->alt_kategori_detay_id;
	}

	public function set_alt_kategori_detay_ad($alt_kategori_detay_ad) {
		$this->alt_kategori_detay_ad = $alt_kategori_detay_ad;
	}

	public function get_alt_kategori_detay_ad() {
		return $this->alt_kategori_detay_ad;
	}

	public function set_alt_kategori_detay_sira($alt_kategori_detay_sira) {
		$this->alt_kategori_detay_sira = $alt_kategori_detay_sira;
	}

	public function get_alt_kategori_detay_sira() {
		return $this->alt_kategori_detay_sira;
	}

	public function set_alt_kategori_detay_durum($alt_kategori_detay_durum) {
		$this->alt_kategori_detay_durum = $alt_kategori_detay_durum;
	}

	public function get_alt_kategori_detay_durum() {
		return $this->alt_kategori_detay_durum;
	}

	public function set_alt_kategori_detay_seourl($alt_kategori_detay_seourl) {
		$this->alt_kategori_detay_seourl = $alt_kategori_detay_seourl;
	}

	public function get_alt_kategori_detay_seourl() {
		return $this->alt_kategori_detay_seourl;
	}

		public function set_alt_kategori_id($alt_kategori_id) {
		$this->alt_kategori_id = $alt_kategori_id;
	}

	public function get_alt_kategori_id() {
		return $this->alt_kategori_id;
	}

	public function set_alt_kategori_ad($alt_kategori_ad) {
		$this->alt_kategori_ad = $alt_kategori_ad;
	}

	public function get_alt_kategori_ad() {
		return $this->alt_kategori_ad;
	}

	public function set_alt_kategori_sira($alt_kategori_sira) {
		$this->alt_kategori_sira = $alt_kategori_sira;
	}

	public function get_alt_kategori_sira() {
		return $this->alt_kategori_sira;
	}

	public function set_alt_kategori_durum($alt_kategori_durum) {
		$this->alt_kategori_durum = $alt_kategori_durum;
	}

	public function get_alt_kategori_durum() {
		return $this->alt_kategori_durum;
	}

	public function set_alt_kategori_seourl($alt_kategori_seourl) {
		$this->alt_kategori_seourl = $alt_kategori_seourl;
	}

	public function get_alt_kategori_seourl() {
		return $this->alt_kategori_seourl;
	}

	public function set_kategori_id($kategori_id) {
		$this->kategori_id = $kategori_id;
	}

	public function get_kategori_id() {
		return $this->kategori_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_Altkategori(Alt_kategori $alt_kategori) {
		$this->alt_kategori = $alt_kategori;
	}

	public function get_Altkategori() {
		return $this->alt_kategori;
	}
}
?>