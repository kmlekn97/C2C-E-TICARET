<?php
/**
 * 
 */
require_once 'CLASS/Kategori.php';
class Alt_kategori extends Kategori
{
	private $alt_kategori_id;
	private $alt_kategori_ad;
	private $alt_kategori_sira;
	private $alt_kategori_durum;
	private $alt_kategori_seourl;
	private $kategori_id;
	private $kullanici_id;

	
	function __construct($alt_kategori_id,$alt_kategori_ad,$alt_kategori_sira,$alt_kategori_durum,$alt_kategori_seourl,$kategori_id,$kullanici_id,$kategori_ad,$kategori_oran,$kategori_onecikar,$kategori_seourl,$kategori_sira,$kategori_durum)
	{
		// code...
		$this->alt_kategori_id = $alt_kategori_id;
		$this->alt_kategori_ad = $alt_kategori_ad;
		$this->alt_kategori_sira = $alt_kategori_sira;
		$this->alt_kategori_durum = $alt_kategori_durum;
		$this->alt_kategori_seourl = $alt_kategori_seourl;
		$this->kategori_id = $kategori_id;
		$this->kullanici_id = $kullanici_id;
		$this->kategori_ad = $kategori_ad;
		$this->kategori_oran = $kategori_oran;
		$this->kategori_onecikar = $kategori_onecikar;
		$this->kategori_seourl = $kategori_seourl;
		$this->kategori_sira = $kategori_sira;
		$this->kategori_durum = $kategori_durum;
		$this->kullanici_id = $kullanici_id;

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

	public function set_Kategori(Kategori $kategori) {
		$this->kategori = $kategori;
	}

	public function get_kategori() {
		return $this->kategori;
	}
}

?>