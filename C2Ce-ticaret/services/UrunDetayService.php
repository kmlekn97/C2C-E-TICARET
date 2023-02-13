<?php
/**
 * 
 */
require_once 'ArrayList.php';
class UrunDetayService
{
	
	private $cons;
	private $dbsql;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
	}

	public function urunfotoListele($urun_id)
	{
		$arraylist=array();
		$urunfotolist=new ArrayList($arraylist);
		$urunfotosor=$this->dbsql->wread("urunfoto","urun_id",$urun_id);
		while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) 
		{
			$urun_fotolarim=$this->cons->Urunfoto_ekle($urunfotocek);
			$urunfotolist->add($urun_fotolarim);
		}
		return $urunfotolist;
	}

	public function benzerurunListele($alt_kategori_id)
	{
		$benzersor=$this->dbsql->__qwSql("SELECT urun.*,alt_kategori.*,kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and alt_kategori.alt_kategori_id=:alt_kategori_id group by renk_id,marka_id order by  rand() limit 10");
		$benzersor->execute(array(
			'urun_durum' => 1,
			'alt_kategori_id' => $alt_kategori_id

		));
		return $benzersor;
	}

	public function Renkleri_getir($renk_id=null)
	{
		$arraylist=array();
		$renklist=new ArrayList($arraylist);
		if ($renk_id==null)
		{
			$renksor=$this->dbsql->read("renkler");
		}
		else
		{
			$renksor=$this->dbsql->wread("renkler","renk_id",$renk_id);
		}
		while($renkcek=$renksor->fetch(PDO::FETCH_ASSOC)) { 
			$renklerim=$this->cons->Renk_ekle($renkcek);
			$renklist->add($renklerim);
		}
		return $renklist;
	}

	public function urunozellikgetir($urun_id)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ozellikleri_id' => 7,
			'urun.urun_id' => $urun_id     

		));
		return $urunadsor;

	}

	public function Markalari_getir($marka_id=null)
	{
		$arraylist=array();
		$markalist=new ArrayList($arraylist);
		if ($marka_id==null)
		{
			$markasor=$this->dbsql->read("marka");
		}
		else
		{
			$markasor=$this->dbsql->wread("marka","marka_id",$marka_id);
		}
		while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) { 
			$markalarim=$this->cons->Marka_ekle($markacek);
			$markalist->add($markalarim);
		}
		return $markalist;
	}

	public function bedenlisteleme($beden_id=null)
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		if ($beden_id==null)
		{
			$bedensor=$this->dbsql->read("beden");
		}
		else
		{
			$bedensor=$this->dbsql->wread("beden","beden_id",$beden_id);
		}
		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) {

			$bedenlerim=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($bedenlerim);

		}
		return $bedenlist;
	}

	public function yorumgetir()
	{
		$yorumsor=$this->dbsql->qwSql("SELECT yorumlar.*,kullanici.* FROM yorumlar INNER JOIN kullanici ON yorumlar.kullanici_id=kullanici.kullanici_id",array(
			'urun_id' => htmlspecialchars($_GET['urun_id'])
		),[
			"columns_name" => "yorum_zaman",
			"columns_sort" => "DESC"
		]);
		return $yorumsor;
	}

	public function ozellikleriListele()
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun.urun_id' => htmlspecialchars($_GET['urun_id'])

		));
		return $urunadsor;
	}

	public function Urunozelliklistele($urun_ozellikleri_id)
	{
		$arraylist=array();
		$ozelliklist=new ArrayList($arraylist);
		$urunozelliksor=$this->dbsql->wread("urun_ozellikler","urun_ozellikleri_id",$urun_ozellikleri_id);
		$urunozellikcek=$urunozelliksor->fetch(PDO::FETCH_ASSOC); 	
		$urunozelliklerim=$this->cons->Urun_Ozellik_ekle($urunozellikcek);
		$ozelliklist->add($urunozelliklerim);
		return $ozelliklist;
	}

	public function PuanHesapla($urun_id)
	{
		$arraylist=array();
		$puanlist=new ArrayList($arraylist);
		$puansay=$this->dbsql->qwSql("SELECT COUNT(yorumlar.yorum_puan) as say, SUM(yorumlar.yorum_puan) as topla, yorumlar.*,urun.* FROM yorumlar INNER JOIN urun ON yorumlar.urun_id=urun.urun_id",array(
			'urun.urun_id' => $urun_id
		));

		while($puancek=$puansay->fetch(PDO::FETCH_ASSOC))
		{
			$yorum_adet=$puancek['say'];
			$deger=round(($puancek['topla']/ $puancek['say']),1);
			$puan=floor($deger);
			$puanlist->add($yorum_adet);
			$puanlist->add($deger);
			$puanlist->add($puan);
		}
		return $puanlist;
	}

	public function karsilatirListele()
	{
		if (isset($_SESSION['userkullanici_id']))
		{
			$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
				'karsilastir.kullanici_id' => $_SESSION['userkullanici_id']));
			if (isset($_COOKIE['karsilastir']))
			{
				$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
					'karsilastir.kullanici_id' => $_COOKIE['karsilastir']));
			}
			else
			{
				$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
					'urun_id' => htmlspecialchars($_GET['urun_id']),
					'urun_durum' => 1
				));
			}
		}
		else
		{
			if (isset($_COOKIE['karsilastir']))
			{
				$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
					'karsilastir.kullanici_id' => $_COOKIE['karsilastir']));
			}
			else
			{
				$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
					'urun_id' => htmlspecialchars($_GET['urun_id']),
					'urun_durum' => 1
				));
			}
		}
		return $karsilastirsor;
	}

	public function urunadagoreListele($urun_ad)
	{
		$renklerigetirsor=$this->dbsql->wread("urun","urun_ad",$urun_ad);
		return $renklerigetirsor;
	}

	public function renkpanelgetirme($kategorigetircek,$barkod_no,$urun_ad)
	{
		if ($kategorigetircek==4)
		{
			$renklerigetirsor=$this->dbsql->__qwSql("SELECT * FROM urun where urun_ad=:urun_ad and barkod_no=:barkod_no group by renk_id");
			$renklerigetirsor->execute(array('urun_ad' => $urunlerim->get_urun_ad(),
				'barkod_no' => $barkod_no
			));
		}

		$renklerigetirsor=$this->dbsql->__qwSql("SELECT * FROM urun where urun_ad=:urun_ad group by renk_id");
		$renklerigetirsor->execute(array('urun_ad' => $urun_ad
	));
		return $renklerigetirsor;
	}

	public function renkegorebedengetir($renk_id)
	{
		$bedensor=$this->dbsql->qwSql("SELECT urun.*,beden.*,renkler.* FROM urun INNER JOIN beden ON urun.beden_id=beden.beden_id  INNER JOIN renkler ON urun.renk_id=renkler.renk_id",array(
			'urun.renk_id' => $renk_id
		));
		return $bedensor;
	}

	public function altkategoriyegorebedengetir($renk_id,$alt_kategori_id)
	{
		$bedensor=$this->dbsql->__qwSql("SELECT urun.*,beden.*,renkler.* FROM urun INNER JOIN beden ON urun.beden_id=beden.beden_id  INNER JOIN renkler ON urun.renk_id=renkler.renk_id where urun.renk_id=:renk_id and beden.alt_kategori_id=:alt_kategori_id GROUP BY urun.beden_id");
		$bedensor->execute(array(
			'renk_id' => $renk_id,
			'alt_kategori_id' => $alt_kategori_id
		));
		return $bedensor;
	}

	public function SatisAdetHesapla($urun_id)
	{
		$urunsay=$this->dbsql->__qwSql("SELECT COUNT(urun_id) as say FROM siparis_detay where urun_id=:id");
		$urunsay->execute(array(
			'id' => $urun_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function SaticiPuanHesapla($kullanici_id)
	{
		$saticipuansay=$this->dbsql->qwSql("SELECT COUNT(yorumlar.yorum_puan) as say, SUM(yorumlar.yorum_puan) as topla, yorumlar.*,urun.* FROM yorumlar INNER JOIN urun ON yorumlar.urun_id=urun.urun_id",array(
			'urun.kullanici_id' => $kullanici_id
		));

		$saticipuancek=$saticipuansay->fetch(PDO::FETCH_ASSOC);

		$spuan=round(($saticipuancek['topla']/ $saticipuancek['say']),1);
		return $spuan;
	}

	public function SaticitotalsatisHesapla($kullanici_id)
	{
		$urunsay=$this->dbsql->__qwSql("SELECT COUNT(kullanici_idsatici) as say FROM siparis_detay where kullanici_idsatici=:id");
		$urunsay->execute(array(
			'id' => $kullanici_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek;
	}

	public function digersaticilarigetir($urun_ad,$kategori_id,$renk_id,$beden_id,$marka_id)
	{
		$urundigersaticisor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_ad' => $urun_ad,
			'kategori_id' => $kategori_id,
			'renk_id' => $renk_id,
			'beden_id' => $beden_id,
			'marka_id' => $marka_id,
			'urun_durum' => 1
		));
		return $urundigersaticisor;
	}

	public function urundetayurunListele()
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_id' => htmlspecialchars($_GET['urun_id']),
			'urun_durum' => 1
		));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
	}

	public function urunfotogetir($urun_id)
	{
		$urunfotosor=$this->dbsql->wread("urunfoto","urun_id",$urun_id);
		$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
	}

	public function urundetayadlistele($urun_ad)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun.urun_ad' => $urun_ad,
			'urun_ozellikleri_id' => 7,
			'urun.urun_id' => htmlspecialchars($_GET['urun_id'])

		));
		return $urunadsor;
	}

	public function kapasiteozellikgetir($urun_ad,$renk_id)
	{
		$ozelliksor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ad' => $urun_ad,
			'urun_ozellikleri_id' => 7,
			'urun.renk_id' => $renk_id
		),[
			"columns_name" => "ozellik_detay.ozellik_detay",
			"columns_sort" => "ASC"
		]);
		return $ozelliksor;
	}

	public function ozelligegoreurunListele($urun_ad,$renk_id)
	{
		$kategorigetirsor=$this->dbsql->qwSql("SELECT * FROM urun",array('urun_ad' => $urun_ad,
			'renk_id' => $renk_id
		));
		return $kategorigetirsor;
	}

	public function urundetayozellikgroupListele($urun_ad,$renk_id)
	{
		$urunadsor=$this->dbsql->__qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id WHERE urun_ad=:urun_ad AND urun_ozellikleri_id=:urun_ozellikleri_id AND urun.renk_id=:renk_id group by ozellik_detay_icerik.ozellik_detay_id order by ozellik_detay.ozellik_detay ASC");
		$urunadsor->execute(array(
			'urun_ad' => $urun_ad,
			'urun_ozellikleri_id' => 7,
			'renk_id' => $renk_id
		));
		return $urunadsor;
	}

	public function typeurunyorumtype($type)
	{
		$path="img/yorumtype/$type";
		if ($type=="olumlu")
		{
			?>
			<div>
				<img width="24px" src="<?php echo $path.".jpg" ?>">

			</div>
			<?php
		}
		else if ($type=="olumsuz")
		{
				?>
			<div>
				<img width="24px" src="<?php echo $path.".png" ?>">

			</div>
			<?php
		}
		else
		{
				?>
			<div>
				<img width="24px" src="<?php echo $path.".jpg" ?>">

			</div>
			<?php
		}
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}
}
?>