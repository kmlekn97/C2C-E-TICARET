<?php
/**
 * 
 */
require_once 'ArrayList.php';
class AdminDBServices
{
	
	private $cons;
	private $dbsql;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
	}

	public function altKategoriListele($alt_kategori_id)
	{
		$kategorialtdetaysor=$this->dbsql->wread("alt_kategori","alt_kategori_id",htmlspecialchars($alt_kategori_id));
		$kategorialtdetaycek=$kategorialtdetaysor->fetch(PDO::FETCH_ASSOC);
		$altkategori=$this->cons->Alt_kategori_ekle($kategorialtdetaycek);
		return $altkategori;
	}

	public function altkategoriSiraliListele($kategori_id)
	{
		$arraylist=array();
		$altkategorilist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori","kategori_id",htmlspecialchars($kategori_id),[
			"columns_name" => "alt_kategori_sira",
			"columns_sort" => "ASC"
		]);
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) {

			$altkategori=$this->cons->Alt_kategori_ekle($kategorialtcek);
			$altkategorilist->add($altkategori);

		}
		return $altkategorilist;
	}


	public function altkategoricek($alt_kategori_id)
	{
		$kategorialtdetaysor=$this->dbsql->wread("alt_kategori","alt_kategori_id",htmlspecialchars(($alt_kategori_id)));
		$kategorialtcek=$kategorialtdetaysor->fetch(PDO::FETCH_ASSOC);
		return $kategorialtcek;
	}


	public function altkategoridetayListele($alt_kategori_id,$kategorialtcek)
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($arraylist);
		$detaysor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_id",htmlspecialchars($alt_kategori_id),[
			"columns_name" => "alt_kategori_detay_sira",
			"columns_sort" => "ASC"
		]);

		while($detaycek=$detaysor->fetch(PDO::FETCH_ASSOC)) {

			$alt_kategori_detay=$this->cons->Alt_kategori_detay_ekle($detaycek,$kategorialtcek);
			$altkategoridetaylist->add($alt_kategori_detay);

		}
		return $altkategoridetaylist;
	}

	public function altkategoridetaylarimiListele($alt_kategori_detay_id,$kategorialtcek)
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($arraylist);
		$detaysor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_detay_id",htmlspecialchars($alt_kategori_detay_id),[
			"columns_name" => "alt_kategori_detay_sira",
			"columns_sort" => "ASC"
		]);

		while($detaycek=$detaysor->fetch(PDO::FETCH_ASSOC)) {

			$alt_kategori_detay=$this->cons->Alt_kategori_detay_ekle($detaycek,$kategorialtcek);
			$altkategoridetaylist->add($alt_kategori_detay);

		}
		return $altkategoridetaylist;
	}

	public function OzellikGetir($id,$setid)
	{
		$ozelliksor=$this->dbsql->wread("ozellik_detay",$id,htmlspecialchars($setid));
		$ozellikcek=$ozelliksor->fetch(PDO::FETCH_ASSOC);
		return $ozellikcek;
	}

	public function urunOzellikGetir($id,$setid)
	{
		$urunozelliksor=$this->dbsql->wread("urun_ozellikler",$id,htmlspecialchars($setid));
		$urunozellikcek=$urunozelliksor->fetch(PDO::FETCH_ASSOC);
		return $urunozellikcek;
	}

	public function ozellikDetayListele($urun_ozellikleri_id)
	{
		$ozellidetaysor=$this->dbsql->wread("ozellik_detay","urun_ozellikleri_id",htmlspecialchars($urun_ozellikleri_id));
		return $ozellidetaysor;
	}

	public function UrunOzellikDetayListele($alt_kategori_detay_id)
	{
		$arraylist=array();
		$urunozellikdetaylist=new ArrayList($arraylist);
		$ozelliksor=$this->dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($alt_kategori_detay_id));

		while($ozellikcek=$ozelliksor->fetch(PDO::FETCH_ASSOC)) { 
			$urunozellik=$this->cons->Alt_kategori_ozellik_ekle($ozellikcek);
			$urunozellikdetaylist->add($urunozellik);

		}
		return $urunozellikdetaylist;
	}

	public function bedenListele($beden_id)
	{
		$bedensor=$this->dbsql->wread("beden","beden_id",htmlspecialchars($beden_id));
		$bedencek=$bedensor->fetch(PDO::FETCH_ASSOC);
		$bedenlerim=$this->cons->Beden_ekle($bedencek);
		return $bedenlerim;
	}

	public function AllBedenDisplay()
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		$bedensor=$this->dbsql->read("beden",[
			"columns_name" => "beden_icerik",
			"columns_sort" => "ASC"
		]);

		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) { 
			$beden=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($beden);

		}
		return $bedenlist;
	}

	public function kategoriListele($kategori_id)
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorisor=$this->dbsql->wread("kategori","kategori_id",$kategori_id);
		while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

			$kategorim=$this->cons->Kategori_ekle($kategoricek);
			$kategorilist->add($kategorim);
		}
		return $kategorilist;
	}

	public function altKategoriListelearray($alt_kategori_id)
	{
		$arraylist=array();
		$altkategorilist=new ArrayList($arraylist);
		$altkategori=$this->dbsql->wread("alt_kategori","alt_kategori_id",$alt_kategori_id);
		while($altkategoricek=$altkategori->fetch(PDO::FETCH_ASSOC)) {

			$alt_kategorilerim=$this->cons->Alt_kategori_ekle($altkategoricek);
			$altkategorilist->add($alt_kategorilerim);
		}
		return $altkategorilist;
	}

	public function altKategoridetayListelearray($alt_kategori_detay_id)
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($arraylist);
		$altkategoridetay=$this->dbsql->wread("alt_kategori_detay","alt_kategori_detay_id",$alt_kategori_detay_id);

		while($altkategoridetaycek=$altkategoridetay->fetch(PDO::FETCH_ASSOC)) {

			$alt_kategori_detay=$this->cons->Alt_kategori_detay_ekle($altkategoridetaycek,$altkategoridetaycek);
			$altkategoridetaylist->add($alt_kategori_detay);
		}
		return $altkategoridetaylist;
	}

	public function bedenPostIslem($renkgelen,$beden)
	{
		if ($beden=="Tüm Bedenler")
		{
			if($renkgelen=="Tüm Renkler")
			{
				$urunsor=$this->dbsql->qwsql("SELECT * from urun",array('kategori_id' => 4,
					'renk_id' => $renkgelen

				));
			}
			else
			{
				$urunsor=$this->dbsql->wread("urun","kategori_id",4);
			}
		}
		else
		{

			if ($renkgelen !="Tüm Renkler" and $beden !="Tüm Bedenler")
			{
				$urunsor=$this->dbsql->qwsql("SELECT * from urun",array('beden_id' => $beden,
					'renk_id' => $renkgelen
				));
			}
			else if ($renkgelen =="Tüm Renkler")
			{
				$urunsor=$this->dbsql->wread("urun","kategori_id",4);
			}

		}

		if ($beden =="Tüm Bedenler")
		{
			$urunsor=$this->dbsql->qwsql("SELECT * from urun",array('kategori_id' => 4,
				'renk_id' => $renkgelen
			));
		}
		else
		{
			$urunsor=$this->dbsql->wread("urun","beden_id",$beden);
		}

		if ($renkgelen !="Tüm Renkler" and $beden !="Tüm Bedenler")
		{
			$urunsor=$this->dbsql->qwsql("SELECT * from urun",array('beden_id' => $beden,
				'renk_id' => $renkgelen
			));
		}
		return $urunsor;
	}

	public function kullaniciListele($kullanici_id)
	{
		$arraylist=array();
		$kullanicilist=new ArrayList($arraylist);
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_id",$kullanici_id);

		while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {

			$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
			$kullanicilist->add($kullanicilarim);
		}
		return $kullanicilist;
	}

	public function renkleriListele($renk_id)
	{
		$arraylist=array();
		$renklist=new ArrayList($arraylist);
		$renksor=$this->dbsql->wread("renkler","renk_id",$renk_id);
		while($renkcek=$renksor->fetch(PDO::FETCH_ASSOC)) {

			$renklerim=$this->cons->Renk_ekle($renkcek);
			$renklist->add($renklerim);
		}
		return $renklist;
	}

	public function bedenArrayListele($beden_id)
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		$bedensor=$this->dbsql->wread("beden","beden_id",$beden_id);
		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) {

			$bedenlerim=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($bedenlerim);
		}
		return $bedenlist;
	}

	public function markaArrayListele($marka_id)
	{
		$arraylist=array();
		$markalist=new ArrayList($arraylist);
		$markasor=$this->dbsql->wread("marka","marka_id",$marka_id);
		while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) {

			$Markalar=$this->cons->Marka_ekle($markacek);
			$markalist->add($Markalar);
		}
		return $markalist;
	}

	public function calisanMaasGetir()
	{
		$calisanmaas=$this->dbsql->__qWsql("SELECT *,SUM(calisan_maas) AS toplammaas FROM calisanlar");
		$maastoplam=$calisanmaas->fetch(PDO::FETCH_ASSOC);
		$Calisanlarim=$this->cons->Calisan_ekle($maastoplam);
		return $Calisanlarim;
	}

	public function hesapgetir()
	{
		$hesapsor=$this->dbsql->read("hesap",[
			"columns_name" => "hesap_tarih",
			"columns_sort" => "ASC"
		]);
		return $hesapsor;
	}

	public function calisanOku()
	{
		$calisansor=$this->dbsql->read("calisanlar");
		return $calisansor;
	}

	public function calisanGetir($calisan_id)
	{
		$calisansor=$this->dbsql->wread("calisanlar","calisan_id",htmlspecialchars($calisan_id));
		$calisancek=$calisansor->fetch(PDO::FETCH_ASSOC);
		$Calisanlarim=$this->cons->Calisan_ekle($calisancek);
		return $Calisanlarim;
	}

	public function CariIslemcek($toplamcek)
	{
		$arraylist=array();
		$hesaplist=new ArrayList($arraylist);
		$hesapsor=$this->dbsql->__qwSql("SELECT hesap_islem.*,hesap.* FROM hesap INNER JOIN hesap_islem ON hesap_islem.hesap_id=hesap.hesap_id");
		while($hesapcek=$hesapsor->fetch(PDO::FETCH_ASSOC)) {

			$cari_islem=$this->cons->Cari_Islem_ekle($hesapcek,$toplamcek);
			$hesaplist->add($cari_islem);
		}
		return $hesaplist;
	}

	public function Cari_TOPLAM_Hesapla()
	{
		$toplamsor=$this->dbsql->__qwSql("SELECT SUM((siparis_detay.urun_fiyat*siparis_detay.urun_adet)*kategori.kategori_oran/100) as gelir,SUM(siparis_kargoucret) as kargogider,siparis.*,siparis_detay.*,kullanici.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis.kullanici_idsatici=kullanici.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id");
		$toplamcek=$toplamsor->fetch(PDO::FETCH_ASSOC);
		return $toplamcek;
	}

	public function HesapSiparisGetir()
	{
		$hesapsiparissor=$this->dbsql->__qwSql("SELECT siparis.*,siparis_detay.*,kullanici.*,kategori.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis.kullanici_idsatici=kullanici.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id");
		return $hesapsiparissor;
	}

	public function mesajgelengetir()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(

			'mesaj.kullanici_gel' => $_SESSION['kullanici_id'],
			'mesaj.aciklama' => 'alici'

		),[
			"columns_name" => "mesaj_zaman",
			"columns_sort" => "DESC"
		]);
		return $mesajsor;
	}

	public function mesajgidengetir()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id",array(

			'mesaj.kullanici_gon' => $_SESSION['kullanici_id'],
			'mesaj.aciklama' => 'gonderen'

		),[
			"columns_name" => "mesaj_zaman",
			"columns_sort" => "DESC"
		]);
		return $mesajsor;
	}

	public function Hakkimizda()
	{
		$hakkimizdasor=$this->dbsql->wread("hakkimizda","hakkimizda_id",0);
		$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);
		$hakkimizda=$this->cons->Hakkimizda_ekle($hakkimizdacek);
		return $hakkimizda;
	}

	public function Ayar()
	{
		$ayarsor=$this->dbsql->wread("ayar","ayar_id",0);
		$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
		$ayarlarim=$this->cons->Ayar_ekle($ayarcek);
		return $ayarlarim;
	}

	public function Kullanicimailegoregetir()
	{
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_mail",$_SESSION['kullanici_mail']);
		return $kullanicisor;
	}

	public function MesajSayHesapla()
	{
		$mesajsay=$this->dbsql->qwsql("SELECT COUNT(mesaj_okunma) as say FROM mesaj",array(
			'mesaj_okunma' => 0,
			'kullanici_gel' => $_SESSION['kullanici_id'],
			'mesaj.aciklama' => 'alici'
		));
		$saycek=$mesajsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function MesajAliciLimitli()
	{
		$mesajsor=$this->dbsql->qwsql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(

			'mesaj.kullanici_gel' => $_SESSION['kullanici_id'],
			'mesaj.mesaj_okunma' => 0,
			'mesaj.aciklama' => 'alici'

		),[
			"columns_name" => "mesaj_okunma,mesaj_zaman",
			"columns_sort" => "DESC",
			"limit" => 5
		]);
		return $mesajsor;
	}

	public function Hesap($hesap_id)
	{
		$hesapsor=$this->dbsql->wread("hesap","hesap_id",htmlspecialchars($hesap_id));
		$hesapcek=$hesapsor->fetch(PDO::FETCH_ASSOC);
		$hesaplarim=$this->cons->Hesap_ekle($hesapcek);
		return $hesaplarim;
	}

	public function iadeGetir()
	{
		$iadesor=$this->dbsql->__qwSql("SELECT siparis.kullanici_id as k_id,siparis.kullanici_idsatici as ks_id,iade.*,siparis.* from iade INNER JOIN siparis ON iade.siparis_id=siparis.siparis_id");
		return $iadesor;
	}

	public function kullaniciGetir($kullanici_id)
	{
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_id",$kullanici_id);
		return $kullanicisor;
	}

	public function iadeSiparisGetir($siparis_id)
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id INNER JOIN urun ON siparis_detay.urun_id=urun.urun_id",array(
			'siparis.siparis_id' => htmlspecialchars($siparis_id),
			'siparis_detay.iade_et' => 1
		),[
			"columns_name" => "siparis_detay.urun_fiyat",
			"columns_sort" => "DESC"
		]);
		return $siparissor;
	}

	public function Iade($iade_id)
	{
		$iadesor=$this->dbsql->wread("iade","iade_id",htmlspecialchars($iade_id));
		$iadecek=$iadesor->fetch(PDO::FETCH_ASSOC);
		$iadeler=$this->cons->Iade_ekle($iadecek);
		return $iadeler;
	}

	public function Kampanyalarigetir()
	{
		$arraylist=array();
		$kampanyalist=new ArrayList($arraylist);
		$kampanyasor=$this->dbsql->read("kampanya",[
			"columns_name" => "kampanyabaslangic_tarihi",
			"columns_sort" => "DESC"
		]);
		while($kampanyacek=$kampanyasor->fetch(PDO::FETCH_ASSOC)) {

			$kampanyalar=$this->cons->Kampanya_ekle($kampanyacek);
			$kampanyalist->add($kampanyalar);
		}
		return $kampanyalist;
	}

	public function Kampanya($kampanya_id)
	{
		$kampanyasor=$this->dbsql->wread("kampanya","kampanya_id",htmlspecialchars($kampanya_id));
		$kampanyacek=$kampanyasor->fetch(PDO::FETCH_ASSOC);
		$kampanyalar=$this->cons->Kampanya_ekle($kampanyacek);
		return $kampanyalar;
	}

	public function kampanyaSorgugetir()
	{
		$sorgu=$this->dbsql->read("kampanya_galeri");
		return $sorgu;
	}

	public function kampanyaFotoGetir($kampanya,$limit,$sayfada)
	{
		$arraylist=array();
		$kampanyafotolist=new ArrayList($arraylist);
		$kampanyafotosor=$this->dbsql->wread("kampanya_galeri","kampanya_id",htmlspecialchars($kampanya_id),[
			"columns_name" => "kampanya_galeri_id",
			"columns_sort" => "DESC",
			"limit" => $limit,$sayfada
		]);
		while($kampanyafotocek=$kampanyafotosor->fetch(PDO::FETCH_ASSOC)) { 

			$kampanya_galeri=$this->cons->Kampanya_galeri_ekle($kampanyafotocek);
			$kampanyafotolist->add($kampanya_galeri);
		}
		return $kampanyafotolist;
	}

	public function kargoSiparisListele()
	{
		$arraylist=array();
		$kargosiparislist=new ArrayList($arraylist);
		$siparissor=$this->dbsql->__qwSql("SELECT siparis_detay.kullanici_id as k_id,siparis.*,siparis_detay.*,kullanici.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id",[
			"columns_name" => "siparis.siparis_id",
			"columns_sort" => "DESC"
		]);
		while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { 

			$siparis_kargo=$this->cons->Siparis_Detay_ekle($sipariscek);
			$kargosiparislist->add($siparis_kargo);
		}
		return $kargosiparislist;
	}

	public function KargosiparisGetir($siparis_detay_id)
	{
		$siparis_detaysor=$this->dbsql->wread("siparis_detay","siparisdetay_id",htmlspecialchars($siparis_detay_id));
		$sipariscek=$siparis_detaysor->fetch(PDO::FETCH_ASSOC);
		$siparis_kargo=$this->cons->Siparis_Detay_ekle($sipariscek);
		return $siparis_kargo;
	}

	public function kategoriListeleall()
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorisor=$this->dbsql->read("kategori",[
			"columns_name" => "kategori_sira",
			"columns_sort" => "ASC"
		]);
		while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

			$kategorim=$this->cons->Kategori_ekle($kategoricek);
			$kategorilist->add($kategorim);
		}
		return $kategorilist;
	}

	public function KayitListele()
	{
		$arraylist=array();
		$kayitlist=new ArrayList($arraylist);
		$kullanicisor=$this->dbsql->__qwSql("SELECT kullanici.*,kayit.* FROM kullanici INNER JOIN kayit on kullanici.kullanici_id=kayit.kullanici_id");
		while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {

			$kayitlar=$this->cons->Kayit_ekle($kullanicicek);
			$kayitlist->add($kayitlar);
		}
		return $kayitlist;
	}

	public function allKullaniciListe()
	{
		$arraylist=array();
		$kullanicilist=new ArrayList($arraylist);
		$kullanicisor=$this->dbsql->read("kullanici");
		while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {

			$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
			$kullanicilist->add($kullanicilarim);
		}
		return $kullanicilist;
	}

	public function calisanListele($kullanici_id)
	{
		$arraylist=array();
		$kullanicilist=new ArrayList($arraylist);
		$kullanicisor=$this->dbsql->wread("calisanlar","kullanici_id",$kullanici_id);
		while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {

			$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
			$kullanicilist->add($kullanicilarim);
		}
		return $kullanicilist;
	}

	public function calisanAdetHesapla($kullanici_id)
	{
		$calisan=$this->dbsql->wread("calisanlar","kullanici_id",$kullanici_id);
		return $calisan->rowCount();
	}

	public function magazaListele($kullanici_magaza)
	{
		$arraylist=array();
		$magazalist=new ArrayList($arraylist);
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_magaza",$kullanici_magaza);
		while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {

			$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
			$magazalist->add($kullanicilarim);
		}
		return $magazalist;
	}

	public function magazaToplamSatisHesapla($kullanici_id)
	{
		$siparissor=$this->dbsql->qwSql("SELECT SUM(urun_fiyat*urun_adet) as toplam FROM siparis_detay",array(
			'kullanici_idsatici' => $kullanici_id,
			'iade_et' => 0
		));
		$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);

		if (isset($sipariscek['toplam'])) {

			return number_format($sipariscek['toplam'], 2, ',', '.')." TL";

		} else {

			return "0.00 TL";
		}
	}

	public function MarkalariGetir($marka_durum)
	{
		$markasor=$this->dbsql->qwSql("SELECT marka.*,kategori.*,kullanici.* FROM marka INNER JOIN kategori ON marka.kategori_id=kategori.kategori_id INNER JOIN kullanici ON marka.kullanici_id=kullanici.kullanici_id",array(
			'marka_durum' => $marka_durum));
		return $markasor;
	}

	public function markalistpostIslem($kategori)
	{
		if ($kategori=="Tüm Kategoriler")
		{
			$markasor=$this->dbsql->qwSql("SELECT marka.*,kategori.*,kullanici.* FROM marka INNER JOIN kategori ON marka.kategori_id=kategori.kategori_id INNER JOIN kullanici ON marka.kullanici_id=kullanici.kullanici_id",array(
				'marka_durum' => 1));
		}
		else
		{
			$markasor=$this->dbsql->qwSql("SELECT marka.*,kategori.*,kullanici.* FROM marka INNER JOIN kategori ON marka.kategori_id=kategori.kategori_id INNER JOIN kullanici ON marka.kullanici_id=kullanici.kullanici_id",array(
				'marka_durum' => 1,
				'marka.kategori_id' => $kategori));
		}
		return $markasor;
	}

	public function MarkaDetayGetir()
	{
		$markasor=$this->dbsql->__qwSql("SELECT marka.*,urun.* FROM urun INNER JOIN marka ON urun.marka_id=marka.marka_id");
		return $markasor;
	}

	public function MesajDetaygetir()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(
			'kullanici.kullanici_id' => htmlspecialchars($_GET['kullanici_gon']),
			'mesaj.mesaj_id' => htmlspecialchars($_GET['mesaj_id'])
		),[
			"columns_name" => "mesaj_zaman",
			"columns_sort" => "DESC"
		]);
		$mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC);
		$mesajlar=$this->cons->Mesaj_ekle($mesajcek);
		return $mesajlar;
	}

	public function MesajDurumDegistir($mesaj_id,$mesaj_okunma)
	{
		$mesajguncelle=$this->dbsql->update("mesaj",array(

			'mesaj_okunma' => $mesaj_okunma,
			'mesaj_id' => htmlspecialchars($mesaj_id)

		),[
			'columns' => 'mesaj_id'
		]);
	}

	public function ParaIadesiGetir()
	{
		$iadesor=$this->dbsql->qwSql("SELECT siparis.kullanici_id as k_id,siparis.kullanici_idsatici as ks_id,iade.*,siparis.* from iade INNER JOIN siparis ON iade.siparis_id=siparis.siparis_id",
			array(
				'iade.iade_turu' => 'Para İadesi'
			)
		);
		return $iadesor;

	}

	public function postbedenListele($beden)
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		$bedensor=$this->dbsql->wread("beden","alt_kategori_id",$beden,[
			"columns_name" => "beden_icerik",
			"columns_sort" => "ASC"
		]);
		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC))
		{
			$bedenlerim=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($bedenlerim);
		}
		
		return $bedenlist;
	}

	public function markapostArrayListele($kategori_id)
	{
		$arraylist=array();
		$markalist=new ArrayList($arraylist);
		$markasor=$this->dbsql->wread("marka","kategori_id",$kategori_id);
		while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) {

			$Markalar=$this->cons->Marka_ekle($markacek);
			$markalist->add($Markalar);
		}
		return $markalist;
	}

	public function AllRenkleriListele()
	{
		$arraylist=array();
		$renklist=new ArrayList($arraylist);
		$renksor=$this->dbsql->read("renkler");
		while($renkcek=$renksor->fetch(PDO::FETCH_ASSOC)) { 

			$renklerim=$this->cons->Renk_ekle($renkcek);
			$renklist->add($renklerim);
		}
		return $renklist;
	}

	public function renkPostIslem($kategori,$renkgelen)
	{
		if ($renkgelen=="Tüm Renkler" || $kategori=="Tüm Kategoriler")
		{
			$urunsor=$this->dbsql->read("urun");
		}
		else
		{
			$urunsor=$this->dbsql->wread("urun","renk_id",$renkgelen);
		}

		if ($renkgelen!="Tüm Renkler" and $kategori!="Tüm Kategoriler")
		{
			$urunsor=$this->dbsql->qwSql("SELECT * from urun",array('renk_id' => $renkgelen,
				'kategori_id' => $kategori
			));
		}
		else if ($renkgelen =="Tüm Renkler")
		{
			$urunsor=$this->dbsql->wread("urun","kategori_id",$kategori);
		}
		else if ($kategori =="Tüm Kategoriler")
		{
			$urunsor=$this->dbsql->wread("urun","renk_id",$renkgelen);
		}
		else
		{
			$urunsor=$this->dbsql->wread("urun","renk_id",$renkgelen);
		}
		return $urunsor;
	}

	public function SikayetGetir()
	{
		$sikayetsor=$this->dbsql->__qwSql("SELECT sikayet.*,kullanici.* FROM sikayet INNER JOIN kullanici ON sikayet.kullanici_id=kullanici.kullanici_id");
		return $sikayetsor;
	}

	public function SikayetDetay()
	{
		$sikayetsor=$this->dbsql->qwSql("SELECT sikayet.*,kullanici.* FROM sikayet INNER JOIN kullanici ON sikayet.kullanici_id=kullanici.kullanici_id",array(
			'sikayet_id' => htmlspecialchars($_GET['sikayet_id'])
		));
		$sikayetcek=$sikayetsor->fetch(PDO::FETCH_ASSOC);
		$sikayetler=$this->cons->Sikayet_ekle($sikayetcek);
		return $sikayetler;
	}

	public function SiparisGetir()
	{
		$siparissor=$this->dbsql->__qwSql("SELECT siparis_detay.kullanici_id as k_id,siparis_detay.kullanici_idsatici as ks_id,siparis.*,siparis_detay.*,kullanici.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id GROUP BY siparis_zaman,siparis.kullanici_id order by siparis_detay.urun_fiyat DESC");
		return $siparissor;
	}

	public function SiparisTotalGetir($kullanici_id,$siparis_zaman)
	{
		
		$siparistotalsor=$this->dbsql->qwSql("SELECT SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as tutar,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id INNER JOIN urun ON siparis_detay.urun_id=urun.urun_id",array(
			'siparis.kullanici_id' => htmlspecialchars($kullanici_id),
			'siparis.siparis_zaman' => htmlspecialchars($siparis_zaman),
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_detay.urun_fiyat",
			"columns_sort" => "DESC",
		]);
		return $siparistotalsor;
	}

	public function SiparisSilinmisGetir($kullanici_id,$siparis_zaman)
	{
		$siparistotalsilimissor=$this->dbsql->qwSql("SELECT SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as tutar,siparis.*,siparis_detay.*,kullanici.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id",array(
			'siparis.kullanici_id' => htmlspecialchars($kullanici_id),
			'siparis.siparis_zaman' => htmlspecialchars($siparis_zaman),
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_detay.urun_fiyat",
			"columns_sort" => "DESC",
		]);
		return $siparistotalsilimissor;
	}

	public function SiparisDetayGetir($kullanici_id,$siparis_zaman)
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id INNER JOIN urun ON siparis_detay.urun_id=urun.urun_id",array(
			'siparis.kullanici_id' => htmlspecialchars($kullanici_id),
			'siparis.siparis_zaman' => htmlspecialchars($siparis_zaman),
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_detay.urun_fiyat",
			"columns_sort" => "DESC",
		]);
		return $siparissor;
	}

	public function SiparisBedenListele($beden_id)
	{
		$bedensor=$this->dbsql->wread("beden","beden_id",htmlspecialchars($beden_id));
		$bedencek=$bedensor->fetch(PDO::FETCH_ASSOC);
		$bedenlerim=$this->cons->Beden_ekle($bedencek);
		return $bedenlerim;
	}

	public function AllSliderGetir()
	{
		$arraylist=array();
		$sliderlist=new ArrayList($arraylist);
		$slidersor=$this->dbsql->read("slider");
		while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { 

			$slider=$this->cons->Slider_ekle($slidercek);
			$sliderlist->add($renklerim);
		}
		return $sliderlist;
	}

	public function UrunListele($urun_id)
	{
		$arraylist=array();
		$urunlist=new ArrayList($arraylist);
		$urunsor=$this->dbsql->wread("urun","urun_id",htmlspecialchars($urun_id));
		while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { 

			$Urunlerim=$this->cons->Urun_ekle($uruncek);
			$urunlist->add($Urunlerim);
		}
		return $urunlist;
	}

	public function UrunFotoGetir()
	{
		$sorgu=$this->dbsql->read("urunfoto");
		return $sorgu;
	}

	public function UrunFotoListele($urun_id,$limit,$sayfada)
	{
		$arraylist=array();
		$urunfotolist=new ArrayList($arraylist);
		$urunfotosor=$this->dbsql->wread("urunfoto","urun_id",htmlspecialchars($urun_id),[
			"columns_name" => "urunfoto_id",
			"columns_sort" => "ASC",
			"limit" => $limit,$sayfada
		]);
		while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) {  

			$foto=$this->cons->Urunfoto_ekle($urunfotocek);
			$urunfotolist->add($foto);
		}
		return $urunfotolist;
	}

	public function PostUrunIslem($kategori)
	{
		if ($kategori=="Tüm Kategoriler")
		{
			$urunsor=$this->dbsql->read("urun",[
				"columns_name" => "urun_id",
				"columns_sort" => "DESC"
			]);
		}
		else
		{
			$urunsor=$this->dbsql->wread("urun","kategori_id",$kategori);
		} 
		return $urunsor;
	}

	public function UrunGetir()
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id order by urun_id DESC");
		return $urunsor;
	}

	public function yetkiListele($kullanici_id)
	{
		$arraylist=array();
		$yetkilist=new ArrayList($arraylist);
		$yetkisor=$this->dbsql->wread("yetki","kullanici_id",htmlspecialchars($kullanici_id));
		while($yetkicek=$yetkisor->fetch(PDO::FETCH_ASSOC)) {

			$yetkiler=$this->cons->Yetkiler_ekle($yetkicek);
			$yetkilist->add($yetkiler);
		}
		return $yetkilist;
	}

	public function yetkiDuzenle($yetki_id)
	{
		$yetkisor=$this->dbsql->wread("yetki","yetki_id",htmlspecialchars($yetki_id));
		$yetkicek=$yetkisor->fetch(PDO::FETCH_ASSOC);
		$yetkiler=$this->cons->Yetkiler_ekle($yetkicek);
		return $yetkiler;
	}

	public function yorumListele()
	{
		$arraylist=array();
		$yorumlist=new ArrayList($arraylist);
		$yorumsor=$this->dbsql->read("yorumlar",[
			"columns_name" => "yorum_onay",
			"columns_sort" => "ASC"
		]);
		while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

			$yorumlarim=$this->cons->Yorumlar_ekle($yorumcek);
			$yorumlist->add($yorumlarim);
		}
		return $yorumlist;
	}

	public function ozellikDetayGetir($urun_id)
	{
		$ozellikdetaysor=$this->dbsql->wread("ozellik_detay_icerik","urun_id",htmlspecialchars($urun_id));
		return $ozellikdetaysor;
	}

	public function urunozellikAllListeleme()
	{
		$urun_ozelliksor=$this->dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_GET['alt_kategori_detay_id']));
		return $urun_ozelliksor;
	}

	public function ozellikDetayAllListeleme($urun_ozellikcek)
	{
		$ozellik_detaysor=$this->dbsql->wread("ozellik_detay","urun_ozellikleri_id",$urun_ozellikcek['urun_ozellikleri_id']);
		return $ozellik_detaysor;
	}

	public function urunozelliklerilisteyap($ozellik_detay_id)
	{
		$arraylist=array();
		$detaylist=new ArrayList($arraylist);
		$özellidetaysor2=$this->dbsql->wread("ozellik_detay","ozellik_detay_id",$ozellik_detay_id);

		while($özellidetaycek2=$özellidetaysor2->fetch(PDO::FETCH_ASSOC)) {

			$ozellik_detaylarim=$this->cons->Ozellik_Detay_ekle($özellidetaycek2);


			$urun2sor=$this->dbsql->wread("urun_ozellikler","urun_ozellikleri_id",$ozellik_detaylarim->get_urun_ozellikleri_id());

			while($urun2cek=$urun2sor->fetch(PDO::FETCH_ASSOC)) {

				$urun_ozelliklerim=$this->cons->Urun_Ozellik_ekle($urun2cek);
				$ad=$urun_ozelliklerim->get_ozellik_adi();
				$urun_ozellikleri_id=$ozellik_detaylarim->get_urun_ozellikleri_id();

			}

			$detay= $ozellik_detaylarim->get_ozellik_detay();
			$detaylist->add($ad);
			$detaylist->add($detay);
			$detaylist->add($urun_ozellikleri_id);

		}
		return $detaylist;
	}

	public function urunOzellikDetayiçerikGetir()
	{
		$ozellikdetaysor=$this->dbsql->wread("ozellik_detay_icerik","ozellik_detay_icerik_id",htmlspecialchars($_GET['ozellik_detay_icerik_id']));
		$ozellikdetaycek=$ozellikdetaysor->fetch(PDO::FETCH_ASSOC);
		$ozellik_detay_icerik=$this->cons->Ozellik_Detay_Icerik_ekle($ozellikdetaycek);
		return $ozellik_detay_icerik;
	}

	public function urunozellikduzenleislem()
	{
		$arraylist=array();
		$urunozelliklist=new ArrayList($arraylist);
		$urun_ozelliksor=$this->dbsql->wread("urun_ozellikler","urun_ozellikleri_id",htmlspecialchars($_GET['urun_ozellikleri_id']));
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC)) {
			$value=array();
			$options=array();
			$urun_ozellik=$this->cons->Urun_Ozellik_ekle($urun_ozellikcek);
			$ozellik_detaysor=$this->dbsql->wread("ozellik_detay","urun_ozellikleri_id",$urun_ozellikcek['urun_ozellikleri_id']);
			while($ozellik_detaycek=$ozellik_detaysor->fetch(PDO::FETCH_ASSOC)) {
				$ozellik_detaylari=$this->cons->Ozellik_Detay_ekle($ozellik_detaycek);
				array_push($value,$ozellik_detaylari->get_ozellik_detay_id());
				array_push($options,$ozellik_detaylari->get_ozellik_detay());

			}
			$data=array($urun_ozellik->get_urun_ozellikleri_id(),$urun_ozellik->get_ozellik_adi());
			$urunozelliklist->add($options);
			$urunozelliklist->add($value);
			$urunozelliklist->add($data);
		}
		return $urunozelliklist;
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}
}
?>