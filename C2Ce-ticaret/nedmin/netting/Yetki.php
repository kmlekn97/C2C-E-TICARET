<?php
session_start();
require_once 'dbconfig.php';
class yetki
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

	public function yetkikontrol($durum,$id)
	{
		try {

			$yetkisor=$this->db->prepare("SELECT * from yetki WHERE kullanici_id=$id and yetki_adi='$durum'");
			$yetkicek=$yetkisor->execute();
			while ($yetkicek=$yetkisor->fetch(PDO::FETCH_ASSOC)) 
			{
				if ($yetkisor->rowCount()>0)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
	}
}
?>