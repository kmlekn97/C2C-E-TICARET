<?php
/**
 * 
 */
require_once 'ArrayList.php';
class SıkIslemlerServices
{
	
	private $cons;
	private $dbsql;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
	}

	public function kategorilistele()
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

	public function AltktegoriListele($kategori_id)
	{
		$arraylist=array();
		$altkategorilist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori","kategori_id",$kategori_id);

		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) {
			$alt_kategori=$this->cons->Alt_kategori_ekle($kategorialtcek);
			$altkategorilist->add($alt_kategori);		
		}
		return $altkategorilist;
	}

	public function AltktegoriDetayListele($kategori_id)
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_id",$kategori_id);

		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC)) {
			$alt_kategori_detay=$this->cons->Alt_kategori_detay_ekle($kategorialtcek,$kategorialtcek);
			$altkategoridetaylist->add($alt_kategori_detay);		
		}
		return $altkategoridetaylist;
	}

	public function renkleriListele()
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

	public function bedenleriListele()
	{
		$arraylist=array();
		$bedenlist=new ArrayList($arraylist);
		$bedensor=$this->dbsql->read("beden");

		while($bedencek=$bedensor->fetch(PDO::FETCH_ASSOC)) {
			$bedenler=$this->cons->Beden_ekle($bedencek);
			$bedenlist->add($bedenler);		
		}
		return $bedenlist;
	}

	public function MarkalariListele($kategoriid)
	{
		$arraylist=array();
		$markalist=new ArrayList($arraylist);
		$markasor=$this->dbsql->wread("marka","kategori_id",$kategoriid);
		while($markacek=$markasor->fetch(PDO::FETCH_ASSOC)) {
			$markalar=$this->cons->Marka_ekle($markacek);
			$markalist->add($markalar);		
		}
		return $markalist;
	}

	public function HesaplariListele($hesapsor)
	{
		$arraylist=array();
		$hesaplist=new ArrayList($arraylist);
		while($hesapcek=$hesapsor->fetch(PDO::FETCH_ASSOC)) {
			$hesaplarim=$this->cons->Hesap_ekle($hesapcek);
			$hesaplist->add($hesaplarim);		
		}
		return $hesaplist;
	}

	public function sepeturungetir()
	{
		$sepetsor=$this->dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON urun.urun_id=sepet.urun_id",array(

			'sepet.kullanici_id' =>  $_SESSION['userkullanici_id']
		));
		return $sepetsor;

	}

	public function urunozellikgetir($urun_id)
	{
		$urunadsor=$this->dbsql->qwSql("SELECT urun.*,ozellik_detay_icerik.*,ozellik_detay.* FROM urun INNER JOIN ozellik_detay_icerik ON urun.urun_id=ozellik_detay_icerik.urun_id INNER JOIN ozellik_detay ON ozellik_detay.ozellik_detay_id=ozellik_detay_icerik.ozellik_detay_id",array(
			'urun_ozellikleri_id' => 7,
			'urun.urun_id' => $urun_id     

		));
		return $urunadsor;
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

	public function Bedenleri_getir($beden_id=null)
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

	public function kategori_listesi()
	{
		$arraylist=array();
		$kategorilist=new ArrayList($arraylist);
		$kategorisor=$this->dbsql->wread("kategori","kategori_onecikar",1,[
			"columns_name" => "kategori_sira",
			"columns_sort" => "ASC"
		]);
		while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { 
			$kategorilerim=$this->cons->Kategori_ekle($kategoricek);
			$kategorilist->add($kategorilerim);		
		}
		return $kategorilist;
	}

	public function alt_kategori_listesi($kategori_id)
	{
		$arraylist=array();
		$altkategorilist=new ArrayList($arraylist);
		$kategorialtsor=$this->dbsql->wread("alt_kategori","kategori_id",$kategori_id,[
			"columns_name" => "alt_kategori_sira",
			"columns_sort" => "ASC"
		]);
		while($kategorialtcek=$kategorialtsor->fetch(PDO::FETCH_ASSOC))
		{
			$altkategorilerim=$this->cons->Alt_kategori_ekle($kategorialtcek);
			$altkategorilist->add($altkategorilerim);		
		}
		return $altkategorilist;
	}

	public function alt_kategori_detay_listesi($alt_kategori_id)
	{
		$arraylist=array();
		$altkategoridetaylist=new ArrayList($arraylist);
		$kategoridetaysor=$this->dbsql->wread("alt_kategori_detay","alt_kategori_id",$alt_kategori_id,[
			"columns_name" => "alt_kategori_detay_sira",
			"columns_sort" => "ASC"
		]);
		while($kategoridetaycek=$kategoridetaysor->fetch(PDO::FETCH_ASSOC))
		{
			$altkategoridetaylarim=$this->cons->Alt_kategori_detay_ekle($kategoridetaycek,$kategoridetaycek);
			$altkategoridetaylist->add($altkategoridetaylarim);		
		}
		return $altkategoridetaylist;
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}
}
?>