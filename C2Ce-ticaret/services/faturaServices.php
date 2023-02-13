<?php
/**
 * 
 */
class faturaServices
{
	
	private $dbsql;

	function __construct($dbsql)
	{
		$this->dbsql = $dbsql;
	}

	public function ayarGetir()
	{
		$logosor=$this->dbsql->wread("ayar","ayar_id",0);
		$logocek=$logosor->fetch(PDO::FETCH_ASSOC);
		return $logocek;
	}

	public function FaturaSiparisone()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 0

			));
		return $siparissor;
	}

	public function FaturaSiparisSecond($value='')
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
			'siparis_detay.iade_et' => 0

		));
		return $siparissor2;
	}

	public function MarkaListele($marka_id)
	{
		$markasor=$this->dbsql->wread("marka","marka_id",$marka_id);
		$markacek=$markasor->fetch(PDO::FETCH_ASSOC);
		return $markacek;
	}

	public function RenkListele($renk_id)
	{
		$renksor=$this->dbsql->wread("renkler","renk_id",$renk_id);
		$renkcek=$renksor->fetch(PDO::FETCH_ASSOC);
		return $renkcek;
	}

	public function BedenListele($beden_id)
	{
		$bedensor=$this->dbsql->wread("beden","beden_id",$beden_id);
		$bedencek=$bedensor->fetch(PDO::FETCH_ASSOC);
		return $bedencek;
	}

	public function AliciFaturaSiparisOne()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 0

		));
		return $siparissor;
	}

	public function AliciFaturaSiparisSecond()
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 0

		));
		return $siparissor2;
	}

	public function IadeFaturaSiparisOne()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.siparis_id' => htmlspecialchars($_GET['siparis_id']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 1

			));
		return $siparissor;
	}

	public function IadeFaturaSiparisSecond()
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 1

			));
		return $siparissor2;
	}

	public function IadeKullaniciFaturaSiparisOne()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 1

		));
		return $siparissor;
	}

	public function IadeKullaniciFaturaSiparisSecond()
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 1

		));
		return $siparissor2;
	}

	public function IadeSaticiFaturaSiparisOne()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.kullanici_idsatici' =>  htmlspecialchars($_SESSION['userkullanici_id']),
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 1

			));
		return $siparissor;
	}

	public function IadeSaticiFaturaSiparisSecond()
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.kullanici_idsatici' =>  htmlspecialchars($_SESSION['userkullanici_id']),
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 1

			));
		return $siparissor2;
	}

	public function SaticiFaturaSiparisone()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.kullanici_idsatici' =>  htmlspecialchars($_SESSION['userkullanici_id']),
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 0

			));
		return $siparissor;
	}

	public function SaticiFaturaSiparissecond()
	{
		$siparissor2=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis.kullanici_idsatici' =>  htmlspecialchars($_SESSION['userkullanici_id']),
				'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
				'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
				'siparis_detay.iade_et' => 0

			));
		return $siparissor2;
	}

	public function IadeListele($siparis_id)
	{
		$iadesor=$this->dbsql->wread("iade","siparis_id",htmlspecialchars($siparis_id));
		$iadecek=$iadesor->fetch(PDO::FETCH_ASSOC);
		return $iadecek;
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}
}
?>