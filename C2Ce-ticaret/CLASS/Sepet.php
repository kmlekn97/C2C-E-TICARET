<?php
/**
 * 
 */
class Sepet
{
	
	private $sepet_id;
	private $kullanici_id;
	private $urun_id;
	private $urun_adet;

	function __construct($sepet_id,$kullanici_id,$urun_id,$urun_adet)
	{
		$this->sepet_id = $sepet_id;
		$this->kullanici_id = $kullanici_id;
		$this->urun_id = $urun_id;
		$this->urun_adet = $urun_adet;
	}

	public function set_sepet_id($sepet_id) {
		$this->sepet_id = $sepet_id;
	}

	public function get_sepet_id() {
		return $this->sepet_id;
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

	public function set_urun_adet($urun_adet) {
		$this->urun_adet = $urun_adet;
	}

	public function get_urun_adet() {
		return $this->urun_adet;
	}
}

?>