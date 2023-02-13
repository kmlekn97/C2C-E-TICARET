<?php
/**
 * 
 */
require_once 'CLASS/Kampanya.php';
class Kampanya_galeri extends Kampanya
{

	private $kampanya_galeri_id;
	private $kampanya_id;
	private $kampanya_resimyol;
	private $kullanici_id;
	
	function __construct($kampanya_galeri_id,$kampanya_id,$kampanya_resimyol,$kullanici_id,$kampanya_adi,$kampanya_aciklama,$kampanya_oran,$kampanya_logo,$kampanyabaslangic_tarihi,$kampanyabitis_tarihi,$kategori_id,$durum)
	{
		// code...
		$this->kampanya_galeri_id = $kampanya_galeri_id;
		$this->kampanya_id = $kampanya_id;
		$this->kampanya_resimyol = $kampanya_resimyol;
		$this->kullanici_id = $kullanici_id;
		$this->kampanya_adi = $kampanya_adi;
		$this->kampanya_aciklama = $kampanya_aciklama;
		$this->kampanya_oran = $kampanya_oran;
		$this->kampanya_logo = $kampanya_logo;
		$this->kampanyabaslangic_tarihi = $kampanyabaslangic_tarihi;
		$this->kampanyabitis_tarihi = $kampanyabitis_tarihi;
		$this->kategori_id = $kategori_id;
		$this->durum = $durum;
	}

	public function set_kampanya_galeri_id($kampanya_galeri_id) {
		$this->kampanya_galeri_id = $kampanya_galeri_id;
	}

	public function get_kampanya_galeri_id() {
		return $this->kampanya_galeri_id;
	}

	public function set_kampanya_id($kampanya_id) {
		$this->kampanya_id = $kampanya_id;
	}

	public function get_kampanya_id() {
		return $this->kampanya_id;
	}

	public function set_kampanya_resimyol($kampanya_resimyol) {
		$this->kampanya_resimyol = $kampanya_resimyol;
	}

	public function get_kampanya_resimyol() {
		return $this->kampanya_resimyol;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_kampanya_adi($kampanya_adi) {
		$this->kampanya_adi = $kampanya_adi;
	}

	public function get_kampanya_adi() {
		return $this->kampanya_adi;
	}

	public function set_kampanya_aciklama($kampanya_aciklama) {
		$this->kampanya_aciklama = $kampanya_aciklama;
	}

	public function get_kampanya_aciklama() {
		return $this->kampanya_aciklama;
	}

	public function set_kampanya_oran($kampanya_oran) {
		$this->kampanya_oran = $kampanya_oran;
	}

	public function get_kampanya_oran() {
		return $this->kampanya_oran;
	}

	public function set_kampanya_logo($kampanya_logo) {
		$this->kampanya_logo = $kampanya_logo;
	}

	public function get_kampanya_logo() {
		return $this->kampanya_logo;
	}

	public function set_kampanyabaslangic_tarihi($kampanyabaslangic_tarihi) {
		$this->kampanyabaslangic_tarihi = $kampanyabaslangic_tarihi;
	}

	public function get_kampanyabaslangic_tarihi() {
		return $this->kampanyabaslangic_tarihi;
	}

	public function set_kampanyabitis_tarihi($kampanyabitis_tarihi) {
		$this->kampanyabitis_tarihi = $kampanyabitis_tarihi;
	}

	public function get_kampanyabitis_tarihi() {
		return $this->kampanyabitis_tarihi;
	}

	public function set_kategori_id($kategori_id) {
		$this->kategori_id = $kategori_id;
	}

	public function get_kategori_id() {
		return $this->kategori_id;
	}

	public function set_durum($durum) {
		$this->durum = $durum;
	}

	public function get_durum() {
		return $this->durum;
	}


}
?>