<?php
/**
  * 
  */
class Beden
{

	private $beden_id;
	private $kategori_id;
	private $alt_kategori_id;
	private $beden_icerik;
	private $alt_kategori_detay_id;
	private $kullanici_id;

	function __construct($beden_id,$kategori_id,$alt_kategori_id,$beden_icerik,$alt_kategori_detay_id,$kullanici_id)
	{
 		// code...
		$this->beden_id = $beden_id;
		$this->kategori_id = $kategori_id;
		$this->alt_kategori_id = $alt_kategori_id;
		$this->beden_icerik = $beden_icerik;
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_beden_id($beden_id) {
		$this->beden_id = $beden_id;
	}

	public function get_beden_id() {
		return $this->beden_id;
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

	public function set_beden_icerik($beden_icerik) {
		$this->beden_icerik = $beden_icerik;
	}

	public function get_beden_icerik() {
		return $this->beden_icerik;
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
} 
?>