<?php

date_default_timezone_set('Europe/Istanbul');

ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';
require_once 'class.crud-guncel.php';
$dbsql=new crud();

if (isset($_POST['musterikaydet'])) {

	$kullanici_mail=htmlspecialchars(trim($_POST['kullanici_mail'])); 
	$kullanici_passwordone=htmlspecialchars(trim($_POST['kullanici_passwordone'])); 
	$kullanici_passwordtwo=htmlspecialchars(trim($_POST['kullanici_passwordtwo'])); 

	$regex_lowercase = '/[a-z]/'; // küçük harf
	$regex_uppercase = '/[A-Z]/'; // büyük harf
	$regex_number = '/[0-9]/'; //sayı
	$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>~]/'; // özel karakter

	if ($kullanici_passwordone==$kullanici_passwordtwo) {

		if(!preg_match_all($regex_lowercase,$kullanici_passwordone) || !preg_match_all($regex_uppercase,$kullanici_passwordone) || !preg_match_all($regex_number,$kullanici_passwordone) || !preg_match_all($regex_special,$kullanici_passwordone))
		{
			header("Location:../../register.php?durum=eksiksifre");
			exit();
		}

		if (strlen($kullanici_passwordone)>=6) {

			// Başlangıç

			$kullanicisor=$dbsql->wread("kullanici","kullanici_mail",$kullanici_mail);

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();

			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);
				$kullanici_yetki=1;

				//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$dbsql->insert("kullanici",array(
					'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
					'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
					'kullanici_mail' =>  htmlspecialchars($_POST['kullanici_mail']),
					'kullanici_password' => htmlspecialchars($_POST['kullanici_passwordone']),
					'kullanici_yetki' => $kullanici_yetki
				),['pass' => 'kullanici_password']);

				if ($kullanicikaydet['status']) {

					header("Location:../../login?durum=kayitok");

				} else {


					header("Location:../../register?durum=basarisiz");
				}

			} else {

				header("Location:../../register?durum=mukerrerkayit");

			}

		// Bitiş

		} else {

			header("Location:../../register.php?durum=eksiksifre");
		}

	} else {

		header("Location:../../register.php?durum=farklisifre");
	}
}

if (isset($_POST['musterigiris'])) {

	if (isset($_POST['remember_me']))
	{
		$remember=1;
	}
	else
	{
		$remember=0;
	}

	require_once '../../securimage/securimage.php';

	$securimage = new Securimage();

	if ($securimage->check($_POST['captcha_code']) == false) {

		header("Location:../../login?durum=captchahata");
		exit;

	}
	
	echo $kullanici_mail=htmlspecialchars(trim($_POST['kullanici_mail']));
	echo $kullanici_password=md5(htmlspecialchars($_POST['kullanici_password'])); 

	if (isset($_COOKIE['userLogin']))
	{
		$kullanici_password=$_POST['kullanici_password'];
	}

	$kullanicisor=$dbsql->qwSql("SELECT * from kullanici",array(
		'kullanici_mail' => $kullanici_mail,
		'kullanici_yetki' => 1,
		'kullanici_password' => $kullanici_password,
		'kullanici_durum' => 1
	));

	$say=$kullanicisor->rowCount();
	function GetIP(){
		if(getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode (',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
			$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}


	if ($say==1) {

		$kullanici_ip=GetIP();

		$zamanguncelle=$dbsql->update("kullanici",array(
			'kullanici_sonzaman' => date("Y-m-d H:i:s"),
			'kullanici_sonip' => htmlspecialchars($kullanici_ip),
			'kullanici_mail' => $kullanici_mail
		),[
			'columns' => 'kullanici_mail'
		]);

		$_SESSION['userkullanici_sonzaman']=strtotime(date(""));
		$_SESSION['ip']=$kullanici_ip;
		$_SESSION['userkullanici_mail']=$kullanici_mail;
		setcookie("remmeber_me",$remember,strtotime("+30 day"),"/");
		setcookie("oturumdurum",1,strtotime("+30 day"),"/");
		header("Location:../../index.php?durum=girisbasarili");
		exit;
		

	} else {

		header("Location:../../login?durum=hata");
		exit;
	}
}

if (isset($_POST['musteribilgiguncelle'])) {
	
	$kullaniciguncelle=$dbsql->update("kullanici",array(
		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($kullaniciguncelle['status']) {
		
		Header("Location:../../hesabim?durum=ok");

	} else {

		Header("Location:../../hesabim?durum=hata");
	}
}

if (isset($_POST['musteriadresguncelle'])) {
	
	$kullaniciguncelle=$dbsql->update("kullanici",array(
		'kullanici_tip' => htmlspecialchars($_POST['kullanici_tip']),
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'magaza_adi' => htmlspecialchars($_POST['magaza_adi']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($kullaniciguncelle['status']) {
		
		Header("Location:../../adres-bilgileri?durum=ok");

	} else {

		Header("Location:../../adres-bilgileri?durum=hata");
	}
}

if (isset($_POST['musterisifreguncelle'])) {
	

	$kullanici_eskipassword=htmlspecialchars($_POST['kullanici_eskipassword']);
	$kullanici_passwordone=htmlspecialchars($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo=htmlspecialchars($_POST['kullanici_passwordtwo']);

	$regex_lowercase = '/[a-z]/'; // küçük harf
	$regex_uppercase = '/[A-Z]/'; // büyük harf
	$regex_number = '/[0-9]/'; //sayı
	$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>~]/'; // özel karakter

	$kullanici_password=md5($kullanici_eskipassword);

	$kullanicisor=$dbsql->wread("kullanici","kullanici_password",$kullanici_password);

	$say=$kullanicisor->rowCount();

	if ($say==0) {
		
		Header("Location:../../sifre-guncelle?durum=eskisifrehata");
		exit;


	}

	if ($kullanici_passwordone==$kullanici_passwordtwo) {

		if(!preg_match_all($regex_lowercase,$kullanici_passwordone) || !preg_match_all($regex_uppercase,$kullanici_passwordone) || !preg_match_all($regex_number,$kullanici_passwordone) || !preg_match_all($regex_special,$kullanici_passwordone))
		{
			Header("Location:../../sifre-guncelle?durum=eksiksifre");
			exit();
		}

		if (strlen($kullanici_passwordone)>=6) {


			$sifre=$kullanici_passwordone;


			$kullaniciguncelle=$dbsql->update("kullanici",array(
				'kullanici_password' => $sifre,
				'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
			),[
				'pass' => 'kullanici_password',
				'columns' => 'kullanici_id'
			]);

			if ($kullaniciguncelle['status']) {

				Header("Location:../../sifre-guncelle?durum=ok");

			} else {

				Header("Location:../../sifre-guncelle?durum=hata");
			}

		} else {

			Header("Location:../../sifre-guncelle?durum=eksiksifre");
			exit;

		}

		
	} else {


		Header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");
		exit;
	}
}

if (isset($_POST['musterimagazabasvuru'])) {
	
	$kullaniciguncelle=$dbsql->update("kullanici",array(
		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
		'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),
		'kullanici_tip' => htmlspecialchars($_POST['kullanici_tip']),
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_magaza' => 1,
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($kullaniciguncelle['status']) {
		
		Header("Location:../../magaza-basvuru");

	} else {

		Header("Location:../../magaza-basvuru?durum=hata");
	}
}

if (isset($_POST['sipariskaydet'])) {
	
	$kaydet=$dbsql->insert("siparis",array(
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
		'kullanici_idsatici' => htmlspecialchars($_POST['kullanici_idsatici'])
	));

	if ($kaydet['status']) {

		$siparissonsor=$dbsql->read("siparis",[
			"columns_name" => "siparis_id",
			"columns_sort" => "DESC",
			"limit" => 1
		]);
		$siparissoncek=$siparissonsor->fetch(PDO::FETCH_ASSOC);
		$siparis_id=$siparissoncek['siparis_id'];
		$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
		$kargo_no = substr(str_shuffle($str), 0, 10);

		$sipariskaydet=$dbsql->insert("siparis_detay",array(
			'siparis_id' => $siparis_id,
			'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
			'kullanici_idsatici' => htmlspecialchars($_POST['kullanici_idsatici']),
			'urun_id' => htmlspecialchars($_POST['urun_id']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'siparisdetay_kargono' => htmlspecialchars($kargo_no),
			'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
		));

		if ($sipariskaydet['status']) {

			$stoksor=$dbsql->wread("urun","urun_id",htmlspecialchars($_POST['urun_id']));
			$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
			$stokadet=0;
			$stokadet=$stokcek['urun_stok'];
			$adet=htmlspecialchars($_POST['urun_adet']);
			$stokadet-=$adet;

			$stokduzenle=$dbsql->update("urun",array(
				'urun_stok' => $stokadet,
				'urun_id' => htmlspecialchars($_POST['urun_id'])
			),[
				'columns' => 'urun_id'
			]);

			if ($stokcek['urun_stok']==1)
			{
				$duzenle=$dbsql->update("urun",array(
					'urun_durum' => 0,
					'urun_id' => htmlspecialchars($_POST['urun_id'])
				),[
					'columns' => 'urun_id'
				]);
			}

			Header("Location:../../siparislerim.php");

		}

		else {

			Header("Location:../../404.php");

		}

	} else {

		Header("Location:../../404.php");
	}
}

if (isset($_POST['sepetsiparis'])) {

	if (isset($_SESSION['userkullanici_id'])==0)
	{
		Header("Location:../../login");
	}

	$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
	$kargo_no = substr(str_shuffle($str), 0, 10);
	
	$urunsor=$dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(

		'sepet.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id'])
	));

	$urunsor2=$dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(

		'sepet.kullanici_id' =>  htmlspecialchars($_SESSION['userkullanici_id'])
	));

	while ($uruncek2=$urunsor2->fetch(PDO::FETCH_ASSOC)) 
	{
		if ($uruncek2['urun_stok']-$uruncek2['urun_adet']<=0)
		{
			$stok_adi=$uruncek2['urun_ad'];
			Header("Location:../../cart.php?durum=kalmadı&urun_adi=$stok_adi");
			exit();
		}
	}

	while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) 
	{
		$satici_id=$uruncek['id'];
		$kaydet=$dbsql->insert("siparis",array(

			'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
			'kullanici_idsatici' => htmlspecialchars($satici_id)
		));

		if ($kaydet['status']) {


			$siparissonsor=$dbsql->read("siparis",[
				"columns_name" => "siparis_id",
				"columns_sort" => "DESC",
				"limit" => 1
			]);
			$siparissoncek=$siparissonsor->fetch(PDO::FETCH_ASSOC);
			$siparis_id=$siparissoncek['siparis_id'];

			$sipariskaydet=$dbsql->insert("siparis_detay",array(
				'siparis_id' => $siparis_id,
				'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
				'kullanici_idsatici' => htmlspecialchars($satici_id),
				'urun_id' => htmlspecialchars($uruncek['urun_id']),
				'urun_fiyat' => htmlspecialchars($uruncek['urun_fiyat']),
				'urun_adet' => htmlspecialchars($uruncek['urun_adet']),
				'siparisdetay_kargono' => htmlspecialchars($kargo_no),
				'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
			));

			if ($sipariskaydet['status']) {


				$stoksor=$dbsql->wread("urun","urun_id",$uruncek['urun_id']);
				$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
				$stokadet=0;
				$stokadet=$stokcek['urun_stok'];
				$adet=$uruncek['urun_adet'];
				$stokadet-=$adet;

				$stokduzenle=$dbsql->update("urun",array(
					'urun_stok' => $stokadet,
					'urun_id' => $uruncek['urun_id']
				),[
					'columns' => 'urun_id'
				]);

				if ($stokcek['urun_stok']==1)
				{
					$duzenle=$dbsql->update("urun",array(
						'urun_durum' => 0,
						'urun_id' => $uruncek['urun_id']
					),[
						'columns' => 'urun_id'
					]);
				}

				$sil=$dbsql->delete("sepet","sepet_id",$uruncek['sepet_id']);

				Header("Location:../../siparislerim.php");

			}

			else {

				Header("Location:../../404.php");

			}

		} else {

			Header("Location:../../404.php");

		}
	}
}

if (isset($_POST['sepetmisafir']))
{
	$kullanicikaydet=$dbsql->insert("kullanici",array(
		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' =>  htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_mail' =>  htmlspecialchars($_POST['kullanici_mail']),
		'kullanici_gsm' =>  htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'misafir_no' => htmlspecialchars($_COOKIE['userid'])
	));

	if ($kullanicikaydet['status'])
	{
		$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
		$kargo_no = substr(str_shuffle($str), 0, 10);

		$kullanicisor=$dbsql->wread("kullanici","misafir_no",htmlspecialchars($_COOKIE['userid']));
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

		$urunsor=$dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(
			'sepet.kullanici_id' =>  htmlspecialchars($_COOKIE['userid'])
		));

		$urunsor2=$dbsql->qwSql("SELECT urun.kullanici_id as id,urun.*,sepet.* FROM urun INNER JOIN sepet ON sepet.urun_id=urun.urun_id",array(
			'sepet.kullanici_id' =>  htmlspecialchars($_COOKIE['userid'])
		));

		while ($uruncek2=$urunsor2->fetch(PDO::FETCH_ASSOC)) 
		{
			if ($uruncek2['urun_stok']-$uruncek2['urun_adet']<=0)
			{
				$sil=$dbsql->delete("kullanici","kullanici_id",$kullanicicek['kullanici_id']);
				$stok_adi=$uruncek2['urun_ad'];
				Header("Location:../../cart.php?durum=kalmadı&urun_adi=$stok_adi");
				exit();
			}
		}
		while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) 
		{
			$satici_id=$uruncek['id'];
			$kaydet=$dbsql->insert("siparis",array(
				'kullanici_id' => htmlspecialchars($kullanicicek['kullanici_id']),
				'kullanici_idsatici' => htmlspecialchars($satici_id)
			));

			if ($kaydet['status']) {


				$siparissonsor=$dbsql->read("siparis",[
					"columns_name" => "siparis_id",
					"columns_sort" => "DESC",
					"limit" => 1
				]);
				$siparissoncek=$siparissonsor->fetch(PDO::FETCH_ASSOC);
				$siparis_id=$siparissoncek['siparis_id'];

				$sipariskaydet=$dbsql->insert("siparis_detay",array(
					'siparis_id' => $siparis_id,
					'kullanici_id' => htmlspecialchars($kullanicicek['kullanici_id']),
					'kullanici_idsatici' => htmlspecialchars($satici_id),
					'urun_id' => htmlspecialchars($uruncek['urun_id']),
					'urun_fiyat' => htmlspecialchars($uruncek['urun_fiyat']),
					'urun_adet' => htmlspecialchars($uruncek['urun_adet']),
					'siparisdetay_kargono' => htmlspecialchars($kargo_no),
					'islem_kullanici_id' =>	"-"
				));

				if ($sipariskaydet['status']) {

					$stoksor=$dbsql->wread("urun","urun_id",$uruncek['urun_id']);
					$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
					$stokadet=0;
					$stokadet=$stokcek['urun_stok'];
					$adet=$uruncek['urun_adet'];
					$stokadet-=$adet;
					if ($stokadet<0)
					{
						Header("Location:../../cart.php?durum=kalmadı");
						exit();
					}

					$stokduzenle=$dbsql->update("urun",array(
						'urun_stok' => $stokadet,
						'urun_id' => $uruncek['urun_id']
					),[
						'columns' => 'urun_id'
					]);

					if ($stokcek['urun_stok']==1)
					{
						$duzenle=$dbsql->update("urun",array(
							'urun_durum' => 0,
							'urun_id' => $uruncek['urun_id']
						),[
							'columns' => 'urun_id'
						]);
					}

					setcookie("userid", $userid,strtotime("-1 day"),'/');

					Header("Location:../../siparis_tamamlandi.php");

				}

				else {

					Header("Location:../../404.php");

				}

			} else {

				Header("Location:../../404.php");

			}
		}
	}
}

if ($_GET['urunonay']=="ok") {

	$siparis_id=htmlspecialchars($_GET['siparis_id']);

	$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
		'siparisdetay_onay' => 2,
		'siparisdetay_id' => htmlspecialchars($_GET['siparisdetay_id']),
		'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
	),[
		'columns' => 'siparisdetay_id'
	]);

	if ($siparis_detayguncelle['status']) {
		
		Header("Location:../../siparis-detay.php?siparis_id=$siparis_id");

	} else {

		Header("Location:../../siparis-detay.php?siparis_id=$siparis_id?durum=no");
	}
}

if ($_GET['urunteslim']=="ok") {

	$siparis_id=htmlspecialchars($_GET['siparis_id']);

	$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
		'siparisdetay_onay' => 1,
		'siparisdetay_id' => htmlspecialchars($_GET['siparisdetay_id']),
		'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
	),[
		'columns' => 'siparisdetay_id'
	]);

	if ($siparis_detayguncelle['status']) {
		
		Header("Location:../../yeni-siparisler.php?siparis_id=$siparis_id");

	} else {

		//Header("Location:../production/magazalar.php?durum=no");
	}
}

if (isset($_POST['puanyorumekle'])) {

	$idler=rtrim(htmlspecialchars($_POST['urun_id']),",");
	$urun_id=array();
	$urun_id=explode(",",$idler);
	$adet=count($urun_id);	
	$siparis_id=htmlspecialchars($_POST['siparis_id']);

	for ($i=0; $i<$adet;$i++)
	{
		$kaydet=$dbsql->insert("yorumlar",array(
			'yorum_puan' => htmlspecialchars($_POST['yorum_puan']),
			'urun_id' => $urun_id[$i],
			'yorum_detay' => htmlspecialchars($_POST['yorum_detay']),
			'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
		));


		//$siparis_id=htmlspecialchars($_POST['siparis_id']);

		if ($kaydet['status']) {

			$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
				'siparisdetay_yorum' => 1,
				'siparis_id' => $siparis_id,
				'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
			),[
				'columns' => 'siparis_id'
			]);
			++$siparis_id;
			Header("Location:../../index.php");

		} else {

			Header("Location:../../siparis-detay");

		}
	}
}

if (isset($_POST['mesajgonder'])) {

	$kullanici_gel=htmlspecialchars($_POST['kullanici_gel']);
	$aciklama="";

	for ($i=1;$i<3;$i++)
	{
		if($i==1)
		{
			$aciklama="gonderen";
		}
		if($i==2)
		{
			$aciklama="alici";
		}
		$kaydet=$dbsql->insert("mesaj",array(
			'mesaj_detay' => htmlspecialchars($_POST['mesaj_detay']),
			'mesaj_konu' => htmlspecialchars($_POST['mesaj_konu']),
			'kullanici_gel' => htmlspecialchars($_POST['kullanici_gel']),
			'kullanici_gon' => htmlspecialchars($_SESSION['userkullanici_id']),
			'kullanici_id' => $_SESSION['userkullanici_id'],
			'aciklama' => htmlspecialchars($aciklama)
		));

		if ($kaydet['status']) {

			Header("Location:../../mesaj-gonder?durum=ok&kullanici_gel=$kullanici_gel");

		} else {

			Header("Location:../../mesaj-gonder?durum=no&kullanici_gel=$kullanici_gel");
		}
	}
}

if (isset($_POST['mesajolustur'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanicisor=$dbsql->wread("kullanici","kullanici_mail",$kullanici_mail);
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
	$aciklama="";

	for ($i=1;$i<3;$i++)
	{
		if($i==1)
		{
			$aciklama="gonderen";
		}
		if($i==2)
		{
			$aciklama="alici";
		}
		$kaydet=$dbsql->insert("mesaj",array(
			'mesaj_detay' => htmlspecialchars($_POST['mesaj_detay']),
			'mesaj_konu' => htmlspecialchars($_POST['mesaj_konu']),
			'kullanici_gel' => htmlspecialchars($kullanicicek['kullanici_id']),
			'kullanici_gon' => htmlspecialchars($_SESSION['userkullanici_id']),
			'aciklama' => htmlspecialchars($aciklama),
			'kullanici_id' => $_SESSION['userkullanici_id']
		));

		if ($kaydet['status']) {
			
			Header("Location:../../mesaj-olustur?durum=ok");

		} else {

			Header("Location:../../mesaj-olustur?durum=no");
		}
	}
}

if (isset($_POST['mesajcevapver'])) {

	$kullanici_gel=htmlspecialchars($_POST['kullanici_gel']);
	

	$aciklama="";

	for ($i=1;$i<3;$i++)
	{
		if($i==1)
		{
			$aciklama="gonderen";
		}
		if($i==2)
		{
			$aciklama="alici";
		}
		$kaydet=$dbsql->insert("mesaj",array(
			'mesaj_detay' => htmlspecialchars($_POST['mesaj_detay']),
			'mesaj_konu' => htmlspecialchars($_POST['mesaj_konu']),
			'kullanici_gel' => htmlspecialchars($_POST['kullanici_gel']),
			'kullanici_gon' => htmlspecialchars( $_SESSION['userkullanici_id']),
			'aciklama' => htmlspecialchars($aciklama),
			'kullanici_id' => $_SESSION['userkullanici_id']
		));

		if ($kaydet['status']) {
			
			Header("Location:../../gelen-mesajlar?durum=ok");

		} else {

			Header("Location:../../gelen-mesajlar?durum=hata");

		}
	}
}

if ($_GET['gidenmesajsil']=="ok") {

	$sil=$dbsql->delete("mesaj","mesaj_id",htmlspecialchars($_GET['mesaj_id']));

	if ($sil['status']) {

		Header("Location:../../giden-mesajlar.php?durum=ok");

	} else {

		Header("Location:../../giden-mesajlar.php?durum=hata");
	}

}

if ($_GET['gelenmesajsil']=="ok") {

	$sil=$dbsql->delete("mesaj","mesaj_id",htmlspecialchars($_GET['mesaj_id']));

	if ($sil['status']) {

		Header("Location:../../gelen-mesajlar.php?durum=ok");

	} else {

		Header("Location:../../gelen-mesajlar.php?durum=hata");
	}
}

?>