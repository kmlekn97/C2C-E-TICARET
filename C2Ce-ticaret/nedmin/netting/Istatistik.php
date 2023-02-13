<?php
session_start();
require_once 'dbconfig.php';
class hesap
{

	private $db;
	private $dbhost=DBHOST;
	private $dbuser=DBUSER;
	private $dbpass=DBPWD;
	private $dbname=DBNAME;


	function __construct() {

		try {

			$this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);

		 //echo "Bağlantı Başarılı";

		} catch (Exception $e) {

			die("Bağlantı Başarısız:".$e->getMessage());
		}

	}	

	public function siparis($sql=null,$durum)
	{
		try {

			$toplamsiparissor=$this->db->prepare("SELECT SUM((siparis_detay.urun_fiyat*siparis_detay.urun_adet)*kategori.kategori_oran/100) as gelir,SUM(siparis_kargoucret) as kargogider,siparis.*,siparis_detay.*,kullanici.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis.kullanici_idsatici=kullanici.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id $sql");
			$toplamsipariscek=$toplamsiparissor->execute();
			$toplamsipariscek=$toplamsiparissor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		if ($durum=="satis")
			return $toplamsipariscek['gelir'];
		else
			return $toplamsipariscek['kargogider'];
	}

	public function cari($sql=null,$durum)
	{
		try {

			$genelcarisor=$this->db->prepare("SELECT SUM(CASE WHEN islem_tip='Gelir' THEN islem_ucret ELSE 0 END) as gelir,SUM(CASE WHEN islem_tip='Gider' THEN islem_ucret ELSE 0 END) as gider FROM hesap_islem $sql");
			$genelcaricek=$genelcarisor->execute();
			$genelcaricek=$genelcarisor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		if ($durum=="gelir")
			return $genelcaricek['gelir'];
		else
			return $genelcaricek['gider'];
	}

	public function kategorihesapla($value,$kategori,$sql=null)
	{
		try {

			$kategorisor=$this->db->prepare("SELECT SUM(CASE WHEN urun.kategori_id='$kategori' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as toplam,SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as genel_toplam,siparis.*,siparis_detay.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id $sql");
			$kategoricek=$kategorisor->execute();
			$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		return $kategoricek[$value];
	}

	public function altkategorihesapla($value,$kategori,$altkategori,$sql=null)
	{
		try {

			$kategorisor=$this->db->prepare("SELECT SUM(CASE WHEN urun.alt_kategori_id='$altkategori' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as toplam,SUM(CASE WHEN urun.kategori_id='$kategori' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as kategori_top,siparis.*,siparis_detay.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id $sql");
			$kategoricek=$kategorisor->execute();
			$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		return $kategoricek[$value];
	}

	public function altkategoridetayhesapla($value,$kategori,$altkategori,$altdetay,$sql=null)
	{
		try {

			$kategorisor=$this->db->prepare("SELECT SUM(CASE WHEN urun.alt_kategori_detay_id='$altdetay' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as altdetaytoplam,SUM(CASE WHEN urun.alt_kategori_id='$altkategori' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as alttoplam,SUM(CASE WHEN urun.kategori_id='$kategori' THEN siparis_detay.urun_fiyat*siparis_detay.urun_adet ELSE 0 END) as kategori_top,siparis.*,siparis_detay.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id $sql");
			$kategoricek=$kategorisor->execute();
			$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		return $kategoricek[$value];
	}

	public function satici_siparis($sql=null,$kullanici_id)
	{
		try {

			$toplamsiparissor=$this->db->prepare("SELECT SUM(urun_fiyat*urun_adet) as toplam FROM siparis_detay WHERE siparis_detay.kullanici_idsatici=$kullanici_id and iade_et='0' $sql");
			$toplamsipariscek=$toplamsiparissor->execute();
			$toplamsipariscek=$toplamsiparissor->fetch(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
		return $toplamsipariscek['toplam'];
	}
}
?>