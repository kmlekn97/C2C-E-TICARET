<?php
/**
 * 
 */
class chartDBServices
{
	
	private $cons;
	private $dbsql;

	function __construct($dbsql,$cons)
	{
		$this->cons = $cons;
		$this->dbsql = $dbsql;
	}

	public function kategoriListele($sira)
	{
		$katagorisor=$this->dbsql->wread("kategori","kategori_sira",$sira);
		$katagoricek=$katagorisor->fetch(PDO::FETCH_ASSOC);
		$kategorim=$this->cons->Kategori_ekle($katagoricek);
		return $kategorim;
	}

	public function kategoriOku()
	{
		$katagorisor=$this->dbsql->read("kategori");
		return $katagorisor;
	}

	public function findSorguType($type)
	{
		if ($type=="gün")
		{
			$sorgu="WHERE DAY(siparis.siparis_zaman)=DAY(CURDATE()) AND MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
		}
		else if ($type=="ay")
		{
			$sorgu="WHERE MONTH(siparis.siparis_zaman)=MONTH(CURDATE()) AND YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
		}
		else if ($type=="yıl")
		{
			$sorgu="WHERE YEAR(siparis.siparis_zaman)=YEAR(CURDATE())";
		}
		else
		{
			$sorgu="";
		}
		return $sorgu;
	}

	public function findCariSorguType($type)
	{
		if ($type=="gün")
		{
			$sorgu="WHERE DAY(islem_tarih)=DAY(CURDATE()) AND MONTH(islem_tarih)=MONTH(CURDATE()) AND YEAR(islem_tarih)=YEAR(CURDATE())";
		}
		else if ($type=="ay")
		{
			$sorgu="WHERE MONTH(islem_tarih)=MONTH(CURDATE()) AND YEAR(islem_tarih)=YEAR(CURDATE())";
		}
		else if ($type=="yıl")
		{
			$sorgu="WHERE YEAR(islem_tarih)=YEAR(CURDATE())";
		}
		else
		{
			$sorgu="";
		}
		return $sorgu;
	}

	public function kategoriSiraliListele()
	{
		$katagorisor=$this->dbsql->read("kategori",[
			"columns_name" => "kategori_sira",
			"columns_sort" => "ASC"
		]);
		return $katagorisor;
	}

	public function vericek($verisor)
	{
		$vericek=$verisor->fetch(PDO::FETCH_ASSOC);
		return $vericek;
	}
}
?>