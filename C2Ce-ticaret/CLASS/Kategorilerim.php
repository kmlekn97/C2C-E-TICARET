<?php
class Kategorilerim
{
	private $kategori_id;
	private $kategori_ad;
	private $kategori_oran;
	private $kategori_onecikar;
	private $kategori_seourl;
	private $kategori_sira;
	private $kategori_durum;
	private $kullanici_id;

	
	function __construct($kategori_id,$kategori_ad,$kategori_oran,$kategori_onecikar,$kategori_seourl,$kategori_sira,$kategori_durum,$kullanici_id)
	{
		// code...
		$this->kategori_id = $kategori_id;
		$this->kategori_ad = $kategori_ad;
		$this->kategori_oran = $kategori_oran;
		$this->kategori_onecikar = $kategori_onecikar;
		$this->kategori_seourl = $kategori_seourl;
		$this->kategori_sira = $kategori_sira;
		$this->kategori_durum = $kategori_durum;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_kategori_id($kategori_id) {
		$this->kategori_id = $kategori_id;
	}

	public function get_kategori_id() {
		return $this->kategori_id;
	}

	public function set_kategori_ad($kategori_ad) {
		$this->kategori_ad = $kategori_ad;
	}

	public function get_kategori_ad() {
		return $this->kategori_ad;
	}

	public function set_kategori_oran($kategori_oran) {
		$this->kategori_oran = $kategori_oran;
	}

	public function get_kategori_oran() {
		return $this->kategori_oran;
	}

	public function set_kategori_onecikar($kategori_onecikar) {
		$this->kategori_onecikar = $kategori_onecikar;
	}

	public function get_kategori_onecikar() {
		return $this->kategori_onecikar;
	}

	public function set_kategori_seourl($kategori_seourl) {
		$this->kategori_seourl = $kategori_seourl;
	}

	public function get_kategori_seourl() {
		return $this->kategori_seourl;
	}

	public function set_kategori_sira($kategori_sira) {
		$this->kategori_sira = $kategori_sira;
	}

	public function get_kategori_sira() {
		return $this->kategori_sira;
	}

	public function set_kategori_durum($kategori_durum) {
		$this->kategori_durum = $kategori_durum;
	}

	public function get_kategori_durum() {
		return $this->kategori_durum;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>