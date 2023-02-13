<?php
/**
 * 
 */
class Yetkiler
{

	private $yetki_id;
	private $kullanici_id;
	private $yetki_adi;
	private $yetki_tarih;
	private $vkullanici_id;
	
	function __construct($yetki_id,$kullanici_id,$yetki_adi,$yetki_tarih,$vkullanici_id)
	{
		// code...
		$this->yetki_id = $yetki_id;
		$this->kullanici_id = $kullanici_id;
		$this->yetki_adi = $yetki_adi;
		$this->yetki_tarih = $yetki_tarih;
		$this->vkullanici_id = $vkullanici_id;
	}

	public function set_yetki_id($yetki_id) {
		$this->yetki_id = $yetki_id;
	}

	public function get_yetki_id() {
		return $this->yetki_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_yetki_adi($yetki_adi) {
		$this->yetki_adi = $yetki_adi;
	}

	public function get_yetki_adi() {
		return $this->yetki_adi;
	}

	public function set_yetki_tarih($yetki_tarih) {
		$this->yetki_tarih = $yetki_tarih;
	}

	public function get_yetki_tarih() {
		return $this->yetki_tarih;
	}

	public function set_vkullanici_id($vkullanici_id) {
		$this->vkullanici_id = $vkullanici_id;
	}

	public function get_vkullanici_id() {
		return $this->vkullanici_id;
	}
}
?>