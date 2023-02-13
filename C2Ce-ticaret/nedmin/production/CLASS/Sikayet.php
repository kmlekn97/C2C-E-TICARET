<?php
/**
 * 
 */
class Sikayet
{
	private $sikayet_id;
	private $sikayet_zaman;
	private $sikayet_nedeni;
	private $kullanici_id;
	private $kullanici_idsatici;

	function __construct($sikayet_id,$sikayet_zaman,$sikayet_nedeni,$kullanici_id,$kullanici_idsatici)
	{
		// code...
		$this->sikayet_id = $sikayet_id;
		$this->sikayet_zaman = $sikayet_zaman;
		$this->sikayet_nedeni = $sikayet_nedeni;
		$this->kullanici_id = $kullanici_id;
		$this->kullanici_idsatici = $kullanici_idsatici;
	}

	public function set_sikayet_id($sikayet_id) {
		$this->sikayet_id = $sikayet_id;
	}

	public function get_sikayet_id() {
		return $this->sikayet_id;
	}

	public function set_sikayet_zaman($sikayet_zaman) {
		$this->sikayet_zaman = $sikayet_zaman;
	}

	public function get_sikayet_zaman() {
		return $this->sikayet_zaman;
	}

	public function set_sikayet_nedeni($sikayet_nedeni) {
		$this->sikayet_nedeni = $sikayet_nedeni;
	}

	public function get_sikayet_nedeni() {
		return $this->sikayet_nedeni;
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

}
?>