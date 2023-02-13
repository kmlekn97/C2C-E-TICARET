<?php
/**
 * 
 */
class Siparis
{
	private $siparis_id;
	private $siparis_zaman;
	private $kullanici_id;
	private $kullanici_idsatici;
	private $siparis_odeme;
	
	function __construct($siparis_id,$siparis_zaman,$kullanici_id,$kullanici_idsatici,$siparis_odeme)
	{
		// code...
		$this->siparis_id = $siparis_id;
		$this->siparis_zaman = $siparis_zaman;
		$this->kullanici_id = $kullanici_id;
		$this->kullanici_idsatici = $kullanici_idsatici;
		$this->siparis_odeme = $siparis_odeme;
	}

	public function set_siparis_id($siparis_id) {
		$this->siparis_id = $siparis_id;
	}

	public function get_siparis_id() {
		return $this->siparis_id;
	}

	public function set_siparis_zaman($siparis_zaman) {
		$this->siparis_zaman = $siparis_zaman;
	}

	public function get_siparis_zaman() {
		return $this->siparis_zaman;
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

	public function set_siparis_odeme($siparis_odeme) {
		$this->siparis_odeme = $siparis_odeme;
	}

	public function get_siparis_odeme() {
		return $this->siparis_odeme;
	}
}
?>