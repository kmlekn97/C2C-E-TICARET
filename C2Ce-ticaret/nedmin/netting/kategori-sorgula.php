<?php 
require_once 'dbconfig.php';
include '../production/fonksiyon.php';
class Kategori
{
	private $db;
	private $dbhost=DBHOST;
	private $dbuser=DBUSER;
	private $dbpass=DBPWD;
	private $dbname=DBNAME;

	public $adet=0;


	function __construct() {

		try {

			$this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);

		 //echo "Bağlantı Başarılı";

		} catch (Exception $e) {

			die("Bağlantı Başarısız:".$e->getMessage());
		}

	}	
	public function sorgula($kategoriid,$durum,$durumsayfa=null)
	{
		$this->adet=0;
		$where="";
		$where2="(";
		$adetfiltre=0;
		$ozellik="";
		$ozellikadet=0;
		$ozellikvarmi=1;
		$ozellikdizim=array();
		$stmt=$this->db->prepare("SELECT * FROM urun_ozellikler where alt_kategori_detay_id=?");
		$stmt->execute([$kategoriid]);
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ozellik.=seo($row['ozellik_adi']).',';  
			$ozellikdizi=explode(",",$ozellik);
			$ozellikadet=count($ozellikdizi);
		}
		if ($durum==1)
		{
			$dizimarka=array();
			$dizimarka = explode (",",$_GET['marka']);
			$adetmarka=count($dizimarka);

			$dizirenk=array();
			$dizirenk = explode (",",$_GET['renk']);
			$adetrenk=count($dizirenk);


			$dizibeden=array();
			$dizibeden = explode (",",$_GET['beden']);
			$adetbeden=count($dizibeden);

			$dizi = explode ("-",$_GET['fiyat']);

			if (isset($_GET['fiyat']))
			{
				$where.='(urun.urun_fiyat BETWEEN '. $dizi[0] .' AND '.$dizi[1].')';
				$this->adet++;
			}

			if (isset($_GET['marka']))
			{
				if ($adetmarka==1)
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.marka_id = '.$dizimarka[0].') ';
					}
					else
					{
						$where .= ' AND (urun.marka_id = '.$dizimarka[0].')';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.marka_id = '.$dizimarka[0].'';
					}
					else
					{
						$where .= ' AND (urun.marka_id = '.$dizimarka[0].'';
					}  


					for ($i = 1; $i < $adetmarka; $i++) 
					{
						$where .= ' or  urun.marka_id = '.$dizimarka[$i]; 
					}
					$where.=')';
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}


			if (isset($_GET['renk']))
			{
				if ($adetrenk==1)
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.renk_id = '.$dizirenk[0].')';
					}
					else
					{
						$where .= ' AND (urun.renk_id = '.$dizirenk[0].')';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.renk_id = '.$dizirenk[0].'';
					}
					else
					{
						$where .= ' AND (urun.renk_id = '.$dizirenk[0].'';
					}  


					for ($i = 1; $i < $adetrenk; $i++) 
					{
						$where .= ' or  urun.renk_id = '.$dizirenk[$i]; 
					}
					$where.=')';
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}


			if (isset($_GET['beden']))
			{
				if ($adetbeden==1)
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.beden_id = '.$dizibeden[0].')';
					}
					else
					{
						$where .= ' AND (urun.beden_id = '.$dizibeden[0].')';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.beden_id = '.$dizibeden[0].'';
					}
					else
					{
						$where .= ' AND (urun.beden_id = '.$dizibeden[0].'';
					}  


					for ($i = 1; $i < $adetbeden; $i++) 
					{
						$where .= ' or  urun.beden_id = '.$dizibeden[$i]; 
					}
					$where.=')';
					$this->adet++;
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}
			for ($i=0; $i<$ozellikadet; $i++)
			{
				if (isset($_GET[$ozellikdizi[$i]]))
				{
					$gelenadet=0;
					$ozellikdizim = explode(",",$_GET[$ozellikdizi[$i]]);
					$ozellikdizimadet=count($ozellikdizim);
					if ($ozellikdizimadet==1)
					{


						if ($adetfiltre==0)
						{
							$where2 .= ' ozellik_detay_icerik.ozellik_detay_id = '.$ozellikdizim[0];
						}
						else
						{
							$where2 .= ' or ozellik_detay_icerik.ozellik_detay_id = '.$ozellikdizim[0];
						}


					}



					else
					{
						if ($adetfiltre==0)
						{
							$where2 .= ' ozellik_detay_icerik.ozellik_detay_id = '.$ozellikdizim[0].'';
						}
						else
						{
							$where2 .= ' or ozellik_detay_icerik.ozellik_detay_id = '.$ozellikdizim[0].'';
						}  
						$ids  = array(0);
						for ($j=0; $j<$ozellikdizimadet; $j++)
						{
							array_push($ids,$ozellikdizim[$j]);
						}


						for ($k = 0; $k < $ozellikdizimadet; $k++) 
						{
							$where2 .= ' or  ozellik_detay_icerik.ozellik_detay_id = '.$ids[$k]; 



						}
					}


					$adetfiltre++;
					$where2 = str_replace('?','',$where2); 
				}

			}

			if ($this->adet>0)
			{
				$where.="AND".$where2.")";     
			}
			else
			{
				$where.=$where2.")";
			}

			$where .=' and urun.urun_durum = 1 and urun.alt_kategori_detay_id= ';
			$where .=' '+$_GET['alt_kategori_detay_id'];
			$where = str_replace('?','',$where); 
		}
		
		else if (isset($_GET['renk']) || isset($_GET['fiyat']) || isset($_GET['marka']) || isset($_GET['beden']))
		{


			$dizimarka=array();
			$dizimarka = explode (",",$_GET['marka']);
			$adetmarka=count($dizimarka);

			$dizirenk=array();
			$dizirenk = explode (",",$_GET['renk']);
			$adetrenk=count($dizirenk);


			$dizibeden=array();
			$dizibeden = explode (",",$_GET['beden']);
			$adetbeden=count($dizibeden);

			$dizi = explode ("-",$_GET['fiyat']);

			if (isset($_GET['fiyat']))
			{
				$where.='urun.urun_fiyat BETWEEN '. $dizi[0] .' AND '.$dizi[1];
				$this->adet++;
			}

			if (isset($_GET['marka']))
			{
				if ($adetmarka==1)
				{
					if ($this->adet==0)
					{
						$where .= ' urun.marka_id = '.$dizimarka[0].'';
					}
					else
					{
						$where .= ' AND urun.marka_id = '.$dizimarka[0].'';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.marka_id = '.$dizimarka[0].'';
					}
					else
					{
						$where .= ' AND (urun.marka_id = '.$dizimarka[0].'';
					}  


					for ($i = 1; $i < $adetmarka; $i++) 
					{
						$where .= ' or  urun.marka_id = '.$dizimarka[$i]; 
					}
					$where.=')';
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}


			if (isset($_GET['renk']))
			{
				if ($adetrenk==1)
				{
					if ($this->adet==0)
					{
						$where .= ' urun.renk_id = '.$dizirenk[0].'';
					}
					else
					{
						$where .= ' AND urun.renk_id = '.$dizirenk[0].'';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.renk_id = '.$dizirenk[0].'';
					}
					else
					{
						$where .= ' AND (urun.renk_id = '.$dizirenk[0].'';
					}  


					for ($i = 1; $i < $adetrenk; $i++) 
					{
						$where .= ' or  urun.renk_id = '.$dizirenk[$i]; 
					}
					$where.=')';
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}


			if (isset($_GET['beden']))
			{
				if ($adetbeden==1)
				{
					if ($this->adet==0)
					{
						$where .= ' urun.beden_id = '.$dizibeden[0].'';
					}
					else
					{
						$where .= ' AND urun.beden_id = '.$dizibeden[0].'';
					}
				}

				else
				{
					if ($this->adet==0)
					{
						$where .= ' (urun.beden_id = '.$dizibeden[0].'';
					}
					else
					{
						$where .= ' AND (urun.beden_id = '.$dizibeden[0].'';
					}  


					for ($i = 1; $i < $adetbeden; $i++) 
					{
						$where .= ' or  urun.beden_id = '.$dizibeden[$i]; 
					}
					$where.=')';
				}

				$this->adet++;
				$where = str_replace('?','',$where); 
			}
			if($durumsayfa==1)
			{
				$where .=' and urun.urun_durum = 1 and urun.alt_kategori_id= ';
				$where .=' '+$_GET['alt_kategori_id'];
			}
			else if ($durumsayfa==2)
			{
				$where .=' and urun.urun_durum = 1 and urun.alt_kategori_detay_id= ';
				$where .=' '+$_GET['alt_kategori_detay_id'];
			}
			else
			{

			}

		}
		return $where;
	}
}
?>