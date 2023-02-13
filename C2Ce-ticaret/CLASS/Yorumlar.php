<?php
/**
 * 
 */
class Yorumlar
{

	private $yorum_id;
	private $kullanici_id;
	private $urun_id;
	private $yorum_detay;
	private $yorum_puan;
	private $yorum_zaman;
	private $yorum_onay;
	private $yorum_analys;
	
	function __construct($yorum_id,$kullanici_id,$urun_id,$yorum_detay,$yorum_puan,$yorum_zaman,$yorum_onay,$yorum_analys)
	{
		// code...
		$this->yorum_id = $yorum_id;
		$this->kullanici_id = $kullanici_id;
		$this->urun_id = $urun_id;
		$this->yorum_detay = $yorum_detay;
		$this->yorum_puan = $yorum_puan;
		$this->yorum_zaman = $yorum_zaman;
		$this->yorum_onay = $yorum_onay;
		$this->yorum_analys = $yorum_analys;
	}

	public function set_yorum_id($yorum_id) {
		$this->yorum_id = $yorum_id;
	}

	public function get_yorum_id() {
		return $this->yorum_id;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_yorum_detay($yorum_detay) {
		$this->yorum_detay = $yorum_detay;
	}

	public function get_yorum_detay() {
		return $this->yorum_detay;
	}

	public function set_yorum_puan($yorum_puan) {
		$this->yorum_puan = $yorum_puan;
	}

	public function get_yorum_puan() {
		return $this->yorum_puan;
	}

	public function set_yorum_zaman($yorum_zaman) {
		$this->yorum_zaman = $yorum_zaman;
	}

	public function get_yorum_zaman() {
		return $this->yorum_zaman;
	}

	
	public function set_yorum_onay($yorum_onay) {
		$this->yorum_onay = $yorum_onay;
	}

	public function get_yorum_onay() {
		return $this->yorum_onay;
	}

	public function set_yorum_analys($yorum_analys) {
		$this->yorum_analys = $yorum_analys;
	}

	public function get_yorum_analys() {
		return $this->yorum_analys;
	}

}
?>