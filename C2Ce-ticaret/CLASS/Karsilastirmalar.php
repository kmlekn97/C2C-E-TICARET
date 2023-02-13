<?php
/**
 * 
 */
class Karsilastirmalar
{

	private $karsilastir_id;
	private $urun_id;
	private $kullanici_id;
	
	function __construct($karsilastir_id,$urun_id,$kullanici_id)
	{
		// code...
		$this->karsilastir_id = $karsilastir_id;
		$this->urun_id = $urun_id;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_karsilastir_id($karsilastir_id) {
		$this->karsilastir_id = $karsilastir_id;
	}

	public function get_karsilastir_id() {
		return $this->karsilastir_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>