<?php
/**
 * 
 */
class Hakkimizda
{

	private $hakkimizda_id;
	private $hakkimizda_baslik;
	private $hakkimizda_icerik;
	private $hakkimizda_video;
	private $hakkimizda_vizyon;
	private $hakkimizda_misyon;
	private $kullanici_id;
	
	function __construct($hakkimizda_id,$hakkimizda_baslik,$hakkimizda_icerik,$hakkimizda_video,$hakkimizda_vizyon,$hakkimizda_misyon,$kullanici_id)
	{
		// code...
		$this->hakkimizda_id = $hakkimizda_id;
		$this->hakkimizda_baslik = $hakkimizda_baslik;
		$this->hakkimizda_icerik = $hakkimizda_icerik;
		$this->hakkimizda_video = $hakkimizda_video;
		$this->hakkimizda_vizyon = $hakkimizda_vizyon;
		$this->hakkimizda_misyon = $hakkimizda_misyon;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_hakkimizda_id($hakkimizda_id) {
		$this->hakkimizda_id = $hakkimizda_id;
	}

	public function get_hakkimizda_id() {
		return $this->hakkimizda_id;
	}

	public function set_hakkimizda_baslik($hakkimizda_baslik) {
		$this->hakkimizda_baslik = $hakkimizda_baslik;
	}

	public function get_hakkimizda_baslik() {
		return $this->hakkimizda_baslik;
	}

	public function set_hakkimizda_icerik($hakkimizda_icerik) {
		$this->hakkimizda_icerik = $hakkimizda_icerik;
	}

	public function get_hakkimizda_icerik() {
		return $this->hakkimizda_icerik;
	}

	public function set_hakkimizda_video($hakkimizda_video) {
		$this->hakkimizda_video = $hakkimizda_video;
	}

	public function get_hakkimizda_video() {
		return $this->hakkimizda_video;
	}

	public function set_hakkimizda_vizyon($hakkimizda_vizyon) {
		$this->hakkimizda_vizyon = $hakkimizda_vizyon;
	}

	public function get_hakkimizda_vizyon() {
		return $this->hakkimizda_vizyon;
	}

	public function set_hakkimizda_misyon($hakkimizda_misyon) {
		$this->hakkimizda_misyon = $hakkimizda_misyon;
	}

	public function get_hakkimizda_misyon() {
		return $this->hakkimizda_misyon;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>