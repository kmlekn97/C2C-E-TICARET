<?php
/**
 * 
 */
class Kampanya_Detaylarim
{
	
	private $kampanya_detay_id;
	private $kampanya_id;
	private $urun_id;
	private $durum;
	private $kullanici_id;

	function __construct($kampanya_detay_id,$kampanya_id,$urun_id,$durum,$kullanici_id)
	{
		// code...
		$this->kampanya_detay_id = $kampanya_detay_id;
		$this->kampanya_id = $kampanya_id;
		$this->urun_id = $urun_id;
		$this->durum = $durum;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_kampanya_detay_id($kampanya_detay_id) {
		$this->kampanya_detay_id = $kampanya_detay_id;
	}

	public function get_kampanya_detay_id() {
		return $this->kampanya_detay_id;
	}

	public function set_kampanya_id($kampanya_id) {
		$this->kampanya_id = $kampanya_id;
	}

	public function get_kampanya_id() {
		return $this->kampanya_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_durum($durum) {
		$this->durum = $durum;
	}

	public function get_durum() {
		return $this->durum;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>