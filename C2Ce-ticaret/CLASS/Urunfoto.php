<?php
/**
 * 
 */
class Urunfoto
{

	private $urunfoto_id;
	private $urun_id;
	private $urunfoto_resimyol;
	private $kullanici_id;
	
	function __construct($urunfoto_id,$urun_id,$urunfoto_resimyol,$kullanici_id)
	{
		// code...
		$this->urunfoto_id = $urunfoto_id;
		$this->urun_id = $urun_id;
		$this->urunfoto_resimyol = $urunfoto_resimyol;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_urunfoto_id($urunfoto_id) {
		$this->urunfoto_id = $urunfoto_id;
	}

	public function get_urunfoto_id() {
		return $this->urunfoto_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_urunfoto_resimyol($urunfoto_resimyol) {
		$this->urunfoto_resimyol = $urunfoto_resimyol;
	}

	public function get_urunfoto_resimyol() {
		return $this->urunfoto_resimyol;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>