<?php
/**
 * 
 */
class Urun
{

	private $urun_id;
	private $barkod_no;
	private $kullanici_id;
	private $kategori_id;
	private $alt_kategori_id;
	private $alt_kategori_detay_id;
	private $marka_id;
	private $renk_id;
	private $beden_id;
	private $urun_zaman;
	private $urunfoto_resimyol;
	private $urun_ad;
	private $urun_seourl;
	private $urun_detay;
	private $urun_fiyat;
	private $urun_fiyat_yedek;
	private $urun_kdv;
	private $urun_satis;
	private $urun_video;
	private $urun_keyword;
	private $urun_stok;
	private $urun_durum;
	private $vitrin_tarih;
	private $urun_onecikar;
	private $islem_kullanici_id;
	
	function __construct($urun_id,$barkod_no,$kullanici_id,$kategori_id,$alt_kategori_id,$alt_kategori_detay_id,$marka_id,$renk_id,$beden_id,$urun_zaman,$urunfoto_resimyol,$urun_ad,$urun_seourl,$urun_detay,$urun_fiyat,$urun_fiyat_yedek,$urun_kdv,$urun_satis,$urun_video,$urun_keyword,$urun_stok,$urun_durum,$vitrin_tarih,$urun_onecikar,$islem_kullanici_id)
	{
		// code...
		$this->urun_id = $urun_id;
		$this->barkod_no = $barkod_no;
		$this->kullanici_id = $kullanici_id;
		$this->kategori_id = $kategori_id;
		$this->alt_kategori_id = $alt_kategori_id;
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
		$this->marka_id = $marka_id;
		$this->renk_id = $renk_id;
		$this->beden_id = $beden_id;
		$this->urun_zaman = $urun_zaman;
		$this->urunfoto_resimyol = $urunfoto_resimyol;
		$this->urun_ad = $urun_ad;
		$this->urun_seourl = $urun_seourl;
		$this->urun_detay = $urun_detay;
		$this->urun_fiyat = $urun_fiyat;
		$this->urun_fiyat_yedek = $urun_fiyat_yedek;
		$this->urun_kdv = $urun_kdv;
		$this->urun_satis = $urun_satis;
		$this->urun_video = $urun_video;
		$this->urun_keyword = $urun_keyword;
		$this->urun_stok = $urun_stok;
		$this->urun_durum = $urun_durum;
		$this->vitrin_tarih = $vitrin_tarih;
		$this->urun_onecikar = $urun_onecikar;
		$this->islem_kullanici_id = $islem_kullanici_id;
	}

	public function set_urun_id($urun_id) {
		$this->urun_id = $urun_id;
	}

	public function get_urun_id() {
		return $this->urun_id;
	}

	public function set_barkod_no($barkod_no) {
		$this->barkod_no = $barkod_no;
	}

	public function get_barkod_no() {
		return $this->barkod_no;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_kategori_id($kategori_id) {
		$this->kategori_id = $kategori_id;
	}

	public function get_kategori_id() {
		return $this->kategori_id;
	}

	public function set_alt_kategori_id($alt_kategori_id) {
		$this->alt_kategori_id = $alt_kategori_id;
	}

	public function get_alt_kategori_id() {
		return $this->alt_kategori_id;
	}

	public function set_alt_kategori_detay_id($alt_kategori_detay_id) {
		$this->alt_kategori_detay_id = $alt_kategori_detay_id;
	}

	public function get_alt_kategori_detay_id() {
		return $this->alt_kategori_detay_id;
	}

	public function set_marka_id($marka_id) {
		$this->marka_id = $marka_id;
	}

	public function get_marka_id() {
		return $this->marka_id;
	}

	public function set_renk_id($renk_id) {
		$this->renk_id = $renk_id;
	}

	public function get_renk_id() {
		return $this->renk_id;
	}

	public function set_beden_id($beden_id) {
		$this->beden_id = $beden_id;
	}

	public function get_beden_id() {
		return $this->beden_id;
	}

	public function set_urun_zaman($urun_zaman) {
		$this->urun_zaman = $urun_zaman;
	}

	public function get_urun_zaman() {
		return $this->urun_zaman;
	}

	public function set_urunfoto_resimyol($urunfoto_resimyol) {
		$this->urunfoto_resimyol = $urunfoto_resimyol;
	}

	public function get_urunfoto_resimyol() {
		return $this->urunfoto_resimyol;
	}

	public function set_urun_ad($urun_ad) {
		$this->urun_ad = $urun_ad;
	}

	public function get_urun_ad() {
		return $this->urun_ad;
	}

	public function set_urun_seourl($urun_seourl) {
		$this->urun_seourl = $urun_seourl;
	}

	public function get_urun_seourl() {
		return $this->urun_seourl;
	}

	public function set_urun_detay($urun_detay) {
		$this->urun_detay = $urun_detay;
	}

	public function get_urun_detay() {
		return $this->urun_detay;
	}

	public function set_urun_fiyat($urun_fiyat) {
		$this->urun_fiyat = $urun_fiyat;
	}

	public function get_urun_fiyat() {
		return $this->urun_fiyat;
	}

	public function set_urun_fiyat_yedek($urun_fiyat_yedek) {
		$this->urun_fiyat_yedek = $urun_fiyat_yedek;
	}

	public function get_urun_fiyat_yedek() {
		return $this->urun_fiyat_yedek;
	}

	public function set_urun_kdv($urun_kdv) {
		$this->urun_kdv = $urun_kdv;
	}

	public function get_urun_kdv() {
		return $this->urun_kdv;
	}

	public function set_urun_satis($urun_satis) {
		$this->urun_satis = $urun_satis;
	}

	public function get_urun_satis() {
		return $this->urun_satis;
	}

	public function set_urun_video($urun_video) {
		$this->urun_video = $urun_video;
	}

	public function get_urun_video() {
		return $this->urun_video;
	}

	public function set_urun_keyword($urun_keyword) {
		$this->urun_keyword = $urun_keyword;
	}

	public function get_urun_keyword() {
		return $this->urun_keyword;
	}

	public function set_urun_stok($urun_stok) {
		$this->urun_stok = $urun_stok;
	}

	public function get_urun_stok() {
		return $this->urun_stok;
	}

	public function set_urun_durum($urun_durum) {
		$this->urun_durum = $urun_durum;
	}

	public function get_urun_durum() {
		return $this->urun_durum;
	}

	public function set_vitrin_tarih($vitrin_tarih) {
		$this->vitrin_tarih = $vitrin_tarih;
	}

	public function get_vitrin_tarih() {
		return $this->vitrin_tarih;
	}

	public function set_urun_onecikar($urun_onecikar) {
		$this->urun_onecikar = $urun_onecikar;
	}

	public function get_urun_onecikar() {
		return $this->urun_onecikar;
	}

	public function set_islem_kullanici_id($islem_kullanici_id) {
		$this->islem_kullanici_id = $islem_kullanici_id;
	}

	public function get_islem_kullanici_id() {
		return $this->islem_kullanici_id;
	}
}
?>