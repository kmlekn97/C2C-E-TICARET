<?php
/**
 * 
 */
require_once 'ArrayList.php';
class OnPanelService
{
	
	public $cons;
	public $dbsql;

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
}
?>