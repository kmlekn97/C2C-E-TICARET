<?php
/**
 * 
 */
require_once 'CLASS/Alt_kategori.php';
require_once 'CLASS/Alt_kategori_detay.php';
require_once 'CLASS/Alt_kategori_ozellik.php';
require_once 'CLASS/Alt_kategori_ozellik_detay.php';
require_once 'CLASS/Ayar.php';
require_once 'CLASS/Kategorilerim.php';
require_once 'CLASS/Beden.php';
require_once 'CLASS/Urun.php';
require_once 'CLASS/Kullanici.php';
require_once 'CLASS/Renk.php';
require_once 'CLASS/Calisan.php';
require_once 'CLASS/Siparis.php';
require_once 'CLASS/Siparis_Detay.php';
require_once 'CLASS/Mesaj.php';
require_once 'CLASS/Hakkimizda.php';
require_once 'CLASS/Iade.php';
require_once 'CLASS/Marka.php';
require_once 'CLASS/Kampanya.php';
require_once 'CLASS/Kampanya_galeri.php';
require_once 'CLASS/Kayit.php';
require_once 'CLASS/Sikayet.php';
require_once 'CLASS/Slider.php';
require_once 'CLASS/Urun_Ozelliklerim.php';
require_once 'CLASS/Ozellik_Detay.php';
require_once 'CLASS/Ozellik_Detay_Icerik.php';
require_once 'CLASS/Urunfoto.php';
require_once 'CLASS/Yetkiler.php';
require_once 'CLASS/Yorumlar.php';
require_once 'CLASS/Sepet.php';
require_once 'CLASS/Favori.php';
require_once 'CLASS/Kampanya_Detaylarim.php';
require_once 'CLASS/Karsilastirmalar.php';

class Sınıf_Islemleri
{

	private $alt_kategori;
	private $alt_kategori_detay;
	private $urunozellik;
	private $ozellik;
	private $ayarlarim;
	private $kategorim;
	private $bedenler;
	private $Urunlerim;
	private $kullanicilarim;
	private $renklerim;
	private $Calisanlarim;
	private $hesaplarim;
	private $cari_islem;
	private $hesapsiparis;
	private $mesajlarim;
	private $hakkimizda;
	private $iadeler;
	private $Markalar;
	private $kampanyalar;
	private $kampanya_galeri;
	private $kayitlar;
	private $sikayetler;
	private $slider;
	private $urun_ozellik;
	private $ozellik_detaylari;
	private $ozellik_detay_icerik;
	private $foto;
	private $yetkiler;
	private $yorumlarim;
	private $sepetlerim;
	private $favorilerim;
	private $siparislerim;
	private $kampanya_detaylarim;
	private $karsilastirmalarim;

	public function Alt_kategori_ekle($vericek)
	{
		$this->alt_kategori=new Alt_kategori($vericek['alt_kategori_id'],$vericek['alt_kategori_ad'],$vericek['alt_kategori_sira'],$vericek['alt_kategori_durum'],$vericek['alt_kategori_seourl'],$vericek['kategori_id'],$vericek['kullanici_id'],$vericek['kategori_ad'],$vericek['kategori_oran'],$vericek['kategori_onecikar'],$vericek['kategori_seourl'],$vericek['kategori_sira'],$vericek['kategori_durum']);
		return $this->alt_kategori;
	}

	public function Alt_kategori_detay_ekle($detaycek,$kategorialtcek)
	{
		$this->alt_kategori_detay=new Alt_kategori_detay($detaycek['alt_kategori_detay_id'],$detaycek['alt_kategori_detay_ad'],$detaycek['alt_kategori_detay_sira'],$detaycek['alt_kategori_detay_durum'],$detaycek['alt_kategori_seourl'],$kategorialtcek['alt_kategori_id'],$kategorialtcek['alt_kategori_ad'],$kategorialtcek['alt_kategori_sira'],$kategorialtcek['alt_kategori_durum'],$kategorialtcek['alt_kategori_seourl'],$detaycek['kategori_id'],$detaycek['kullanici_id']);
		return $this->alt_kategori_detay;
	}

	public function Alt_kategori_ozellik_ekle($vericek)
	{
		$this->urunozellik=new Alt_kategori_ozellik($vericek['urun_ozellikleri_id'],$vericek['alt_kategori_detay_id'],$vericek['ozellik_adi'],$vericek['ozellik_durum'],$vericek['kullanici_id']);
		return $this->urunozellik;
	}

	public function Alt_kategori_ozellik_detay_ekle($özellikcek,$urunözellikcek)
	{
		$this->ozellik=new Alt_kategori_ozellik_detay($özellikcek['ozellik_detay_id'],$özellikcek['ozellik_detay'],$urunözellikcek['urun_ozellikleri_id'],$urunözellikcek['alt_kategori_detay_id'],$urunözellikcek['ozellik_adi'],$urunözellikcek['ozellik_durum'],$özellikcek['kullanici_id']);
		return $this->ozellik;
	}

	public function Ayar_ekle($vericek)
	{
		$this->ayarlarim=new Ayar($vericek['ayar_id'],$vericek['ayar_logo'],$vericek['ayar_url'],$vericek['ayar_title'],$vericek['ayar_description'],$vericek['ayar_keywords'],$vericek['ayar_author'],$vericek['ayar_tel'],$vericek['ayar_gsm'],$vericek['ayar_faks'],$vericek['ayar_mail'],$vericek['ayar_ilce'],$vericek['ayar_il'],$vericek['ayar_adres'],$vericek['vergi_dairesi'],$vericek['vds'],$vericek['ayar_mesai'],$vericek['ayar_maps'],$vericek['ayar_analystic'],$vericek['ayar_zopim'],$vericek['ayar_facebook'],$vericek['ayar_twitter'],$vericek['ayar_google'],$vericek['ayar_youtube'],$vericek['ayar_smtphost'],$vericek['ayar_smtpuser'],$vericek['ayar_smtppassword'],$vericek['ayar_smtpport'],$vericek['ayar_bakim'],$vericek['kullanici_id'],$vericek['zaman']);
		return $this->ayarlarim;
	}

	public function Kategori_ekle($vericek)
	{
		$this->kategorim=new Kategorilerim($vericek['kategori_id'],$vericek['kategori_ad'],$vericek['kategori_oran'],$vericek['kategori_onecikar'],$vericek['kategori_seourl'],$vericek['kategori_sira'],$vericek['kategori_durum'],$vericek['kullanici_id']);
		return $this->kategorim;
	}

	public function Beden_ekle($vericek)
	{
		$this->bedenler=new Beden($vericek['beden_id'],$vericek['kategori_id'],$vericek['alt_kategori_id'],$vericek['beden_icerik'],$vericek['alt_kategori_detay_id'],$vericek['kullanici_id']);
		return $this->bedenler;
	}

	public function Urun_ekle($vericek)
	{
		$this->Urunlerim=new Urun($vericek['urun_id'],$vericek['barkod_no'],$vericek['kullanici_id'],$vericek['kategori_id'],$vericek['alt_kategori_id'],$vericek['alt_kategori_detay_id'],$vericek['marka_id'],$vericek['renk_id'],$vericek['beden_id'],$vericek['urun_zaman'],$vericek['urunfoto_resimyol'],$vericek['urun_ad'],$vericek['urun_seourl'],$vericek['urun_detay'],$vericek['urun_fiyat'],$vericek['urun_fiyat_yedek'],$vericek['urun_kdv'],$vericek['urun_satis'],$vericek['urun_video'],$vericek['urun_keyword'],$vericek['urun_stok'],$vericek['urun_durum'],$vericek['vitrin_tarih'],$vericek['urun_onecikar'],$vericek['islem_kullanici_id']);
		return $this->Urunlerim;
	}

	public function Kullanici_ekle($vericek)
	{
		$this->kullanicilarim=new Kullanici($vericek['kullanici_id'],$vericek['subMerchantKey'],$vericek['kullanici_magaza'],$vericek['magaza_adi'],$vericek['kullanici_magazafoto'],$vericek['kullanici_zaman'],$vericek['kullanici_sonzaman'],$vericek['kullanici_sonip'],$vericek['kullanici_resim'],$vericek['kullanici_tc'],$vericek['kullanici_banka'],$vericek['kullanici_iban'],$vericek['kullanici_ad'],$vericek['kullanici_soyad'],$vericek['kullanici_mail'],$vericek['kullanici_gsm'],$vericek['kullanici_password'],$vericek['kullanici_adres'],$vericek['kullanici_il'],$vericek['kullanici_ilce'],$vericek['kullanici_unvan'],$vericek['kullanici_tip'],$vericek['kullanici_vdaire'],$vericek['kullanici_vno'],$vericek['misafir_no'],$vericek['kullanici_yetki'],$vericek['kullanici_durum']);
		return $this->kullanicilarim;
	}

	public function Renk_ekle($vericek)
	{
		$this->renklerim=new Renk($vericek['renk_id'],$vericek['renk_adi'],$vericek['renk_kodu'],$vericek['kullanici_id']);
		return $this->renklerim;
	}

	public function Calisan_ekle($vericek)
	{
		$this->Calisanlarim=new Calisan($vericek['calisan_id'],$vericek['calisan_ad'],$vericek['calisan_soyad'],$vericek['calisan_maas'],$vericek['kullanici_id'],$vericek['calisan_departman'],$vericek['calisan_unvan'],$vericek['islem_kullanici_id'],$vericek['toplammaas']);
		return $this->Calisanlarim;
	}

	public function Hesap_ekle($vericek)
	{
		$this->hesaplarim=new Hesap($vericek['hesap_id'],$vericek['hesap_adi'],$vericek['hesap_tarih'],$vericek['hesap_iban'],$vericek['durum'],$vericek['kullanici_id']);
		return $this->hesaplarim;
	}

	public function Cari_Islem_ekle($hesapcek,$toplamcek)
	{
		$this->cari_islem=new Cari_Islem($hesapcek['hesap_islem_id'],$hesapcek['hesap_id'],$hesapcek['islem_tarih'],$hesapcek['islem_tip'],$hesapcek['islem_ucret'],$hesapcek['islem_aciklama'],$hesapcek['kullanici_id'],$hesapcek['hesap_adi'],$hesapcek['hesap_tarih'],$hesapcek['hesap_iban'],$hesapcek['durum'],$toplamcek['gelir'],$toplamcek['gider'],$toplamcek['kargogider']);
		return $this->cari_islem;
	}

	public function Siparis_ekle($vericek)
	{
		$this->siparislerim=new Siparis($vericek['siparis_id'],$vericek['siparis_zaman'],$vericek['kullanici_id'],$vericek['kullanici_idsatici'],$vericek['siparis_odeme']);
		return $this->siparislerim;
	}

	public function Siparis_Detay_ekle($vericek)
	{
		$this->hesapsiparis=new Siparis_Detay($vericek['siparisdetay_id'],$vericek['siparis_id'],$vericek['kullanici_id'],$vericek['kullanici_idsatici'],$vericek['urun_id'],$vericek['urun_fiyat'],$vericek['urun_adet'],$vericek['siparisdetay_kargozaman'],$vericek['siparisdetay_kargoad'],$vericek['siparis_kargodurum'],$vericek['siparisdetay_kargono'],$vericek['siparis_kargoucret'],$vericek['siparisdetay_onay'],$vericek['siparisdetay_yorum'],$vericek['siparisdetay_onayzaman'],$vericek['iade_et'],$vericek['islem_kullanici_id'],$vericek['siparis_zaman'],$vericek['siparis_odeme']);
		return $this->hesapsiparis;
	}

	public function Mesaj_ekle($vericek)
	{
		$this->mesajlarim=new Mesaj($vericek['mesaj_id'],$vericek['mesaj_zaman'],$vericek['mesaj_detay'],$vericek['mesaj_konu'],$vericek['kullanici_gel'],$vericek['kullanici_gon'],$vericek['aciklama'],$vericek['mesaj_okunma'],$vericek['kullanici_id']);
		return $this->mesajlarim;
	}

	public function Hakkimizda_ekle($vericek)
	{
		$this->hakkimizda=new Hakkimizda($vericek['hakkimizda_id'],$vericek['hakkimizda_baslik'],$vericek['hakkimizda_icerik'],$vericek['hakkimizda_video'],$vericek['hakkimizda_vizyon'],$vericek['hakkimizda_misyon'],$vericek['kullanici_id']);
		return $this->hakkimizda;
	}

	public function Iade_ekle($vericek)
	{
		$this->iadeler=new Iade($vericek['iade_id'],$vericek['iade_turu'],$vericek['iade_aciklama'],$vericek['iade_tarihi'],$vericek['kullanici_id'],$vericek['siparis_id'],$vericek['urun_id'],$vericek['kargo_no'],$vericek['kargo_ucret'],$vericek['iade_durum'],$vericek['siparis_zaman'],$vericek['kullanici_idsatici'],$vericek['siparis_odeme']);
		return $this->iadeler;
	}

	public function Marka_ekle($vericek)
	{
		$this->Markalar=new Marka($vericek['marka_id'],$vericek['marka_adi'],$vericek['kategori_id'],$vericek['alt_kategori_id'],$vericek['alt_kategori_detay_id'],$vericek['kullanici_id'],$vericek['marka_durum']);
		return $this->Markalar;
	}

	public function Kampanya_ekle($vericek)
	{
		$this->kampanyalar=new Kampanya($vericek['kampanya_id'],$vericek['kampanya_adi'],$vericek['kampanya_aciklama'],$vericek['kampanya_oran'],$vericek['kampanya_logo'],$vericek['kampanyabaslangic_tarihi'],$vericek['kampanyabitis_tarihi'],$vericek['kategori_id'],$vericek['durum'],$vericek['kullanici_id']);
		return $this->kampanyalar;
	}

	public function Kampanya_galeri_ekle($vericek)
	{
		$this->kampanya_galeri=new Kampanya_galeri($vericek['kampanya_galeri_id'],$vericek['kampanya_id'],$vericek['kampanya_resimyol'],$vericek['kullanici_id'],$vericek['kampanya_adi'],$vericek['kampanya_aciklama'],$vericek['kampanya_oran'],$vericek['kampanya_logo'],$vericek['kampanyabaslangic_tarihi'],$vericek['kampanyabitis_tarihi'],$vericek['kategori_id'],$vericek['durum']);
		return $this->kampanya_galeri;
	}

	public function Kayit_ekle($vericek)
	{
		$this->kayitlar=new Kayit($vericek['Kayit_id'],$vericek['Kayit_tarih'],$vericek['Kayit_detay'],$vericek['Kayit_ip'],$vericek['kullanici_id'],$vericek['subMerchantKey'],$vericek['kullanici_magaza'],$vericek['magaza_adi'],$vericek['kullanici_magazafoto'],$vericek['kullanici_zaman'],$vericek['kullanici_sonzaman'],$vericek['kullanici_sonip'],$vericek['kullanici_resim'],$vericek['kullanici_tc'],$vericek['kullanici_banka'],$vericek['kullanici_iban'],$vericek['kullanici_ad'],$vericek['kullanici_soyad'],$vericek['kullanici_mail'],$vericek['kullanici_gsm'],$vericek['kullanici_password'],$vericek['kullanici_adres'],$vericek['kullanici_il'],$vericek['kullanici_ilce'],$vericek['kullanici_unvan'],$vericek['kullanici_tip'],$vericek['kullanici_vdaire'],$vericek['kullanici_vno'],$vericek['misafir_no'],$vericek['kullanici_yetki'],$vericek['kullanici_durum']);
		return $this->kayitlar;
	}

	public function Sikayet_ekle($vericek)
	{
		$this->sikayetler=new Sikayet($vericek['sikayet_id'],$vericek['sikayet_zaman'],$vericek['sikayet_nedeni'],$vericek['kullanici_id'],$vericek['kullanici_idsatici']);
		return $this->sikayetler;
	}

	public function Slider_ekle($vericek)
	{
		$this->slider=new Slider($vericek['slider_id'],$vericek['slider_ad'],$vericek['slider_resimyol'],$vericek['slider_sira'],$vericek['slider_link'],$vericek['slider_sure'],$vericek['slider_zaman'],$vericek['slider_fiyat'],$vericek['slider_durum'],$vericek['kullanici_id']);
		return $this->slider;
	}

	public function Urun_Ozellik_ekle($vericek)
	{
		$this->urun_ozellik=new Urun_Ozelliklerim($vericek['urun_ozellikleri_id'],$vericek['alt_kategori_detay_id'],$vericek['ozellik_adi'],$vericek['ozellik_durum'],$vericek['kullanici_id']);
		return $this->urun_ozellik;
	}

	public function Ozellik_Detay_ekle($vericek)
	{
		$this->ozellik_detaylari=new Ozellik_Detay($vericek['ozellik_detay_id'],$vericek['urun_ozellikleri_id'],$vericek['ozellik_detay'],$vericek['kullanici_id'],$vericek['urun_ozellikleri_id'],$vericek['alt_kategori_detay_id'],$vericek['ozellik_adi'],$vericek['ozellik_durum']);
		return $this->ozellik_detaylari;
	}

	public function Ozellik_Detay_Icerik_ekle($vericek)
	{
		$this->ozellik_detay_icerik=new Ozellik_Detay_Icerik($vericek['ozellik_detay_icerik_id'],$vericek['ozellik_detay_id'],$vericek['urun_id'],$vericek['kullanici_id']);
		return $this->ozellik_detay_icerik;
	}

	public function Urunfoto_ekle($vericek)
	{
		$this->foto=new Urunfoto($vericek['urunfoto_id'],$vericek['urun_id'],$vericek['urunfoto_resimyol'],$vericek['kullanici_id']);
		return $this->foto;
	}

	public function Yetkiler_ekle($vericek)
	{
		$this->yetkiler=new Yetkiler($vericek['yetki_id'],$vericek['kullanici_id'],$vericek['yetki_adi'],$vericek['yetki_tarih'],$vericek['vkullanici_id']);
		return $this->yetkiler;
	}

	public function Yorumlar_ekle($vericek)
	{
		$this->yorumlarim=new Yorumlar($vericek['yorum_id'],$vericek['kullanici_id'],$vericek['urun_id'],$vericek['yorum_detay'],$vericek['yorum_puan'],$vericek['yorum_zaman'],$vericek['yorum_onay'],$vericek['yorum_analys']);
		return $this->yorumlarim;
	}

	public function Sepet_ekle($vericek)
	{
		$this->sepetlerim=new Sepet($vericek['sepet_id'],$vericek['kullanici_id'],$vericek['urun_id'],$vericek['urun_adet']);
		return $this->sepetlerim;
	}

	public function Favori_ekle($vericek)
	{
		$this->favorilerim=new Favori($vericek['favoriler_id'],$vericek['urun_id'],$vericek['kullanici_id'],$vericek['favori_fiyat'],$vericek['favori_durum']);
		return $this->favorilerim;
	}

	public function Kampanya_Detaylarim_ekle($vericek)
	{
		$this->kampanya_detaylarim=new Kampanya_Detaylarim($vericek['kampanya_detay_id'],$vericek['kampanya_id'],$vericek['urun_id'],$vericek['durum'],$vericek['kullanici_id']);
		return $this->kampanya_detaylarim;
	}

	public function Karsilastirmalar_ekle($vericek)
	{
		$this->karsilastirmalarim=new Karsilastirmalar($vericek['karsilastir_id'],$vericek['urun_id'],$vericek['kullanici_id']);
		return $this->karsilastirmalarim;
	}
}
?>