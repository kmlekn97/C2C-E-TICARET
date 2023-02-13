<?php
/**
 * 
 */
class Slider
{
	private $slider_id;
	private $slider_ad;
	private $slider_resimyol;
	private $slider_sira;
	private $slider_link;
	private $slider_sure;
	private $slider_zaman;
	private $slider_fiyat;
	private $slider_durum;
	private $kullanici_id;


	function __construct($slider_id,$slider_ad,$slider_resimyol,$slider_sira,$slider_link,$slider_sure,$slider_zaman,$slider_fiyat,$slider_durum,$kullanici_id)
	{
		// code...
		$this->slider_id = $slider_id;
		$this->slider_ad = $slider_ad;
		$this->slider_resimyol = $slider_resimyol;
		$this->slider_sira = $slider_sira;
		$this->slider_link = $slider_link;
		$this->slider_sure = $slider_sure;
		$this->slider_zaman = $slider_zaman;
		$this->slider_fiyat = $slider_fiyat;
		$this->slider_durum = $slider_durum;
		$this->kullanici_id = $kullanici_id;
	}

	public function set_slider_id($slider_id) {
		$this->slider_id = $slider_id;
	}

	public function get_slider_id() {
		return $this->slider_id;
	}

	public function set_slider_ad($slider_ad) {
		$this->slider_ad = $slider_ad;
	}

	public function get_slider_ad() {
		return $this->slider_ad;
	}

	public function set_slider_resimyol($slider_resimyol) {
		$this->slider_resimyol = $slider_resimyol;
	}

	public function get_slider_resimyol() {
		return $this->slider_resimyol;
	}

	public function set_slider_sira($slider_sira) {
		$this->slider_sira = $slider_sira;
	}

	public function get_slider_sira() {
		return $this->slider_sira;
	}

	public function set_slider_link($slider_link) {
		$this->slider_link = $slider_link;
	}

	public function get_slider_link() {
		return $this->slider_link;
	}

	public function set_slider_sure($slider_sure) {
		$this->slider_sure = $slider_sure;
	}

	public function get_slider_sure() {
		return $this->slider_sure;
	}

	public function set_slider_zaman($slider_zaman) {
		$this->slider_zaman = $slider_zaman;
	}

	public function get_slider_zaman() {
		return $this->slider_zaman;
	}

	public function set_slider_fiyat($slider_fiyat) {
		$this->slider_fiyat = $slider_fiyat;
	}

	public function get_slider_fiyat() {
		return $this->slider_fiyat;
	}

	public function set_slider_durum($slider_durum) {
		$this->slider_durum = $slider_durum;
	}

	public function get_slider_durum() {
		return $this->slider_durum;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}
}
?>