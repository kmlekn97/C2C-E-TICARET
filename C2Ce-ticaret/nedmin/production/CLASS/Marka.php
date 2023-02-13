<?php
/**
 * 
 */
class Marka
{
	private $marka_id;
	private $marka_adi;
	private $kategori_id;
	private $alt_kategori_id;
	private $alt_kategori_detay_id;
	private $kullanici_id;
	private $marka_durum;

	function __construct($marka_id,$marka_adi,$kategori_id,$alt_kategori_id,$alt_kategori_detay_id,$kullanici_id,$marka_durum)
	{
		// code...
		$this->marka_id = $marka_id;
		$this->marka_adi = $marka_adi;
		$this->kategori_id = $kategori_id;
		$this->alt_kategori_id = $alt_kategori_id;
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->kullanici_id = $kullanici_id;
		$this->marka_durum = $marka_durum;
	}

	public function set_marka_id($marka_id) {
		$this->marka_id = $marka_id;
	}

	public function get_marka_id() {
		return $this->marka_id;
	}

	public function set_marka_adi($marka_adi) {
		$this->marka_adi = $marka_adi;
	}

	public function get_marka_adi() {
		return $this->marka_adi;
	}

	public function set_kategori_id($kategori_id) {
		$this->kategori_id = $kategori_id;
	}

	public function get_kategori_id() {
		return $this->kategori_id;
	}

	public function set_alt_kategori_id($alt_kategori_id) {
		$this->alt_kategori_id = $alt_kategori_id;
	}

	public function get_alt_kategori_id() {
		return $this->alt_kategori_id;
	}

	public function set_alt_kategori_detay_id($alt_kategori_detay_id) {
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
	}

	public function get_alt_kategori_detay_id() {
		return $this->alt_kategori_detay_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_marka_durum($marka_durum) {
		$this->marka_durum = $marka_durum;
	}

	public function get_marka_durum() {
		return $this->marka_durum;
	}
}
?>