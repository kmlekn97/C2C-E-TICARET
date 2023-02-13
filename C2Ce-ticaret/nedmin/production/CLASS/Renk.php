<?php
/**
 * 
 */
class Renk
{
	private $renk_id;
	private $renk_adi;
	private $renk_kodu;
	private $kullanici_id;
	
	function __construct($renk_id,$renk_adi,$renk_kodu,$kullanici_id)
	{
		// code...
		$this->renk_id = $renk_id;
		$this->renk_adi = $renk_adi;
		$this->renk_kodu = $renk_kodu;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_renk_id($renk_id) {
		$this->renk_id = $renk_id;
	}

	public function get_renk_id() {
		return $this->renk_id;
	}

	public function set_renk_adi($renk_adi) {
		$this->renk_adi = $renk_adi;
	}

	public function get_renk_adi() {
		return $this->renk_adi;
	}

	public function set_renk_kodu($renk_kodu) {
		$this->renk_kodu = $renk_kodu;
	}

	public function get_renk_kodu() {
		return $this->renk_kodu;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>