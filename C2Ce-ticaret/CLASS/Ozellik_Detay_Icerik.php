<?php
/**
 * 
 */
class Ozellik_Detay_Icerik
{

	private $ozellik_detay_icerik_id;
	private $ozellik_detay_id;
	private $urun_id;
	private $kullanici_id;
	
	function __construct($ozellik_detay_icerik_id,$ozellik_detay_id,$urun_id,$kullanici_id)
	{
		// code...
		$this->ozellik_detay_icerik_id = $ozellik_detay_icerik_id;
		$this->ozellik_detay_id = $ozellik_detay_id;
		$this->urun_id = $urun_id;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_ozellik_detay_icerik_id($ozellik_detay_icerik_id) {
		$this->ozellik_detay_icerik_id = $ozellik_detay_icerik_id;
	}

	public function get_ozellik_detay_icerik_id() {
		return $this->ozellik_detay_icerik_id;
	}

	public function set_ozellik_detay_id($ozellik_detay_id) {
		$this->ozellik_detay_id = $ozellik_detay_id;
	}

	public function get_ozellik_detay_id() {
		return $this->ozellik_detay_id;
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