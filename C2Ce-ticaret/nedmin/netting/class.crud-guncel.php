<?php
session_start();
require_once 'dbconfig.php';
require_once 'SimpleImage.php';

class crud {

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

	public function addValue($argse) {

		$values=implode(',',array_map(function ($item){
			return $item.'=?';
		},array_keys($argse)));

		return $values;
	}

	public function addValueAnd($argse) {

		$values=implode(' AND ',array_map(function ($item){
			return $item.'=?';
		},array_keys($argse)));

		return $values;
	}


	public function insert($table,$values,$options=[]) {

		try {
			
			if (!empty($_FILES[$options['file_name']]['name'])) {
				
				$name_y=$this->imageUpload(
					$_FILES[$options['file_name']]['name'],
					$_FILES[$options['file_name']]['size'],
					$_FILES[$options['file_name']]['tmp_name'],
					$options['dir'],
					null,
					$options['dosyalink'],
					$options['width'],
					$options['height']
				);

				$values+=[$options['file_name'] =>"dimg/".$options['dir']."/".$name_y];
			}



			if (isset($options['pass'])) {
				$values[$options['pass']]=md5($values[$options['pass']]);
			}
			// echo "<pre>";
			// print_r($values);
			// exit;


			unset($values[$options['form_name']]);
			

			$stmt=$this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
			$durum=$stmt->execute(array_values($values));

			if ($durum==0)
				return ['status' => FALSE];

			return ['status' => TRUE];
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}

	public function update($table,$values,$options=[]) { 

		try {

			if (!empty($_FILES[$options['file_name']]['name'])) {

				
				$name_y=$this->imageUpload(
					$_FILES[$options['file_name']]['name'],
					$_FILES[$options['file_name']]['size'],
					$_FILES[$options['file_name']]['tmp_name'],
					$options['dir'],
					$options['file_delete'],
					$options['dosyalink'],
					$options['width'],
					$options['height']
				);

				 //print_r($name_y);
				// exit;


				$values+=[$options['file_name'] => "dimg/".$options['dir']."/".$name_y];
				
			}

			//Eski Resim Dosyasının Değerini Temizleme...
			unset($values[$options['file_delete']]);


			if (isset($options['pass'])) {
				$values[$options['pass']]=md5($values[$options['pass']]);
			}
			
			$columns_id=$values[$options['columns']];
			unset($values[$options['form_name']]);
			unset($values[$options['columns']]);
			$valuesExecute=$values;
			$valuesExecute+=[$options['columns'] => $columns_id];

			

			 //echo "<pre>";
			 //print_r($values);
			 //print_r($valuesExecute);
			 //exit;
			
			
			$stmt=$this->db->prepare("UPDATE $table SET {$this->addValue($values)} WHERE {$options['columns']}=?");
			$durum=$stmt->execute(array_values($valuesExecute));

			if ($durum==0)
				return ['status' => FALSE];

			return ['status' => TRUE];
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}


	public function delete ($table,$columns,$values,$fileName=null) {


		try {

			if (!empty($fileName)) {
				unlink($fileName);
			}

			$stmt=$this->db->prepare("DELETE FROM $table WHERE $columns=?");
			$durum=$stmt->execute([htmlspecialchars($values)]);

			if ($durum==0)
				return ['status' => FALSE];

			return ['status' => TRUE]; 
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}



	public function imageUpload($name,$size,$tmp_name,$dir,$file_delete=null,$link=null,$width=null,$height=null) {

		try {

			$izinli_uzantilar=[
				'jpg',
				'jpge',
				'png',
				'ico'
			];
			$path_parts = pathinfo($name);
			$ext=strtolower(substr($name, strpos($name, '.')+1));
			$name_y=uniqid().$path_parts['filename'].".".$ext;

			if (in_array($ext, $izinli_uzantilar)===false) {
				Header("Location:$link?durum=hata");
				//throw new Exception('Bu dosya türü kabul edilmemektedir...');
				exit();

			}

			else if ($size>1048576) {
				Header("Location:$link?durum=hata");
				//throw new Exception('Dosya boyutu çok büyük...');
				exit();
			}

			else if (!@move_uploaded_file($tmp_name, "../../dimg/$dir/$name_y")) {
				Header("Location:$link?durum=hata");
				//throw new Exception('Dosya yükleme hatası...');
				exit();
			}

			else
			{
				

				if (!empty($file_delete)) {
					unlink("../../$file_delete");

					if (strstr($dir, "test")) {
						$_SESSION["resim"]=$name_y;
					}

				}

				setcookie("resim",$name_y,strtotime("+30 day"),"/");


				$image = new SimpleImage();
				$image->load("../../dimg/$dir/".$name_y);
				$image->resize($width,$height);
				$image->save("../../dimg/$dir/".$name_y);
				Header("Location:$link?durum=ok");
				return $name_y;
			}
			return null;

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];
		}
	}

	public function adminsLogin($admins_username,$remember_me) {
		
		try {

			$stmt=$this->db->prepare("SELECT * FROM kullanici where kullanici_mail=?");
			

			$stmt->execute([$admins_username]);

			if ($stmt->rowCount()==1) {

				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['kullanici_durum']==0) {
					return ['status' => FALSE];
					exit;
				}

				else
				{
					$_SESSION["kullanici_id"]=$row['kullanici_id'];

					if ($remember_me==1) {

						$admins=
						[
							"kullanici_mail" => $row['kullanici_mail'],
							"kullanici_password" => openssl_encrypt($row['kullanici_password'], "AES-128-ECB", "admins_coz"),
						];

						setcookie("adminsLogin",json_encode($admins),strtotime("+30 day"),"/");


					} else if ($remember_me==0) {

						setcookie("adminsLogin",json_encode($admins),strtotime("-30 day"),"/");
					}

					return ['status' => TRUE];
				}

				return ['status' => TRUE];


			} else {

				return ['status' => FALSE ];

			}



		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}


	}

	public function kullaniciLogin($admins_username,$remember_me) {
		
		try {

			$stmt=$this->db->prepare("SELECT * FROM kullanici where kullanici_mail=?");
			

			$stmt->execute([$admins_username]);

			if ($stmt->rowCount()>=1) {

				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if ($row['kullanici_durum']==0) {
					return ['status' => FALSE];
					exit;
				}

				else
				{
					$_SESSION["userkullanici_id"]=$row['kullanici_id'];
					if ($remember_me==1) {

						$admins=
						[
							"kullanici_mail" => $row['kullanici_mail'],
							"kullanici_password" => openssl_encrypt($row['kullanici_password'], "AES-128-ECB", "admins_coz")
						];

						setcookie("userLogin",json_encode($admins),strtotime("+30 day"),"/");


					} else if ($remember_me==0) {

						setcookie("userLogin",json_encode($admins),strtotime("-30 day"),"/");
					}

					return ['status' => TRUE];
				}

				return ['status' => TRUE];


			} else {

				return ['status' => FALSE ];

			}



		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}


	}

	public function read($table,$options=[]) {

		
		try {

			if (isset($options['columns_name']) && empty($options['limit'])) {

				$stmt=$this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']}");

			} else if (isset($options['columns_name']) && isset($options['limit'])) {


				$stmt=$this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
			} else {

				$stmt=$this->db->prepare("SELECT * FROM $table");

			}

			
			$stmt->execute();

			return $stmt;
			
		} catch (Exception $e) {
			
			echo $e->getMessage();
			return false;
		}
	}



	public function wread($table,$columns,$values,$options=[]) {

		try {

			if (isset($options['columns_name']) && empty($options['limit'])) {

				$stmt=$this->db->prepare("SELECT * FROM $table where $columns=? order by {$options['columns_name']} {$options['columns_sort']}");

			} else if (isset($options['columns_name']) && isset($options['limit'])) {


				$stmt=$this->db->prepare("SELECT * FROM $table where $columns=? order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
			} else {

				$stmt=$this->db->prepare("SELECT * FROM $table where $columns=?");

			}

			
			$stmt->execute([htmlspecialchars($values)]);

			return $stmt;
			
		} catch (Exception $e) {
			
			echo $e->getMessage();
			return false;
		}
	}

	public function qwSql($sql,$values,$options=[]) {

		try {
			if (isset($options['columns_name']) && empty($options['limit'])) {
				$stmt=$this->db->prepare($sql." where ".$this->addValueAnd($values)." order by {$options['columns_name']} {$options['columns_sort']}");
			}
			else if (isset($options['columns_name']) && isset($options['limit'])) {
				$stmt=$this->db->prepare($sql." where ".$this->addValueAnd($values)." order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
			}
			else
			{
				$stmt=$this->db->prepare($sql." where ".$this->addValueAnd($values));
			}

			if (isset($options['columns_name']) && empty($options['limit']) && isset($options['columns_group'])) {
				$stmt=$this->db->prepare($sql." where ".$this->addValueAnd($values)."GROUP by {$options['columns_group']} order by {$options['columns_name']} {$options['columns_sort']}");
			}
			
			$stmt->execute(array_values($values));
			return $stmt;

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
	}


	public function __qwSql($sql,$options=[]) {

		try {
			if (isset($options['columns_name']) && empty($options['limit'])) {
				$stmt=$this->db->prepare($sql." order by {$options['columns_name']} {$options['columns_sort']}");
			}
			else if (isset($options['columns_name']) && isset($options['limit'])) {
				$stmt=$this->db->prepare($sql." order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
			}
			else
			{
				$stmt=$this->db->prepare($sql);
			}
			
			$stmt->execute(array_values($values));
			return $stmt;

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
	}


	public function orderUpdate($table,$values,$columns,$orderId) { 


		try {

			foreach ($values as $key => $value) { 

				$stmt = $this->db->prepare("UPDATE $table SET $columns=? WHERE $orderId=?");
				$stmt->execute([$key,$value]);   

			}

			return ['status' => TRUE];

		} catch(PDOException $e) {    
			echo $e->getMessage();
			return ['status' => FALSE,'error'=> $e->getMessage()];

		}
	}

	public function adetguncelle($adetim,$sepet_ids)
	{
		$duzenle=$this->db->prepare("UPDATE sepet SET

			urun_adet=:urun_adet

			WHERE sepet_id={$sepet_ids}");

		$update=$duzenle->execute(array(


			'urun_adet' => $adetim
		));
		return $update;
	}
}

?>