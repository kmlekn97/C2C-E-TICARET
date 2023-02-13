<?php
/**
 * 
 */
require_once 'ArrayList.php';
class DBService
{

	private $cons;
	private $dbsql;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
	}

	public function AltKategoriDetayListelemetekil()
	{
		$kategorisor=$this->dbsql->qwSql("SELECT urun.*,alt_kategori_detay.*,kullanici.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_durum' => 1,
			'urun.alt_kategori_detay_id' => htmlspecialchars($_GET['alt_kategori_detay_id'])
		));
		$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
		$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
		return $kategorilerim;
	}

	public function Urunozelliklistele()
	{
		$arraylist=array();
		$ozelliklist=new ArrayList($arraylist);
		$urun_ozelliksor=$this->dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_GET['alt_kategori_detay_id']));
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC)) 
		{
			$urunozelliklerim=$this->cons->Urun_Ozellik_ekle($urun_ozellikcek);
			$ozelliklist->add($urunozelliklerim);
		}
		return $ozelliklist;
	}

	public function Urunozellikdetaylistele($urun_ozellikleri_id)
	{
		$arraylist=array();
		$ozelliklist=new ArrayList($arraylist);
		$urun_ozelliksor=$this->dbsql->wread("ozellik_detay","urun_ozellikleri_id",$urun_ozellikleri_id);
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC)) 
		{
			$urunozelliklerim=$this->cons->Ozellik_Detay_ekle($urun_ozellikcek);
			$ozelliklist->add($urunozelliklerim);
		}
		return $ozelliklist;
	}

	public function PacinationAltKategoriDetay($where)
	{
		$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori_detay.*,kullanici.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun.urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay_id $where GROUP BY barkod_no,renk_id");
		$sorgu->execute(array(
			'alt_kategori_detay_id' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		return $sorgu;
	}

	public function PacinationAltKategori($where)
	{
		$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun.urun_durum=1 and alt_kategori.alt_kategori_id=:alt_kategori_id $where GROUP BY barkod_no,renk_id");
		$sorgu->execute(array(
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])));
		return $sorgu;
	}

	public function PacinationKategori($where)
	{
		$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id $where");
		$sorgu->execute(array(
			'urun_durum' => 1,
			'kategori_id' => htmlspecialchars($_GET['kategori_id'])
		));
		return $sorgu;
	}

	public function pagealtkategoridetayadet($order,$where="",$durum="")
	{
		if ($durum=="")
		{
			$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori_detay.*,kullanici.*,ozellik_detay_icerik.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id WHERE urun.urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay $where $order");
			$sorgu->execute(array(
				'alt_kategori_detay' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		}
		else
		{
			$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori_detay.*,kullanici.*,ozellik_detay_icerik.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id WHERE urun.urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay and $where $order");
			$sorgu->execute(array(
				'alt_kategori_detay' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		}
		
		$say=$sorgu->rowCount();
		return $say;
	}

	public function pagealtkategoridetaycoksatanadet($order,$where="",$durum="")
	{
		if ($durum=="")
		{
			$sorgu=$this->dbsql->__qwsql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.*,ozellik_detay_icerik.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE urun.urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay $where $order");
			$sorgu->execute(array(
				'alt_kategori_detay' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		}
		else
		{
			$sorgu=$this->dbsql->__qwsql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.*,ozellik_detay_icerik.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE urun.urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay and $where $order");
			$sorgu->execute(array(
				'alt_kategori_detay' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		}
		
		$say=$sorgu->rowCount();
		return $say;
	}

	public function pagealtkategoriadet($where="",$durum="")
	{
		if ($durum=="")
		{
			$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun.urun_durum=1 and alt_kategori.alt_kategori_id=:alt_kategori_id $where");
			$sorgu->execute(array(
				'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])));
		}
		else
		{
			$sorgu=$this->dbsql->__qwsql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun.urun_durum=1 and alt_kategori.alt_kategori_id=:alt_kategori_id and $where");
			$sorgu->execute(array(
				'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])));
		}
		
		$say=$sorgu->rowCount();
		return $say;
	}

	public function pagealtkategoricoksatanadet($where="",$durum="")
	{
		if ($durum=="")
		{
			$sorgu=$this->dbsql->__qwsql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE urun.urun_durum=1 and alt_kategori.alt_kategori_id=:alt_kategori_id $where");
			$sorgu->execute(array(
				'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])));
		}
		else
		{
			$sorgu=$this->dbsql->__qwsql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE urun.urun_durum=1 and alt_kategori.alt_kategori_id=:alt_kategori_id and $where");
			$sorgu->execute(array(
				'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])));
		}
		
		$say=$sorgu->rowCount();
		return $say;
	}


	public function pagekategoriadet($where="")
	{
		$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id $where");
		$sorgu->execute(array(
			'urun_durum' => 1,
			'kategori_id' => htmlspecialchars($_GET['kategori_id'])
		));
		$say=$sorgu->rowCount();
		return $say;
	}

	public function pagearamaadet($searchkeyword,$sira,$where="",$durum="")
	{
		if ($durum=="")
		{
			$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE (urun_durum=:urun_durum) and (urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%') GROUP BY barkod_no,renk_id");
			$sorgu->execute(array(
				'urun_durum' => 1

			));
		}
		else
		{
			$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE (urun_durum=:urun_durum) and ($where) and (urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%') GROUP BY barkod_no,renk_id");
			$sorgu->execute(array(
				'urun_durum' => 1

			));
		}
		$say=$sorgu->rowCount();
		return $say;
	}

	public function PacinationArama($searchkeyword)
	{
		$kategori=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%' GROUP BY barkod_no,renk_id order by urun_zaman");
		$kategori->execute(array(
			'urun_durum' => 1

		));
		return $kategori;
	}



	public function AltKategoriDetaySorguAdd()
	{
		return " and urun.urun_id=ozellik_detay_icerik.urun_id";
	}

	public function OzellikOrder()
	{
		//$order="";
		if (htmlspecialchars(isset($_GET['siralama'])))
		{
			if (htmlspecialchars($_GET['siralama'])=="ASC") {
				$order =' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat ASC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="DESC") {
				$order =' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat DESC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="yeni") {
				$order =' GROUP BY barkod_no,renk_id ORDER BY urun.urun_zaman DESC';
			}
			else 
			{
				$order=" GROUP BY barkod_no,renk_id order by urunsay DESC ";

			}   
		}
		else
		{
			$order =' GROUP BY barkod_no,renk_id order by urun.urun_zaman DESC ';
		}
		return $order;
	}

	public function AltKategoridetaytumUrunlerilistele($ozellikgroup,$where,$order,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.*,ozellik_detay_icerik.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE $where GROUP BY ozellik_detay_icerik.urun_id,urun.barkod_no,urun.renk_id,ozellik_detay_icerik.urun_id HAVING COUNT( ozellik_detay_icerik.urun_id) > $ozellikgroup limit $limit,$sayfada");
		return $urunsor;
	}

	public function SiralamaSorguelektronik($where)
	{
		if (htmlspecialchars(isset($_GET['siralama'])))
		{
			if (htmlspecialchars($_GET['siralama'])=="ASC") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat ASC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="DESC") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat DESC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="yeni") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_zaman DESC';
			}
			else 
			{
				$where.=" GROUP BY barkod_no,renk_id order by urunsay DESC";

			}   
		}
		else
		{
			$where .=' GROUP BY barkod_no,renk_id order by urun.urun_zaman DESC ';
		}
		return $where;
	}

	public function SiralamaSorgu($where)
	{
		if (htmlspecialchars(isset($_GET['siralama'])))
		{
			if (htmlspecialchars($_GET['siralama'])=="ASC") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat ASC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="DESC") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_fiyat DESC ';
			}
			else if (htmlspecialchars($_GET['siralama'])=="yeni") {
				$where .=' GROUP BY barkod_no,renk_id ORDER BY urun.urun_zaman DESC';
			}
			else 
			{
				$where.=" GROUP BY barkod_no,renk_id order by urunsay DESC";

			}   
		}
		else
		{
			$where .=' GROUP BY barkod_no,renk_id order by urun.urun_zaman DESC ';
		}
		return $where;
	}


	public function GenelSorgulualtkategoridetay($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE $where limit $limit,$sayfada");
		return $urunsor;
	}

	public function altkategoridetayurundurumsifir($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,alt_kategori_detay.*,kullanici.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE $where limit $limit,$sayfada");
		return $urunsor;
	}

	public function altkategorilimit($where,$sayfada,$limit)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE urun_durum=1 and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay_id GROUP BY barkod_no,renk_id order by urunsay limit $limit,$sayfada");
		$urunsor->execute(array(
			'alt_kategori_detay_id' => htmlspecialchars($_GET['alt_kategori_detay_id'])));
		return $urunsor;
	}

	public function altkategorilimitCokSatanMiktar($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori_detay.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE $where limit $limit,$sayfada");
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek['urunsay'];
	}


	public function altkategorilimitkosullu($where,$sayfada,$limit)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,alt_kategori_detay.*,kullanici.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and alt_kategori_detay.alt_kategori_detay_id=:alt_kategori_detay_id $where limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'alt_kategori_detay_id' => htmlspecialchars($_GET['alt_kategori_detay_id'])
		));
		return $urunsor;
	}

	public function altkategorilimitkosullucoksatan($where,$sayfada,$limit)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.urun_ad,urun.urun_id,urun.urun_fiyat,urun.urunfoto_resimyol,urun.alt_kategori_detay_id,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,urun.urun_zaman,alt_kategori_detay.alt_kategori_detay_ad,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and urun_onecikar=:urun_onecikar GROUP BY barkod_no,renk_id order by urun_zaman DESC limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'urun_onecikar' => 1
		));
		return $urunsor;
	}

	public function AltKategoriListelemetekil()
	{
		$kategorisor=$this->dbsql->qwsql("SELECT urun.*,alt_kategori.*,kullanici.*,kategori.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_durum' => 1,
			'urun.alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])
		));
		$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);
		$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
		return $kategorilerim;
	}

	public function Altkategoricoksatan($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE $where limit $limit,$sayfada");
		$urunsor->execute();
		return $urunsor;
	}

	public function AltKategoriSorguluurunListeleme($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE $where limit $limit,$sayfada");
		$urunsor->execute();
		return $urunsor;
	}

	public function Altkategoricoksatanlimitli($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,alt_kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE urun_durum=:urun_durum and alt_kategori.alt_kategori_id=:alt_kategori_id $where limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])
		));
		return $urunsor;
	}
	public function AltkategoriGenelurunListeleme($where,$sayfada,$limit)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and alt_kategori.alt_kategori_id=:alt_kategori_id $where limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])
		));
		return $urunsor;
	}

	public function AltkategoriGenelurunlistelesorgusuz($sayfada,$limit)
	{
		$urunsor=$dbsql->__qwSql("SELECT urun.urun_ad,urun.urun_id,urun.urun_fiyat,urun.urunfoto_resimyol,urun.alt_kategori_id,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,urun.urun_zaman,alt_kategori.alt_kategori_ad,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and urun_onecikar=:urun_onecikar GROUP BY barkod_no,renk_id order by urun_zaman DESC limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'urun_onecikar' => 1
		));
		return $urunsor;

	}

	public function aramaListelemetekil($searchkeyword)
	{
		$kategori=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%' GROUP BY barkod_no,renk_id order by urun_zaman");
		$kategori->execute(array(
			'urun_durum' => 1

		));
		$kategoricek=$kategori->fetch(PDO::FETCH_ASSOC);
		$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
		return $kategorilerim;
	}

	public function aramacoksatan($searchkeyword,$sira,$sayfada,$limit)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,kategori.*,kullanici.*,marka.*,siparis_detay.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE urun_durum=:urun_durum and urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%'GROUP BY siparis_detay.urun_id order by urunsay DESC limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1
		));
		return $urunsor;
	}

	public function SorguAramam($searchkeyword,$sira)
	{
		if ($sira !=null)
		{
			$wherearama="urun.urun_ad LIKE '%$searchkeyword%' OR marka.marka_adi LIKE '%$searchkeyword%' OR kategori.kategori_ad LIKE '%$searchkeyword%' $sira";
		}
		else
		{
			$wherearama="urun.urun_ad LIKE '%$searchkeyword%' OR marka.marka_adi LIKE '%$searchkeyword%' OR kategori.kategori_ad LIKE '%$searchkeyword%'";
		}
		return $wherearama;
	}

	public function siraliaramasorgu($wherearama,$limit,$sayfada)
	{
		$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,marka.* FROM urun INNER JOIN kategori ON kategori.kategori_id=urun.kategori_id INNER JOIN marka ON marka.marka_id=urun.marka_id where $wherearama limit $limit,$sayfada");
		return $sorgu;
	}

	public function siraliaramasorgugroupby($wherearama,$limit,$sayfada)
	{
		$sorgu=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,marka.* FROM urun INNER JOIN kategori ON kategori.kategori_id=urun.kategori_id INNER JOIN marka ON marka.marka_id=urun.marka_id  where $wherearama GROUP BY barkod_no,renk_id limit $limit,$sayfada");
		return $sorgu;
	}

	public function siraliaramaurunlistesi($searchkeyword,$sira,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%' $sira limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1

		));
		return $urunsor;
	}

	public function siraliaramasorgulucoksatan($where,$searchkeyword,$sira,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,kategori.*,kullanici.*,marka.*,siparis_detay.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE (urun_durum=:urun_durum) and ($where) and (urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%') $sira limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1

		));
		return $urunsor;
	}

	public function aramakosulluurunlisteleme($searchkeyword,$sira,$where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE (urun_durum=:urun_durum) and ($where) and (urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%') $sira limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1

		));
		return $urunsor;
	}

	public function aramakosulsuzsiraliurunlistelemegroupby($searchkeyword,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%' GROUP BY barkod_no,renk_id order by urun_zaman limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1

		));
		return $urunsor;
	}

	public function uruncek($urunsor)
	{
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
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

	public function urunadsorliste($urun_id)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ozellikleri_id' => 7,
			'urun.urun_id' => $urun_id

		));
		return $urunadsor;
	}

	public function urunadsoradlilistele($urun_id,$urun_ad)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ad' => $urun_ad,
			'urun_ozellikleri_id' => 7,
			'urun.urun_id' => $urun_id

		));
		return $urunadsor;
	}

	public function urunadcek($urunadsor)
	{
		$urunadcek=$urunadsor->fetch(PDO::FETCH_ASSOC);
		return $urunadcek;
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

	public function SatisAdetHesapla($urun_id)
	{
		$urunsay=$this->dbsql->__qwSql("SELECT COUNT(urun_id) as say FROM siparis_detay where urun_id=:id");
		$urunsay->execute(array(
			'id' => $urun_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function magazabilgi($urun_id)
	{
		$magazasor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici on urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_id' => $urun_id
		));
		$magazacek=$magazasor->fetch(PDO::FETCH_ASSOC);
		$mkullanici=$this->cons->Kullanici_ekle($magazacek);
		return $mkullanici;
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
			if (is_nan($yorum_adet)){
				$yorum_adet=0;
			}
			if (is_nan($deger)){
				$deger=0;
			}
			if (is_nan($puan)){
				$puan=0;
			}
			$puanlist->add($yorum_adet);
			$puanlist->add($deger);
			$puanlist->add($puan);
		}
		return $puanlist;
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

	public function kategorilisteleme()
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorisor=$this->dbsql->read("kategori",[
			"columns_name" => "kategori_sira",
			"columns_sort" => "ASC"
		]);

		while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
			$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
			$kategorilist->add($kategorilerim);		
		}
		return $kategorilist;
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

	public function bedenlistelemepost($beden)
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		$bedensor=$this->dbsql->wread("beden","alt_kategori_id",$beden,[
			"columns_name" => "beden_icerik",
			"columns_sort" => "ASC"
		]);
		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) {

			$bedenlerim=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($bedenlerim);

		}
		return $bedenlist;
	}
	public function markapostListele($marka)
	{
		$arraylist=array();
		$markalist=new ArrayList($arraylist);
		$markasor=$this->dbsql->wread("marka","marka.kategori_id",$marka);	
		while($markacek=$markasor->fetch(PDO::FETCH_ASSOC))
		{

			$markalarim=$this->cons->Marka_ekle($markacek);

			if($adet==0)
			{
				$markalist->add('<option>'."Bir Marka Seçiniz...".'</option>');
				$adet++;
			}
			if ($markalarim->get_alt_kategori_id()==0)
			{
				$kategorisor=$this->dbsql->wread("kategori","kategori_id",$markalarim->get_kategori_id());
				while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

					$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
					$kategori=$kategorilerim->get_kategori_ad();
				}
			}
			else
			{
				$kategorisor=$this->dbsql->wread("alt_kategori","alt_kategori_id",$markacek['alt_kategori_id']);
				while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

					$alt_kategorilerim=$this->cons->Alt_kategori_ekle($kategoricek);

					$kategori=$alt_kategorilerim->get_alt_kategori_ad();
				}
			}
			$markalist->add('<option value="'.$markalarim->get_marka_id().'">'.$markalarim->get_marka_adi()." (".$kategori.")".'</option>');
		}
		return $markalist;
	}

	public function postaltkategoriListeleme($kategori)
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori","kategori_id",$kategori,[
			"columns_name" => "alt_kategori_sira",
			"columns_sort" => "ASC"
		]);
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC))
		{  		
			$altkategorilerim=$this->cons->Alt_kategori_ekle($kategorialtcek);
			$kategorilist->add('<option value="'.$altkategorilerim->get_alt_kategori_id().'">'.$altkategorilerim->get_alt_kategori_ad().'</option>');
		}      
		return $kategorilist;
	}

	public function postaltkategoridetayListeleme($altkategori)
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorialtdetaysor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_id",$altkategori,[
			"columns_name" => "alt_kategori_detay_sira",
			"columns_sort" => "ASC"
		]);
		while($kategorialtdetaycek=$kategorialtdetaysor->fetch(PDO::FETCH_ASSOC))
		{  		
			$altkategoridetaylarim=$this->cons->Alt_kategori_detay_ekle($kategorialtdetaycek,$kategorialtdetaycek);
			$kategorilist->add('<option value="'.$altkategoridetaylarim->get_alt_kategori_detay_id().'">'.$altkategoridetaylarim->get_alt_kategori_detay_ad().'</option>');
		}      
		return $kategorilist;
	}

	public function carturunlistele($kullanici_id)
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(

			'sepet.kullanici_id' =>  $kullanici_id
		));
		return $urunsor;
	}

	public function urunlistecoksatan($kategori_id=null)
	{
		if ($kategori_id==null)
		{
			$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay, urun.*,kategori.*,kullanici.*,siparis_detay.siparis_id FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id where urun_durum=:durum GROUP BY siparis_detay.urun_id order by urunsay DESC limit 10");
			$urunsor->execute(array(

				'durum' => 1
			));
		}
		else
		{
			$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay, urun.*,kategori.*,kullanici.*,siparis_detay.siparis_id FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id where urun_durum=:durum and kategori.kategori_id=:kategori_id GROUP BY siparis_detay.urun_id order by urunsay DESC limit 10");
			$urunsor->execute(array(

				'durum' => 1,
				'kategori_id' => $kategori_id,

			));
		}
		return $urunsor;
	}

	public function FavoriListeleme()
	{
		$arraylist=array();
		$favorilist=new ArrayList($arraylist);
		$favorilistele=$this->dbsql->qwSql("SELECT favoriler.*,urun.*,marka.*,renkler.*,favoriler.kullanici_id as id FROM urun INNER JOIN favoriler ON urun.urun_id=favoriler.urun_id INNER JOIN marka ON urun.marka_id=marka.marka_id INNER JOIN renkler ON urun.renk_id=renkler.renk_id",array(
			'favoriler.kullanici_id' => $_SESSION['userkullanici_id']
		));
		while($uruncek=$favorilistele->fetch(PDO::FETCH_ASSOC)) {

			$urunlerim=$this->cons->Urun_ekle($uruncek);
			$favorilist->add($urunlerim);

		}
		return $favorilist;
	}

	public function mesajgelenlistele()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(

			'mesaj.kullanici_gel' => $_SESSION['userkullanici_id'],
			'mesaj.aciklama' => 'alici'

		),[
			"columns_name" => "mesaj_okunma,mesaj_zaman",
			"columns_sort" => "DESC"
		]);
		return $mesajsor;
	}

	public function mesajgidenlistele()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id",array(

			'mesaj.kullanici_gon' => $_SESSION['userkullanici_id'],
			'mesaj.aciklama' => 'gonderen'

		),[
			"columns_name" => "mesaj_okunma,mesaj_zaman",
			"columns_sort" => "DESC"
		]);
		return $mesajsor;
	}

	public function mesajdetayListesi()
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(
			'kullanici.kullanici_id' => htmlspecialchars($_GET['kullanici_gon']),
			'mesaj.mesaj_id' => htmlspecialchars($_GET['mesaj_id'])
		),[
			"columns_name" => "mesaj_zaman",
			"columns_sort" => "DESC"
		]);

		$mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC);
		return $mesajcek;
	}

	public function mesajdurumdegistir()
	{
		$mesajguncelle=$this->dbsql->update("mesaj",array(

			'mesaj_okunma' => 1,
			'mesaj_id' => htmlspecialchars($_GET['mesaj_id'])

		),[
			'columns' => 'mesaj_id'
		]);
	}

	public function kullanicilistesiMesaj()
	{
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_id",htmlspecialchars($_GET['kullanici_gel']));
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
		return $kullanicilarim;
	}

	public function tumkullaniciListesiOlustur()
	{
		$kullanicisor=$this->dbsql->read("kullanici");
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
		return $kullanicilarim;
	}

	public function hakkimizdaListele()
	{
		$hakkimizdasor=$this->dbsql->wread("hakkimizda","hakkimizda_id",0);
		$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);
		$hakkimizda_data=$this->cons->Hakkimizda_ekle($hakkimizdacek);
		return $hakkimizda_data;
	}

	public function IadeListeleme()
	{
		$siparissor=$this->dbsql->qwSql("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.*,iade.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN iade ON iade.siparis_id=siparis.siparis_id",array(
			'siparis.siparis_id' => htmlspecialchars($_GET['siparis_id'])
		));
		return $siparissor;
	}

	public function SiparisListeleme()
	{
		$siparissor=$this->dbsql->qwSql("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici",array(
			'siparis.siparis_id' => htmlspecialchars($_GET['siparis_id'])
		));
		return $siparissor;
	}

	public function Iade_durum()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis.kullanici_id as k_id,siparis.kullanici_idsatici as ks_id,urun.*,kullanici.*,siparis.*,siparis_detay.*,iade.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN iade ON iade.siparis_id=siparis.siparis_id",array(
			'siparis_detay.kullanici_id' => $_SESSION['userkullanici_id']
		));
		return $siparissor;
	}

	public function istatistiksiparisListele()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis_detay.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis_detay 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
				'siparis_detay.kullanici_idsatici' => $_SESSION['userkullanici_id'],
				'siparis_detay.iade_et' => 0

			),[
				"columns_name" => "siparis_detay.siparisdetay_kargozaman",
				"columns_sort" => "DESC"
			]);
		return $siparissor;
	}

	public function vitrinUrunListeleme()
	{
		$urunsor=$this->dbsql->qwSql("SELECT  urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_onecikar' => 1,
			'urun_durum' => 1
		),[
			"columns_name" => "vitrin_tarih",
			"columns_sort" => "DESC",
			"limit" => 8
		]);
		return $urunsor;
	}

	public function KategoriOneCikanlar($kategori_id,$islem)
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(

			'urun_onecikar' => 1,
			'urun_durum' => 1,
			'urun.kategori_id' => $kategori_id

		),[
			"columns_name" => "urun.vitrin_tarih",
			"columns_sort" => "DESC"
		]);

		while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { 

			$islem->kategori_onecikanlar($uruncek);


		}
	}

	public function KampanyaListele()
	{
		$kampanyasor=$this->dbsql->__qwSql("SELECT *,kampanyabitis_tarihi-now() as bitis from kampanya where kampanyabitis_tarihi-now()> 0 and kampanya_id=:kampanya_id");
		$kampanyasor->execute(array(
			'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
		));

		$kampanyacek=$kampanyasor->fetch(PDO::FETCH_ASSOC);
		$kampanyalarim=$this->cons->Kampanya_ekle($kampanyacek);
		return $kampanyalarim;
	}

	public function kampanyalistesor()
	{
		$kampanyasor=$this->dbsql->__qwSql("SELECT *,kampanyabitis_tarihi-now() as bitis from kampanya where kampanyabitis_tarihi-now()> 0");
		return $kampanyasor;
	}

	public function tumKampanyalariListele()
	{
		$arraylist=array();
		$kampanyalist=new ArrayList($arraylist);
		$kampanyasor=$this->dbsql->__qwSql("SELECT *,kampanyabitis_tarihi-now() as bitis from kampanya where kampanyabitis_tarihi-now()> 0");
		while($kampanyacek=$kampanyasor->fetch(PDO::FETCH_ASSOC)) {

			$kampanyalarim=$this->cons->Kampanya_ekle($kampanyacek);
			$kampanyalist->add($kampanyalarim);
		}
		return $kampanyalist;

	}

	public function KampanyaOnayDurumCek($kampanya_id=0)
	{
		$arraylist=array();
		$kampanyalist=new ArrayList($arraylist);
		if ($kampanya_id==0)
		{
			$urunsor=$this->dbsql->wread("urun","kullanici_id",$_SESSION['userkullanici_id'],[
				"columns_name" => "urun_zaman",
				"columns_sort" => "DESC"
			]);

		}

		else
		{
			$urunsor=$this->dbsql->qwSql("SELECT * FROM urun",array(
				'kullanici_id' => $_SESSION['userkullanici_id'],
				'kategori_id' => $kampanya_id
			),[
				"columns_name" => "urun_zaman",
				"columns_sort" => "DESC"
			]);
		}

		while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {

			$urunlerim=$this->cons->Urun_ekle($uruncek);
			$kampanyalist->add($urunlerim);
		}
		return $kampanyalist;
	}

	public function KampanyaDetayListele($urun_id)
	{
		$kampanyadetaysor=$this->dbsql->qwSql("SELECT * from kampanya_detay",array(
			'urun_id' => $urun_id,
			'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
		));

		$kampanyadetaycek=$kampanyadetaysor->fetch(PDO::FETCH_ASSOC);
		$kampanya_detaylarim=$this->cons->Kampanya_Detaylarim_ekle($kampanyadetaycek);
		return $kampanya_detaylarim;
	}

	public function kampanyaKategoriListele($kategori_id)
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorisor=$this->dbsql->wread("kategori","kategori_id",$kategori_id);
		while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
			$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
			$kategorilist->add($kategorilerim);
		}
		return $kategorilist;
	}

	public function karsilastirmayap($karsilastir_id)
	{
		$uniqsorgusor=$this->dbsql->qwSql("SELECT * from karsilastir",array(
			'urun_id' => htmlspecialchars($_POST['urun_id']),
			'kullanici_id' => $karsilastir_id));
		$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
			'karsilastir.kullanici_id' => $karsilastir_id));
		if($uniqsorgusor->rowCount()==0)
		{
			$duzenle=$this->dbsql->insert("karsilastir",array(

				'urun_id' => htmlspecialchars($_POST['urun_id']),
				'kullanici_id' => htmlspecialchars($karsilastir_id)
			));
		}
	}

	public function karsilastirmasil()
	{
		$kaldir=$this->dbsql->delete("karsilastir","karsilastir_id",htmlspecialchars($_POST['karsilastir_id']));
	}

	public function karsilastirmadetayListe()
	{
		if (isset($_SESSION['userkullanici_id']))
		{
			$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
				'karsilastir.kullanici_id' => $_SESSION['userkullanici_id']));
		}
		else
		{
			$karsilastirsor=$this->dbsql->qwSql("SELECT urun.*,karsilastir.* FROM urun INNER JOIN karsilastir ON urun.urun_id=karsilastir.urun_id",array(
				'karsilastir.kullanici_id' => $_COOKIE['karsilastir']));
		}
		return $karsilastirsor;
	}

	public function karsilastirurunListele($urun_id)
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_id' => $urun_id,
			'urun_durum' => 1
		));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
	}

	public function karslastirurunadliste($urun_id)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun.urun_id' => $urun_id

		),[
			"columns_name" => "ozellik_detay_icerik.ozellik_detay_id",
			"columns_sort" => "ASC"
		]);
		return $urunadsor;
	}

	public function ayarListele()
	{
		$ayarsor=$this->dbsql->wread("ayar","ayar_id",0);
		$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
		$ayarlarim=$this->cons->Ayar_ekle($ayarcek);
		return $ayarlarim;
	}

	public function kullaniciListe()
	{
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_mail",$_SESSION['userkullanici_mail']);
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$kullanicilarim=$this->cons->Kullanici_ekle($kullanicicek);
		return $kullanicilarim;
	}

	public function kullaniciAdetbul()
	{
		$kullanicisor=$this->dbsql->wread("kullanici","kullanici_mail",$_SESSION['userkullanici_mail']);
		$say=$kullanicisor->rowCount();
		return $say;
	}

	public function sepetislemheader()
	{
		$sepetkontrol=$this->dbsql->wread("sepet","kullanici_id",$_SESSION['userkullanici_id']);
		while($sepettencek=$sepetkontrol->fetch(PDO::FETCH_ASSOC))
		{
			$sepetttenliste=$this->cons->Sepet_ekle($sepettencek);
			$sepetkontrol2=$this->dbsql->wread("sepet","kullanici_id",$_COOKIE['userid']);
			while($sepettencek2=$sepetkontrol2->fetch(PDO::FETCH_ASSOC))
			{
				$sepetcookie=$this->cons->Sepet_ekle($sepettencek2);
				if ($sepetttenliste->get_urun_id()==$sepetcookie->get_urun_id())
				{
					$adet=$sepetttenliste->get_urun_adet()+$sepetcookie->get_urun_adet();
					$duzenle=$this->dbsql->update("sepet",array(
						'urun_adet' => htmlspecialchars($adet),
						'sepet_id' => htmlspecialchars($sepetttenliste->get_sepet_id())
					),[
						'columns' => 'sepet_id'
					]);


					$sil=$this->dbsql->delete("sepet","sepet_id",htmlspecialchars($sepetcookie->get_sepet_id()));
				}
			}
		}
		$duzenle=$this->dbsql->update("sepet",array(

			'kullanici_id' => $_SESSION['userkullanici_id']

		),[
			'columns' => 'kullanici_id'
		]);
	}

	public function ipkayit($kullanici_id)
	{
		$kaydet=$this->dbsql->insert("Kayit",array(

			'Kayit_detay' => htmlspecialchars($_SERVER['REQUEST_URI']),
			'Kayit_ip' => htmlspecialchars($_SERVER['REMOTE_ADDR']),
			'kullanici_id' => htmlspecialchars($kullanici_id)

		));
	}

	public function zamanguncelle()
	{
		$zamanguncelle=$this->dbsql->update("kullanici",array(

			'kullanici_sonzaman' => date("Y-m-d H:i:s"),
			'kullanici_id' => $_SESSION['userkullanici_id']

		),[
			'columns' => 'kullanici_id'
		]);
	}

	public function mesajadetbul()
	{
		$mesajsay=$this->dbsql->qwSql("SELECT COUNT(mesaj_okunma) as say FROM mesaj",array(
			'mesaj_okunma' => 0,
			'kullanici_gel' => $_SESSION['userkullanici_id'],
			'mesaj.aciklama' => 'alici'
		));

		$saycek=$mesajsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function mesajlistelelimitli($adet)
	{
		$mesajsor=$this->dbsql->qwSql("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id",array(

			'mesaj.kullanici_gel' => $_SESSION['userkullanici_id'],
			'mesaj.mesaj_okunma' => 0,
			'mesaj.aciklama' => 'alici'

		),[
			"columns_name" => "mesaj_okunma,mesaj_zaman",
			"columns_sort" => "DESC",
			"limit" => $adet
		]);
		return $mesajsor;
	}

	public function favorilistesor()
	{
		$favorisor=$this->dbsql->qwSql("SELECT favoriler.*,urun.*,marka.*,favoriler.kullanici_id as id FROM urun INNER JOIN favoriler ON urun.urun_id=favoriler.urun_id INNER JOIN marka ON urun.marka_id=marka.marka_id",array(
			'favoriler.kullanici_id' => $_SESSION['userkullanici_id'],
			'favoriler.favori_durum' => 1
		));
		return $favorisor;
	}

	public function favorilisteme()
	{
		$favorilistele=$this->dbsql->qwSql("SELECT favoriler.*,urun.*,marka.*,renkler.*,favoriler.kullanici_id as id FROM urun INNER JOIN favoriler ON urun.urun_id=favoriler.urun_id INNER JOIN marka ON urun.marka_id=marka.marka_id INNER JOIN renkler ON urun.renk_id=renkler.renk_id",array(
			'favoriler.kullanici_id' => $_SESSION['userkullanici_id']
		));
		return $favorilistele;
	}

	public function favoridurumguncelle($urun_id)
	{
		$favori=$this->dbsql->update("favoriler",array(
			'favori_durum' => 0,
			'urun_id' => $urun_id
		),[
			'columns' => 'urun_id']);
	}

	public function totalsatisHesapla()
	{
		$siparissor=$this->dbsql->qwSql("SELECT SUM(urun_fiyat*urun_adet) as toplam FROM siparis_detay",array(
			'kullanici_idsatici' => $_SESSION['userkullanici_id'],
			'iade_et' => 0
		));

		$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
		return $sipariscek['toplam'];
	}

	public function kategoriuruncoksatanlistelesorgulu($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT COUNT(siparis_detay.urun_id) as urunsay,urun.*,kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON urun.urun_id=siparis_detay.urun_id WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id $where limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'kategori_id' => htmlspecialchars($_GET['kategori_id'])
		));
		return $urunsor;
	}

	public function kategoriurunlistelesorgulu($where,$limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id $where limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'kategori_id' => htmlspecialchars($_GET['kategori_id'])
		));
		return $urunsor;
	}

	public function kategoriurunlistele($limit,$sayfada)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.urun_ad,urun.urun_id,urun.urun_fiyat,urun.urunfoto_resimyol,urun.kategori_id,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,urun.urun_zaman,kategori.kategori_ad,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and urun_onecikar=:urun_onecikar GROUP BY barkod_no,renk_id order by urun_zaman DESC limit $limit,$sayfada");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'urun_onecikar' => 1
		));
		return $urunsor;
	}

	public function odemeurunListele()
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_id' => htmlspecialchars($_POST['urun_id']),
			'urun_durum' => 1
		));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
	}

	public function satici_iade_liste()
	{
		$siparissor=$this->dbsql->__qwSql("SELECT siparis.kullanici_id as k_id,siparis.kullanici_idsatici as ks_id,urun.*,kullanici.*,siparis.*,siparis_detay.*,iade.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN iade ON iade.siparis_id=siparis.siparis_id where kullanici.kullanici_id=:kullanici_id and (iade_durum=:iade_durum or iade_durum=:iade_durum2 or  iade_durum=:iade_durum3)");

		$siparissor->execute(array(
			'kullanici_id' => $_SESSION['userkullanici_id'],
			'iade_durum' =>2,
			'iade_durum2' => 1,
			'iade_durum3' => 0

		));
		return $siparissor;
	}

	public function searchpost($kelimegelen,$deger)
	{
		$arasor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and $deger LIKE '%$kelimegelen%' GROUP BY $deger order by urun_zaman");
		$arasor->execute(array(
			'urun_durum' => 1

		));
		return $arasor;
	}

	public function sepetpostlistele($sepet_id)
	{
		$sepetsor=$this->dbsql->wread("sepet","sepet_id",$sepet_id);
		$sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC);
		return $sepetcek;
	}

	public function sepetpoststok($urun_id)
	{
		$stoksor=$this->dbsql->wread("urun","urun_id",$urun_id);
		$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
		return $stokcek;
	}

	public function SepetpostGuncelle($adet,$sepet_id)
	{
		$duzenle=$this->dbsql->update("sepet",array(
			'urun_adet' => $adet,
			'sepet_id' => $sepet_id
		),[
			'columns' => 'sepet_id'
		]);
	}

	public function sepetpostbilgigetir($sepet_id)
	{
		$sepetsor=$this->dbsql->qwSql("SELECT urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(
			'sepet.sepet_id' => $sepet_id
		));
		$sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC);
		return $sepetcek;
	}

	public function sepetremove($sepet_id)
	{
		$sil=$this->dbsql->delete("sepet","sepet_id",$sepet_id);
	}

	public function sidealtkategoriListele()
	{
		$arraylist=array();
		$altkategorilist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori","kategori_id",htmlspecialchars($_GET['kategori_id']));
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) {
			$altkategorilerim=$this->cons->Alt_kategori_ekle($kategorialtcek);
			$altkategorilist->add($altkategorilerim);
		}
		return $altkategorilist;
	}

	public function altKategoriListeAdetHesapla($alt_kategori_id)
	{
		$urunsay=$this->dbsql->qwSql("SELECT COUNT(alt_kategori_id) as say FROM urun",array(
			'alt_kategori_id' => $alt_kategori_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function sidealturungetir()
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,alt_kategori.*,kullanici.* FROM urun INNER JOIN alt_kategori ON urun.alt_kategori_id=alt_kategori.alt_kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_durum' => 1,
			'alt_kategori.alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id'])
		));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
	}

	public function sidealtkategoridetayListele()
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($altkategoridetaylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_id",htmlspecialchars($_GET['alt_kategori_id']));
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) { 
			$altkategoridetaylarim=$this->cons->Alt_kategori_detay_ekle($kategorialtcek,$kategorialtcek);
			$altkategoridetaylist->add($altkategoridetaylarim);
		}
		return $altkategoridetaylist;
	}

	public function altKategoridetayListeAdetHesapla($alt_kategori_detay)
	{
		$urunsay=$this->dbsql->qwSql("SELECT COUNT(alt_kategori_detay_id) as say FROM urun",array(
			'alt_kategori_detay_id' => $alt_kategori_detay
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function sidebaraltmarkalistele($kategori_id)
	{
		$markagelen=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id']),
			'marka_durum' => 1
		));
		$marka=$markagelen->fetch(PDO::FETCH_ASSOC);

		$markasor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'kategori_id' => $kategori_id,
			'alt_kategori_id' => 0,
			'marka_durum' => 1

		));

		$markaaltsor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id']),
			'marka_durum' => 1
		));

		if ($marka['alt_kategori_id']==$_GET['alt_kategori_id'])
		{
			return $markaaltsor;
		}
		else
		{
			return $markasor;
		}
	}

	public function sidebaraltdetaymarkalistele($uruncek)
	{
		$markagelen=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => $uruncek['alt_kategori_id'],
			'marka_durum' => 1
		));

		$marka=$markagelen->fetch(PDO::FETCH_ASSOC);

		$markasor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'kategori_id' => $uruncek['kategori_id'],
			'alt_kategori_id' => 0,
			'marka_durum' => 1

		));

		$markaaltsor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => $uruncek['alt_kategori_id'],
			'marka_durum' => 1
		));

		if ($marka['alt_kategori_id']==$uruncek['alt_kategori_id'])
		{
			return $markaaltsor;
		}
		else
		{
			return $markasor;
		}
	}


	public function sidebaraltmarkadurum($kategori_id)
	{
		$markagelen=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id']),
			'marka_durum' => 1
		));
		$marka=$markagelen->fetch(PDO::FETCH_ASSOC);

		$markasor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'kategori_id' => $kategori_id,
			'alt_kategori_id' => 0,
			'marka_durum' => 1

		));

		$markaaltsor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => htmlspecialchars($_GET['alt_kategori_id']),
			'marka_durum' => 1
		));

		if ($marka['alt_kategori_id']==$_GET['alt_kategori_id'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function sidebedengetir($alt_kategori_id)
	{
		$bedensor=$this->dbsql->wread("beden","alt_kategori_id",$alt_kategori_id);
		return $bedensor;
	}

	public function siderenkgetir()
	{
		$renksor=$this->dbsql->read("renkler");
		return $renksor;
	}

	public function sidealtkategoridetayurungetir()
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,alt_kategori_detay.*,kullanici.* FROM urun INNER JOIN alt_kategori_detay ON urun.alt_kategori_detay_id=alt_kategori_detay.alt_kategori_detay_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id",array(
			'urun_durum' => 1,
			'alt_kategori_detay.alt_kategori_detay_id' => htmlspecialchars($_GET['alt_kategori_detay_id'])
		));

		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		return $uruncek;
	}

	public function sidealtdetaylariListele()
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($altkategoridetaylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_detay_id",htmlspecialchars($_GET['alt_kategori_detay_id']));
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) { 
			$altkategoridetaylarim=$this->cons->Alt_kategori_detay_ekle($kategorialtcek,$kategorialtcek);
			$altkategoridetaylist->add($altkategoridetaylarim);
		}
		return $altkategoridetaylist;
	}

	public function sidearamaurungetir($searchkeyword)
	{
		$urungelen=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and marka_durum=:marka_durum and  urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%'  order by urun_zaman");
		$urungelen->execute(array(
			'urun_durum' => 1,
			'marka_durum' => 1

		));
		return $urungelen;
	}

	public function kategoridetayListeAdetHesapla($kategori_id)
	{
		$urunsay=$this->dbsql->qwSql("SELECT COUNT(kategori_id) as say FROM urun",array(
			'kategori_id' => $kategori_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);
		return $saycek['say'];
	}

	public function sidearamaislem($urun,$searchkeyword)
	{

		$markasorgu=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'alt_kategori_id' => $urun['alt_kategori_id'],
			'marka_durum' => 1
		));
		$marka=$markasorgu->fetch(PDO::FETCH_ASSOC);
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and marka_durum=:marka_durum and  marka.marka_adi LIKE '%$searchkeyword%' order by urun_zaman");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'marka_durum' => 1
		));

		if ($marka['alt_kategori_id']==$urun['alt_kategori_id'])
		{
			$markasorgu=$this->dbsql->qwSql("SELECT * FROM marka",array(
				'alt_kategori_id' => $urun['alt_kategori_id'],
				'marka_durum' => 1
			));


		}
	}

	public function sidemarkaadethesapla($searchkeyword)
	{
		$markaadet=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'marka_adi' => $searchkeyword,
			'marka_durum' => 1
		));
		$markaadet=$markaadet->rowCount();
		return $markaadet;
	}

	public function sidemarkanullarama($searchkeyword)
	{
		$urunsor=$this->dbsql->__qwSql("SELECT urun.*,kategori.*,kullanici.*,marka.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN marka ON marka.marka_id=urun.marka_id WHERE urun_durum=:urun_durum and marka_durum=:marka_durum and  urun.urun_ad LIKE '%$searchkeyword%' or marka.marka_adi LIKE '%$searchkeyword%'  or kategori.kategori_ad LIKE '%$searchkeyword%'  order by urun_zaman");
		$urunsor->execute(array(
			'urun_durum' => 1,
			'marka_durum' => 1

		));
		return $urunsor;
	}

	public function sidearamamarkaad($urun)
	{
		$markasor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'kategori_id' => $urun['kategori_id'],
			'marka_durum' => 1
		));
		return $markasor;
	}

	public function sidebararamamarkalistesi($urun)
	{
		$markasor=$this->dbsql->qwSql("SELECT * FROM marka",array(
			'marka_id' => $urun['marka_id'],
			'marka_durum' => 1
		));
		return $markasor;
	}

	public function siparis_bilgi_getir()
	{
		$siparissor=$this->dbsql->qwSql("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.siparis_id' => htmlspecialchars($_GET['siparis_id'])
		));
		return $siparissor;
	}

	public function siparisdetaygetir()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici",array(
			'siparis.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
			'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 0

		));
		return $siparissor;
	}

	public function siparislistedengetir()
	{
		$siparissor=$this->dbsql->__qwSql("SELECT * FROM siparis where kullanici_id=:kullanici_id group by siparis_zaman order by siparis_zaman DESC");

		$siparissor->execute(array(
			'kullanici_id' => $_SESSION['userkullanici_id']
		));
		return $siparissor;
	}

	public function siparistotalHesapla($kullanici_id,$siparis_zaman)
	{
		$siparistotalsor=$this->dbsql->qwSql("SELECT SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as tutar,urun.*,kullanici.*,siparis.*,siparis_detay.*  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id",array(
			'siparis.kullanici_id' => $kullanici_id,
			'siparis.siparis_zaman' => $siparis_zaman,
			'siparis_detay.iade_et' => 0

		));

		while($siparistotal=$siparistotalsor->fetch(PDO::FETCH_ASSOC))
		{
			$total=$siparistotal['tutar'];
		}
		return $total;

	}

	public function sliderListele()
	{
		$slidersor=$this->dbsql->read("slider");
		return $slidersor;
	}

	public function kampanyagaleriListele()
	{
		$slidersirketsor=$this->dbsql->read("kampanya_galeri");
		return $slidersirketsor;
	}

	public function stokislemurungetir()
	{
		$urunsor=$this->dbsql->wread("urun","urun_id",htmlspecialchars($_GET['urun_id']));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		$urunlerim=$this->cons->Urun_ekle($uruncek);
		return $urunlerim;
	}

	public function tamamlanansiparisgetir()
	{
		$siparissor=$this->dbsql->qwSql("SELECT siparis_detay.kullanici_id as k_id,siparis.kullanici_idsatici as satici,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
			'siparis.kullanici_idsatici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis_detay.siparisdetay_onay' => 3,
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_zaman",
			"columns_sort" => "DESC",
			"columns_group" => "siparis.siparis_zaman"
		]);
		return $siparissor;
	}

	public function tamamlanansiparistotalHesapla($kullanici_id,$siparis_zaman)
	{
		$siparistotalsor=$this->dbsql->qwSql("SELECT SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as tutar,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
			'siparis.kullanici_idsatici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis_detay.siparisdetay_onay' => 3,
			'siparis_detay.kullanici_id' => $kullanici_id,
			'siparis_zaman' => $siparis_zaman,
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_zaman",
			"columns_sort" => "DESC"
		]);

		while($siparistotal=$siparistotalsor->fetch(PDO::FETCH_ASSOC))
		{
			$total=$siparistotal['tutar'];
		}
		return $total;
	}

	public function tamamlanansiparisdetaykargogetir()
	{
		$siparissorkargo=$this->dbsql->qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id",array(
			'siparis.kullanici_idsatici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'siparis_detay.siparisdetay_onay' => 3,
			'siparis_detay.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
			'siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'siparis_detay.iade_et' => 0
		),[
			"columns_name" => "siparis_zaman",
			"columns_sort" => "DESC"
		]);
		return $siparissorkargo;
	}

	public function urun_duzeleurunListesi()
	{
		$urunsor=$this->dbsql->qwSql("SELECT * FROM urun",array(
			'kullanici_id' => $_SESSION['userkullanici_id'],
			'urun_id' => htmlspecialchars($_GET['urun_id'])
		),[
			"columns_name" => "urun_zaman",
			"columns_sort" => "DESC"
		]);

		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		$urunlerim=$this->cons->Urun_ekle($uruncek);
		return $urunlerim;
	}

	public function urunfotogaleriListesi()
	{
		$urunfotosor=$this->dbsql->wread("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']));
		return $urunfotosor;
	}

	public function urunozellikurungetir()
	{
		$urunsor=$this->dbsql->wread("urun","urun_id",htmlspecialchars($_GET['urun_id']));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		$urunlerim=$this->cons->Urun_ekle($uruncek);
		return $urunlerim;
	}

	public function urunozellikdetaygetir()
	{
		$ozellikdetaysor=$this->dbsql->wread("ozellik_detay_icerik","ozellik_detay_icerik_id",htmlspecialchars($_GET['ozellik_detay_icerik_id']));
		$ozellikdetaycek=$ozellikdetaysor->fetch(PDO::FETCH_ASSOC);
		$ozellik_detay_icerik=$this->cons->Ozellik_Detay_Icerik_ekle($özellikdetaycek);
		return $ozellik_detay_icerik;
	}

	public function urunozellikListegetir()
	{
		$ozellikdetaysor=$this->dbsql->wread("ozellik_detay_icerik","urun_id",htmlspecialchars($_GET['urun_id']));
		return $ozellikdetaysor;
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

	public function urunozellikislem()
	{
		$arraylist=array();
		$urunozelliklist=new ArrayList($arraylist);
		$urun_ozelliksor=$this->dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_GET['alt_kategori_detay_id']));
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC)) {
			$value=array();
			$options=array();
			$urun_ozellik=$this->cons->Urun_Ozellik_ekle($urun_ozellikcek);
			$ozellik_detaysor=$this->dbsql->wread("ozellik_detay","urun_ozellikleri_id",$urun_ozellikcek['urun_ozellikleri_id']);
			while($ozellik_detaycek=$ozellik_detaysor->fetch(PDO::FETCH_ASSOC)) {
				$ozellik_detaylari=$this->cons->Ozellik_Detay_ekle($ozellik_detaycek);  
				array_push($value,$urun_ozellik->get_urun_ozellikleri_id());
				array_push($options,$ozellik_detaylari->get_ozellik_detay());

			}
			$data=array($urun_ozellik->get_urun_ozellikleri_id(),$urun_ozellik->get_ozellik_adi());
			$urunozelliklist->add($options);
			$urunozelliklist->add($value);
			$urunozelliklist->add($data);

		}
		return $urunozelliklist;
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

	public function urundetayjsadsor($urun_ad,$renk_id)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ad' => $urun_ad,
			'urun_ozellikleri_id' => 7,
			'renk_id' => $renk_id
		));
		return $urunadsor;
	}

	public function urundetayjsrenkegorebedengetir($renk_id)
	{
		$bedensor=$this->dbsql->__qwSql("SELECT urun.*,beden.*,renkler.* FROM urun INNER JOIN beden ON urun.beden_id=beden.beden_id  INNER JOIN renkler ON urun.renk_id=renkler.renk_id where urun.renk_id=:renk_id and not urun.beden_id=0");
		$bedensor->execute(array(
			'renk_id' => $renk_id
		));
		return $bedensor;
	}

	public function urundetayjskategorirenkgetir($urun_ad,$renk_id)
	{
		$renklerigetirsor=$this->dbsql->qwSql("SELECT * FROM urun",array(
			'urun_ad' => $urun_ad,
			'renk_id' => $renk_id
		));
		return $renklerigetirsor;
	}

	public function kullaniciurunleriListeleme()
	{
		$arraylist=array();
		$urunlist=new ArrayList($arraylist);
		$urunsor=$this->dbsql->wread("urun","kullanici_id",$_SESSION['userkullanici_id'],[
			"columns_name" => "urun_zaman",
			"columns_sort" => "DESC"
		]);
		while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
			$urunlerim=$this->cons->Urun_ekle($uruncek);
			$urunlist->add($urunlerim);
		}
		return $urunlist;
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

	public function sidebarurunsayisiHesapla($kullanici_id)
	{
		$urunsay=$this->dbsql->qwSql("SELECT COUNT(kategori_id) as say FROM urun",array(
			'kullanici_id' => $kullanici_id
		));

		$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);

		return $saycek['say'];
	}

	public function usersaticigetir()
	{
		$kullanicisor=$this->dbsql->qwSql("SELECT * FROM kullanici",array(
			'kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
			'kullanici_magaza' => 2
		));
		return $kullanicisor;
	}

	public function saticiUrunleriGetir()
	{
		$urunsor=$this->dbsql->qwSql("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id",array(
			'urun.kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
		));
		return $urunsor;
	}

	public function yenisiperisgetir()
	{
		$siparissor=$this->dbsql->__qwSql("SELECT siparis_detay.kullanici_id as k_id,siparis.kullanici_idsatici as satici,siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis 
			INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici 
			INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
			where siparis.kullanici_idsatici=:satici
			and 
			(siparis_detay.siparisdetay_onay=:onay 
				or siparis_detay.siparisdetay_onay=:onays or siparis_detay.siparisdetay_onay=:onayss) group by siparis_zaman order by siparis_zaman DESC
			");

		$siparissor->execute(array(
			'satici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'onay' => 0,
			'onays' => 1,
			'onayss' => 2
		));
		return $siparissor;
	}

	public function yenisiparistotalHesapla($sipariscek)
	{
		$siparistotalsor=$this->dbsql->__qwSql("SELECT SUM(siparis_detay.urun_fiyat*siparis_detay.urun_adet) as tutar,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
			INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
			where siparis_detay.kullanici_idsatici=:satici and siparis_detay.kullanici_id =:kullanici_id and siparis.siparis_zaman =:siparis_zaman and (siparis_detay.siparisdetay_onay=:onay or siparis_detay.siparisdetay_onay=:onays or siparis_detay.siparisdetay_onay=:onayss) and siparis_detay.iade_et =:iade_et order by siparis_zaman DESC");

		$siparistotalsor->execute(array(
			'satici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'kullanici_id' => htmlspecialchars($sipariscek['k_id']),
			'siparis_zaman' => htmlspecialchars($sipariscek['siparis_zaman']),
			'onay' => 0,
			'onays' => 1,
			'onayss' => 2,  
			'iade_et' => 0
		));

		while($siparistotal=$siparistotalsor->fetch(PDO::FETCH_ASSOC))
		{
			$total=$siparistotal['tutar'];
		}
		return $total;

	}

	public function yenisiparisdetaygetir()
	{
		$siparissorkargo=$this->dbsql->__qwSql("SELECT siparis_detay.urun_fiyat as satis_fiyat,siparis.*,siparis.kullanici_idsatici as satici,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id where siparis.kullanici_idsatici=:satici and (siparis_detay.siparisdetay_onay=:onay or siparis_detay.siparisdetay_onay=:onays or siparis_detay.siparisdetay_onay=:onayss) and siparis.siparis_zaman =:siparis_zaman and siparis_detay.kullanici_id =:kullanici_id and siparis_detay.iade_et =:iade_et order by siparis_zaman DESC");

		$siparissorkargo->execute(array(
			'satici' => htmlspecialchars($_SESSION['userkullanici_id']),
			'onay' => 0,
			'onays' => 1,
			'onayss' => 2,
			'siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
			'kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
			'iade_et' => 0
		));
		return $siparissorkargo;
	}

	public function IstatistikSorguType($type)
	{
		if ($type=="gün")
		{
			$sorgu="and DAY(siparis.siparis_zaman)=DAY(CURDATE()) AND MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
		}
		else if ($type=="ay")
		{
			$sorgu="and MONTH(siparis_detay.siparisdetay_kargozaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
		}
		else if ($type=="yıl")
		{
			$sorgu="and YEAR(siparis_detay.siparisdetay_kargozaman)=YEAR(CURDATE())";
		}
		else
		{
			$sorgu="";
		}
		return $sorgu;
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}

}
?>