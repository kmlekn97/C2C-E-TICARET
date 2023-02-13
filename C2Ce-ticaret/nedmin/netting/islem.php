<?php

ob_start();
session_start();

require_once 'baglan.php';
include '../production/fonksiyon.php';
require_once 'class.crud-guncel.php';
$dbsql=new crud();

if (isset($_POST['kullaniciresimguncelle'])) {

	$duzenle=$dbsql->update("kullanici",array(

		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	),[
		'columns' => 'kullanici_id',
		'dir' => 'userphoto',
		"file_name" => 'kullanici_magazafoto',
		"file_delete" => htmlspecialchars($_POST['eski_yol']),
		"dosyalink" => "../../profil-resim-guncelle.php",
		"width" => 128,
		"height" => 128
	]);
}


if (isset($_POST['sliderkaydet'])) {

	$kaydet=$dbsql->insert("slider",array(
		'slider_ad' => htmlspecialchars($_POST['slider_ad']),
		'slider_sira' => htmlspecialchars($_POST['slider_sira']),
		'slider_link' => htmlspecialchars($_POST['slider_link']),
		'kullanici_id' => $_SESSION['kullanici_id']
	),[
		'dir' => 'slider',
		"file_name" => 'slider_resimyol',
		"dosyalink" => "../production/slider.php"
	]);
}

if (isset($_POST['slider_create'])) {

	$fiyat=0;
	if ($_POST['slider_sure']==1)
	{
		$fiyat=60;
		$sil=$db->prepare("CREATE EVENT `slider_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM slider WHERE slider.slider_zaman <DATE_SUB(NOW(), INTERVAL ".htmlspecialchars($_POST['slider_sure'])." DAY) and slider_sure=1");
		$kontrol=$sil->execute();
	}
	else if ($_POST['slider_sure']>1 && $_POST['slider_sure']<=5)
	{
		$fiyat=95;
		$sil=$db->prepare("CREATE EVENT `slider_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM slider WHERE slider.slider_zaman <DATE_SUB(NOW(), INTERVAL ".htmlspecialchars($_POST['slider_sure'])." DAY) and (slider_sure>1 and slider_sure <=5)");
		$kontrol=$sil->execute();
	}
	else if ($_POST['slider_sure']>5 && $_POST['slider_sure']<=10)
	{
		$fiyat=150;
		$sil=$db->prepare("CREATE EVENT `slider_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM slider WHERE slider.slider_zaman <DATE_SUB(NOW(), INTERVAL ".htmlspecialchars($_POST['slider_sure'])." DAY) and (slider_sure>5 and slider_sure <=10)");
		$kontrol=$sil->execute();
	}
	else if ($_POST['slider_sure']>20 && $_POST['slider_sure']<=30)
	{
		$fiyat=200;
		$sil=$db->prepare("CREATE EVENT `slider_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM slider WHERE slider.slider_zaman <DATE_SUB(NOW(), INTERVAL ".htmlspecialchars($_POST['slider_sure'])." DAY) and (slider_sure>20 and slider_sure <=30)");
		$kontrol=$sil->execute();
	}
	else
	{
		$fiyat=300;
		$sil=$db->prepare("CREATE EVENT `slider_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM slider WHERE slider.slider_zaman <DATE_SUB(NOW(), INTERVAL ".htmlspecialchars($_POST['slider_sure'])." DAY) and slider_sure>30");
		$kontrol=$sil->execute();
	}

	$kaydet=$dbsql->insert("slider",array(
		'slider_link' => htmlspecialchars($_POST['slider_link']),
		'slider_sure' => htmlspecialchars($_POST['slider_sure']),
		'slider_fiyat' =>htmlspecialchars($fiyat),
		'kullanici_id' => $_SESSION['userkullanici_id'] 
	),[
		'dir' => 'slider',
		"file_name" => 'slider_resimyol',
		"dosyalink" => "../../slider_basvuru.php"
	]);
}



// Slider Düzenleme Başla


if (isset($_POST['sliderduzenle'])) {

	$slider_id=htmlspecialchars($_POST['slider_id']);
	
	if($_FILES['slider_resimyol']["size"] > 0)  { 

		$duzenle=$dbsql->update("slider",array(
			'slider_ad' => htmlspecialchars($_POST['slider_ad']),
			'slider_link' => htmlspecialchars($_POST['slider_link']),
			'slider_sira' => htmlspecialchars($_POST['slider_sira']),
			'slider_durum' => htmlspecialchars($_POST['slider_durum']),
			'kullanici_id' => $_SESSION['kullanici_id'],
			'slider_id' => htmlspecialchars($_POST['slider_id'])
		),[
			'columns' => 'slider_id',
			'dir' => 'slider',
			"file_name" => 'slider_resimyol',
			"file_delete" => htmlspecialchars($_POST['eski_yol'])
		]);
		if ($duzenle['status'])
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		else
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=no");

	} else {

		$duzenle=$dbsql->update("slider",array(
			'slider_ad' => htmlspecialchars($_POST['slider_ad']),
			'slider_link' => htmlspecialchars($_POST['slider_link']),
			'slider_sira' => htmlspecialchars($_POST['slider_sira']),
			'slider_durum' => htmlspecialchars($_POST['slider_durum']),
			'kullanici_id' => $_SESSION['kullanici_id'],
			'slider_id' => htmlspecialchars($_POST['slider_id'])
		),[
			'columns' => 'slider_id'
		]);
		if ($duzenle['status'])
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
		else
			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=no");
	}

}


// Slider Düzenleme Bitiş

if ($_GET['slidersil']=="ok") {
	islemkontrol();
	$resimsilunlink=htmlspecialchars($_GET['slider_resimyol']);
	$sil=$dbsql->delete("slider","slider_id",htmlspecialchars($_GET['slider_id']),"../../$resimsilunlink");
	if ($sil['status'])
		Header("Location:../production/slider.php?durum=ok");
	else
		Header("Location:../production/slider.php?durum=no");
}

if ($_GET['slidereskilerisil']=="ok") {
	


	$files = glob("..\..\dimg\slider/*.{jpg,gif,png,jpeg}", GLOB_BRACE);

		/* 
		 * Dizindeki tüm dosyalara işlem uygulanır 
		 */
		foreach (glob("..\..\dimg\slider/*.{jpg,gif,png,jpeg}", GLOB_BRACE) as $file) {
		/* 
		 * 1 gün = 24 saat = 86400 saniye (bir günden eski tüm dosyaları siler 
		 */

		if(time() - filectime($file) > 5000000){
			unlink("..\..\dimg\slider/$files");
		}
	}
	Header("Location:../production/slider.php?durum=ok");

}



if (isset($_POST['logoduzenle'])) {

	$duzenle=$dbsql->update("ayar",array(
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id',
		'dir' => 'logo',
		"file_name" => 'ayar_logo',
		"file_delete" => htmlspecialchars($_POST['eski_yol']),
		"dosyalink"  => "../production/genel-ayar.php"
	]);

	if ($duzenle['status']) {
		unlink("../../img/mobile-logo.png");
		unlink("../../kampanya/kampanya.png");
		$ayarsor=$dbsql->wread("ayar","ayar_id",0);
		$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

		$logo="../../".$ayarcek['ayar_logo'];

		copy($logo,"../../dimg/kampanya/kampanya.png");
		unlink("../../img/logo.png");
		copy($logo,"../../img/logo.png");
	} 
}


if (isset($_POST['profilfotochange'])) {
	$duzenle=$dbsql->update("kullanici",array(
		'kullanici_mail' => htmlspecialchars($_SESSION['kullanici_mail'])
	),[
		'columns' => 'kullanici_mail',
		'dir' => 'adminphoto',
		"file_name" => 'kullanici_resim',
		"file_delete" => htmlspecialchars($_POST['eski_yol']),
		"dosyalink"  => "../production/profilephoto.php"
	]);
}


if (isset($_POST['admingiris'])) {

	if (isset($_POST['remember_me']))
	{
		$remember=1;
	}
	else
	{
		$remember=0;
	}
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password']));

	if (isset($_COOKIE['adminsLogin']))
	{
		$kullanici_password=htmlspecialchars($_POST['kullanici_password']);
	}

	$kullanicisor=$dbsql->qwSql("SELECT * FROM kullanici",array(
		'kullanici_mail' => $kullanici_mail,
		'kullanici_password' => $kullanici_password,
		'kullanici_yetki' => 5
	));
	echo $say=$kullanicisor->rowCount();
	if ($say==1) {
		$_SESSION['kullanici_mail']=$kullanici_mail;
		setcookie("remmeber_me",$remember,strtotime("+30 day"),"/");
		setcookie("oturumdurum",1,strtotime("+30 day"),"/");
		header("Location:../production/index.php");
		exit();
	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
}

if (isset($_POST['kullanicigiris'])) {

	if (isset($_POST['remember_me']))
	{
		$remember=1;
	}
	else
	{
		$remember=0;
	}
	
	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
	echo $kullanici_password=md5(htmlspecialchars($_POST['kullanici_password'])); 

	if (isset($_COOKIE['userLogin']))
	{
		$kullanici_password=htmlspecialchars($_POST['kullanici_password']);
	}
	$kullanicisor=$dbsql->qwSql("SELECT * from kullanici",array(
		'kullanici_mail' => $kullanici_mail,
		'kullanici_yetki' => 1,
		'kullanici_password' => $kullanici_password,
		'kullanici_durum' => 1
	));
	$say=$kullanicisor->rowCount();
	if ($say==1) {

		echo $_SESSION['userkullanici_mail']=$kullanici_mail;
		setcookie("remmeber_me",$remember,strtotime("+30 day"),"/");
		setcookie("oturumdurum",1,strtotime("+30 day"),"/");
		header("Location:../../");
		exit;
	} else {
		header("Location:../../?durum=basarisizgiris");
	}
}

if (isset($_POST['genelayarkaydet'])) {
	$ayarkaydet=$dbsql->update("ayar",array(
		'ayar_title' => htmlspecialchars($_POST['ayar_title']),
		'ayar_description' => htmlspecialchars($_POST['ayar_description']),
		'ayar_keywords' => htmlspecialchars($_POST['ayar_keywords']),
		'ayar_author' => htmlspecialchars($_POST['ayar_author']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);
	if ($ayarkaydet['status'])
		header("Location:../production/genel-ayar.php?durum=ok");
	else
		header("Location:../production/genel-ayar.php?durum=no");
}

if (isset($_POST['sitedurumdegistir'])) {
	$ayarkaydet=$dbsql->update("ayar",array(
		'ayar_bakim' => htmlspecialchars($_POST['ayar_bakim']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet) {

		header("Location:../production/genel-ayar.php?durum=ok");
	} else {

		header("Location:../production/genel-ayar.php?durum=no");
	}
}

if (isset($_POST['iletisimayarkaydet'])) {
	$ayarkaydet=$dbsql->update("ayar",array(
		'ayar_tel' => htmlspecialchars($_POST['ayar_tel']),
		'ayar_gsm' => htmlspecialchars($_POST['ayar_gsm']),
		'ayar_faks' => htmlspecialchars($_POST['ayar_faks']),
		'ayar_mail' => htmlspecialchars($_POST['ayar_mail']),
		'ayar_ilce' => htmlspecialchars($_POST['ayar_ilce']),
		'ayar_il' => htmlspecialchars($_POST['ayar_il']),
		'ayar_adres' => htmlspecialchars($_POST['ayar_adres']),
		'ayar_mesai' => htmlspecialchars($_POST['ayar_mesai']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet['status']) {

		header("Location:../production/iletisim-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
	
}


if (isset($_POST['apiayarkaydet'])) {

	$ayarkaydet=$dbsql->update("ayar",array(

		'ayar_analystic' => htmlspecialchars($_POST['ayar_analystic']),
		'ayar_maps' => htmlspecialchars($_POST['ayar_maps']),
		'ayar_zopim' => htmlspecialchars($_POST['ayar_zopim']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet['status']) {

		header("Location:../production/api-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/api-ayarlar.php?durum=no");
	}
	
}

if (isset($_POST['hakkimizdakaydet'])) {
	
	$ayarkaydet=$dbsql->update("hakkimizda",array(
		'hakkimizda_baslik' => htmlspecialchars($_POST['hakkimizda_baslik']),
		'hakkimizda_icerik' => htmlspecialchars($_POST['hakkimizda_icerik']),
		'hakkimizda_video' => htmlspecialchars($_POST['hakkimizda_video']),
		'hakkimizda_vizyon' => htmlspecialchars($_POST['hakkimizda_vizyon']),
		'hakkimizda_misyon' => htmlspecialchars($_POST['hakkimizda_misyon']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'hakkimizda_id' => 0
	),[
		'columns' => 'hakkimizda_id'
	]);

	if ($ayarkaydet['status']) {

		header("Location:../production/hakkimizda.php?durum=ok");

	} else {

		header("Location:../production/hakkimizda.php?durum=no");
	}
	
}

if (isset($_POST['kullaniciadminekaydet'])) 
{
	$kullanici_mail=htmlspecialchars(trim($_POST['kullanici_mail'])); 
	$kullanici_tip=htmlspecialchars($_POST['kullanici_tip']);
	$kullanici_yetki=1;
	$kullanici_magaza;
	if ($kullanici_tip=="Alıcı")
	{
		$kullanici_tip="PERSONAL";
		$kullanici_magaza=0;
	}
	else if ($kullanici_tip=="Bireysel Satıcı") 
	{
		$kullanici_tip="PERSONAL";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Satıcı(L.T.D.)") 
	{
		$kullanici_tip="PRIVATE_COMPANY";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Satıcı(A.Ş.)") 
	{
		$kullanici_tip="INCORPORATED_COMPANY";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Şirket Çalışanı") 
	{
		$kullanici_tip="LIMITED_OR_JOINT_STOCK_COMPANY";
		$kullanici_magaza=2;
		$kullanici_yetki=5;
	}
	else
	{
		$kullanici_tip="TECHNİCAL_PERSON";
		$kullanici_magaza=2;
		$kullanici_yetki=5;
	}
	$kullanicisor=$dbsql->wread("kullanici","kullanici_mail",$kullanici_mail);
	$say=$kullanicisor->rowCount();
	if($say==0)
	{
		$kullaniciguncelle=$dbsql->insert("kullanici",array(
			'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
			'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
			'kullanici_mail' => htmlspecialchars($_POST['kullanici_mail']),
			'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
			'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
			'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
			'kullanici_tip' => htmlspecialchars($kullanici_tip),
			'kullanici_magaza' => htmlspecialchars($kullanici_magaza),
			'kullanici_yetki' => htmlspecialchars($kullanici_yetki),
			'kullanici_password' => htmlspecialchars($_POST['kullanici_passwordone'])
		),['pass' => 'kullanici_password']);

		if ($kullaniciguncelle['status']) 
		{	
			Header("Location:../production/kullanici.php?durum=ok");
		} 
		else 
		{
			Header("Location:../production/kullanici-ekle.php?durum=no");
		}	
	}
	else 
	{
		header("Location:../production/kullanici-ekle.php?durum=mukerrerkayit");
	}
}

if (isset($_POST['kullaniciduzenle'])) 
{
	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);
	$kullanici_tip=htmlspecialchars($_POST['kullanici_tip']);
	$kullanici_yetki=1;
	$kullanici_magaza;
	if ($kullanici_tip=="Alıcı")
	{
		$kullanici_tip="PERSONAL";
		$kullanici_magaza=0;
	}
	else if ($kullanici_tip=="Bireysel Satıcı") 
	{
		$kullanici_tip="PERSONAL";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Satıcı(L.T.D.)") 
	{
		$kullanici_tip="PRIVATE_COMPANY";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Satıcı(A.Ş.)") 
	{
		$kullanici_tip="INCORPORATED_COMPANY";
		$kullanici_magaza=2;
	}
	else if ($kullanici_tip=="Şirket Çalışanı") 
	{
		$kullanici_tip="LIMITED_OR_JOINT_STOCK_COMPANY";
		$kullanici_magaza=2;
		$kullanici_yetki=5;
	}
	else
	{
		$kullanici_tip="TECHNİCAL_PERSON";
		$kullanici_magaza=2;
		$kullanici_yetki=5;
	}

	$kullaniciguncelle=$dbsql->update("kullanici",array(

		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_tip' => htmlspecialchars($kullanici_tip),
		'kullanici_magaza' => htmlspecialchars($kullanici_magaza),
		'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_yetki' => htmlspecialchars($kullanici_yetki),
		'kullanici_durum' => htmlspecialchars($_POST['kullanici_durum']),
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id'])

	),[
		'columns' => 'kullanici_id'
	]);


	if ($kullaniciguncelle['status']) {
		
		Header("Location:../production/kullanici.php?durum=ok&kullanici_id=$kullanici_id");


	} else {

		Header("Location:../production/kullanici-duzenle.php?durum=no&kullanici_id=$kullanici_id");
	}

}

if ($_GET['kullanicisil']=="ok") {


	$resimsilunlink=htmlspecialchars($_GET['kullanicifoto_resimyol']);
	$dosya = "../../$resimsilunlink";

	if ($resimsilunlink=="img/profile/3.png")
	{
		$sil=$dbsql->delete("kullanici","kullanici_id",htmlspecialchars($_GET['kullanici_id']));
	}
	else
	{
		$sil=$dbsql->delete("kullanici","kullanici_id",htmlspecialchars($_GET['kullanici_id']),$dosya);
	}

	$yorumsil=$dbsql->delete("yorumlar","kullanici_id",htmlspecialchars($_GET['kullanici_id']));
	$siparissil=$dbsql->delete("siparis","kullanici_id",htmlspecialchars($_GET['kullanici_id']));
	$sikayetsil=$dbsql->delete("sikayet","kullanici_id",htmlspecialchars($_GET['kullanici_id']));
	$mesajsil=$dbsql->delete("mesaj","kullanici_id",htmlspecialchars($_GET['kullanici_id']));
	$favorilersil=$dbsql->delete("favoriler","kullanici_id",htmlspecialchars($_GET['kullanici_id']));


	if ($sil['status']) {


		header("location:../production/kullanici.php?sil=ok");


	} else {

		header("location:../production/kullanici.php?sil=no");

	}
}

if (isset($_POST['kategoriduzenle'])) {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);
	
	$kategori_id=htmlspecialchars($_POST['kategori_id']);
	$kategori_seourl=seo(htmlspecialchars($_POST['kategori_ad']));
	$kaydet=$dbsql->update("kategori",array(
		'kategori_ad' => htmlspecialchars($_POST['kategori_ad']),
		'kategori_oran' => htmlspecialchars($_POST['kategori_oran']),
		'kategori_durum' => htmlspecialchars($_POST['kategori_durum']),
		'kategori_seourl' => htmlspecialchars($kategori_seourl),
		'kategori_onecikar' => htmlspecialchars($_POST['kategori_onecikar']),
		'kategori_sira' => htmlspecialchars($_POST['kategori_sira']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 		
	),[
		'columns' => 'kategori_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/kategori.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
	}

}


if (isset($_POST['kategoriekle'])) {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);
	$kategori_seourl=seo(htmlspecialchars($_POST['kategori_ad']));

	$kaydet=$dbsql->insert("kategori",array(
		'kategori_ad' => htmlspecialchars($_POST['kategori_ad']),
		'kategori_oran' => htmlspecialchars($_POST['kategori_oran']),
		'kategori_durum' => htmlspecialchars($_POST['kategori_durum']),
		'kategori_seourl' => htmlspecialchars($kategori_seourl),
		'kategori_sira' => htmlspecialchars($_POST['kategori_sira']),
		'kullanici_id' => $kullanici_id	
	));

	if ($kaydet['status']) {

		Header("Location:../production/kategori.php?durum=ok");

	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}

if (isset($_POST['altkategoriekle'])) {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);


	$kategori_id=htmlspecialchars($_POST['kategori_id']);
	$alt_kategori_seourl=seo($_POST['alt_kategori_ad']);
	$kaydet=$dbsql->insert("alt_kategori",array(
		'alt_kategori_ad' => htmlspecialchars($_POST['alt_kategori_ad']),
		'alt_kategori_durum' => htmlspecialchars($_POST['alt_kategori_durum']),
		'alt_kategori_seourl' => htmlspecialchars($alt_kategori_seourl),
		'alt_kategori_sira' => htmlspecialchars($_POST['alt_kategori_sira']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'kullanici_id' => $kullanici_id
	));

	if ($kaydet['status']) {

		Header("Location:../production/altkategori.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/altkategori.php?durum=no&kategori_id=$kategori_id");
	}

}

if (isset($_POST['altkategoriduzenle'])) {


	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);

	$kategori_id=htmlspecialchars($_POST['kategori_id']);
	$alt_kategori_seourl=seo(htmlspecialchars($_POST['alt_kategori_ad']));
	$kaydet=$dbsql->update("alt_kategori",array(
		'alt_kategori_ad' => htmlspecialchars($_POST['alt_kategori_ad']),
		'alt_kategori_durum' => htmlspecialchars($_POST['alt_kategori_durum']),
		'alt_kategori_sira' => htmlspecialchars($_POST['alt_kategori_sira']),
		'alt_kategori_seourl' => htmlspecialchars($alt_kategori_seourl),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 			
	),[
		'columns' => 'alt_kategori_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/altkategori.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/altkategori.php?durum=no&kategori_id=$kategori_id");
	}

}

if ($_GET['altkategorisil']=="ok") {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);


	$kategori_id=htmlspecialchars($_GET['kategori_id']);
	$sil=$dbsql->delete("alt_kategori","alt_kategori_id",htmlspecialchars($_GET['alt_kategori_id']));
	$alt_detay_sil=$dbsql->delete("alt_kategori_detay","alt_kategori_id",htmlspecialchars($_GET['alt_kategori_id']));
	if ($sil['status']) {

		if ($alt_detay_sil['status'])
		{

			Header("Location:../production/altkategori.php?durum=ok&kategori_id=$kategori_id");
		}

	} else {

		Header("Location:../production/altkategori.php?durum=no&kategori_id=$kategori_id");
	}

}

if (isset($_POST['altkategoridetayekle'])) {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);

	$alt_kategori_id=htmlspecialchars($_POST['alt_kategori_id']);
	$alt_kategori_detay_seourl=seo(htmlspecialchars($_POST['alt_kategori_detay_ad']));
	$kaydet=$dbsql->insert("alt_kategori_detay",array(
		'alt_kategori_detay_ad' => htmlspecialchars($_POST['alt_kategori_detay_ad']),
		'alt_kategori_detay_durum' => htmlspecialchars($_POST['alt_kategori_detay_durum']),
		'alt_kategori_detay_seourl' => htmlspecialchars($alt_kategori_detay_seourl),
		'alt_kategori_detay_sira' => htmlspecialchars($_POST['alt_kategori_detay_sira']),
		'alt_kategori_id' => htmlspecialchars($alt_kategori_id),
		'kullanici_id' => $kullanici_id
	));

	if ($kaydet['status']) {

		Header("Location:../production/altkategoridetay.php?durum=ok&alt_kategori_id=$alt_kategori_id");

	} else {

		Header("Location:../production/altkategoridetay.php?durum=no&alt_kategori_id=$alt_kategori_id");
	}

}


if (isset($_POST['altkategoridetayduzenle'])) {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);

	$alt_kategori_id=htmlspecialchars($_POST['alt_kategori_id']);
	$alt_kategori_detay_seourl=seo(htmlspecialchars($_POST['alt_kategori_detay_ad']));
	$kaydet=$dbsql->update("alt_kategori_detay",array(
		'alt_kategori_detay_ad' => htmlspecialchars($_POST['alt_kategori_detay_ad']),
		'alt_kategori_detay_durum' => htmlspecialchars($_POST['alt_kategori_detay_durum']),
		'alt_kategori_detay_sira' => htmlspecialchars($_POST['alt_kategori_detay_sira']),
		'alt_kategori_detay_seourl' => htmlspecialchars($alt_kategori_detay_seourl),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 		
	),[
		'columns' => 'alt_kategori_detay_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/altkategoridetay.php?durum=ok&alt_kategori_id=$alt_kategori_id");

	} else {

		Header("Location:../production/altkategoridetay.php?durum=no&alt_kategori_id=$alt_kategori_id");
	}

}

if ($_GET['altkategoridetaysil']=="ok") {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);

	$alt_kategori_id=htmlspecialchars($_GET['alt_kategori_id']);
	$sil=$dbsql->delete("alt_kategori_detay","alt_kategori_detay_id",htmlspecialchars($_GET['alt_kategori_detay_id']));

	if ($sil['status']) {

		Header("Location:../production/altkategoridetay.php?durum=ok&alt_kategori_id=$alt_kategori_id");

	} else {

		Header("Location:../production/altkategoridetay.php?durum=no&alt_kategori_id=$alt_kategori_id");
	}

}



if ($_GET['kategorisil']=="ok") {

	$kullanici_id=htmlspecialchars($_SESSION['kullanici_id']);
	
	$sil=$dbsql->delete("kategori","kategori_id",htmlspecialchars($_GET['kategori_id']));
	$alt_sil=$dbsql->delete("alt_kategori","kategori_id",htmlspecialchars($_GET['kategori_id']));
	$alt_detay_sil=$dbsql->delete("alt_kategori_detay","alt_kategori_id",htmlspecialchars($_GET['alt_kategori_id']));

	if ($sil['status']) {

		
		if ($alt_sil['status'])
		{
			
			if ($alt_detay_sil['status'])
			{
				Header("Location:../production/kategori.php?durum=ok");
			}

		}
		
	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}

if ($_GET['adminurunsil']=="ok") {
	
	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']));
	while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
	{
		$urun_adi=$urun_ozellikcek['urunfoto_resimyol'];
		$dizi=array($urun_adi);
		$adet++;
		for ($i = 0; $i < $adet; $i++) 
		{
			$resimsilunlink=$dizi[$i];
			$dosya = "../../$resimsilunlink";
			unlink($dosya);
		}	
	}
	$sil=$dbsql->delete("urun","urun_id",htmlspecialchars($_GET['urun_id']));

	if ($sil['status']) {

		$resimsilunlink=htmlspecialchars($_GET['urunfoto_resimyol']);
		$silfoto=$dbsql->delete("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']),"../../$resimsilunlink");
		$silozellik=$dbsql->delete("ozellik_detay_icerik","urun_id",htmlspecialchars($_GET['urun_id']));
		Header("Location:../production/urun.php?durum=ok");

	} else {

		Header("Location:../production/urun.php?durum=hata");
	}
}

if (isset($_POST['urunekle'])) {

	$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));
	$beden_id=htmlspecialchars($_POST['beden_id']);
	if ($beden_id=="Bir Beden Seçiniz...")
	{
		$beden_id=0;
	}

	$duzenle=$dbsql->insert("urun",array(

		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_seourl' => htmlspecialchars($urun_seourl),
		'urun_detay' => htmlspecialchars($_POST['urun_detay']),
		'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
		'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
		'urun_stok' => htmlspecialchars($_POST['urun_stok']),
		'marka_id' => htmlspecialchars($_POST['marka_id']),
		'renk_id' => htmlspecialchars($_POST['renk_id']),
		'barkod_no' => htmlspecialchars($_POST['barkod_no']),
		'beden_id' => $beden_id,
		'islem_kullanici_id' =>	$_SESSION['kullanici_id']	
	),[
		'dir' => 'urunfoto',
		"file_name" => 'urunfoto_resimyol',
		"dosyalink" => "../production/urun.php",
		"width" => 540,
		"height" => 530 
	]);
}

if (isset($_POST['urunduzenle'])) {

	if ($_FILES['urunfoto_resimyol']['size']>0) {

		$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));

		$beden_id=htmlspecialchars($_POST['beden_id']);
		if ($beden_id=="")
		{
			$beden_id=0;
		}

		$duzenle=$dbsql->update("urun",array(
			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
			'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_seourl' => $urun_seourl,
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
			'urun_stok' => htmlspecialchars($_POST['urun_stok']),
			'marka_id' => htmlspecialchars($_POST['marka_id']),
			'renk_id' => htmlspecialchars($_POST['renk_id']),
			'barkod_no' => htmlspecialchars($_POST['barkod_no']),
			'beden_id' => $beden_id,
			'islem_kullanici_id' =>	$_SESSION['kullanici_id'],
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id',
			'dir' => 'urunfoto',
			"file_name" => 'urunfoto_resimyol',
			"file_delete" => htmlspecialchars($_POST['eski_yol']),
			"dosyalink" => "../production/urun.php",
			"width" => 540,
			"height" => 530
		]);

		$urun_id=$_POST['urun_id'];

		if ($duzenle['status']) {

			Header("Location:../production/urun.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../production/urun-duzenle.php?durum=hata&urun_id=$urun_id");
		}


	} else {

	//Fotoğraf Yoksa İşlemler
		$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));
		$beden_id=htmlspecialchars($_POST['beden_id']);
		if ($beden_id=="")
		{
			$beden_id=0;
		}

		$duzenle=$dbsql->update("urun",array(

			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
			'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_seourl' => $urun_seourl,
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_stok' => htmlspecialchars($_POST['urun_stok']),
			'marka_id' => htmlspecialchars($_POST['marka_id']),
			'renk_id' => htmlspecialchars($_POST['renk_id']),
			'barkod_no' => htmlspecialchars($_POST['barkod_no']),
			'beden_id' => $beden_id,
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id'
		]);

		$urun_id=htmlspecialchars($_POST['urun_id']);

		if ($duzenle['status']) {


			Header("Location:../production/urun.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../production/urun-duzenle.php?durum=hata&urun_id=$urun_id");
		}
	}
}

if (isset($_POST['yorumkaydet'])) {

	$gelen_url=htmlspecialchars($_POST['gelen_url']);

	$insert=$dbsql->insert("yorumlar",array(
		'yorum_detay' => htmlspecialchars($_POST['yorum_detay']),
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id']),
		'urun_id' => htmlspecialchars($_POST['urun_id'])		
	));

	if ($insert['status']) {

		Header("Location:$gelen_url?durum=ok");

	} else {

		Header("Location:$gelen_url?durum=no");
	}

}


if ($_GET['sepet_ekle']=="ok") {

	$urunsor=$dbsql->wread("urun","urun_id",htmlspecialchars($_GET['urun_id']));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
	$url=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'];

	if (isset($_SESSION['userkullanici_id']))
	{
		$kullanici_id=$_SESSION['userkullanici_id'];
	}
	else
	{
		if (isset($_COOKIE['userid']))
		{
			$kullanici_id=$_COOKIE['userid'];
		}
		else
		{
			$str = '12345678901234567890123456789012345678901234567890123456789012345678901234567890';
			$userid = substr(str_shuffle($str), 0, 10);
			setcookie("userid", $userid,strtotime("+15 day"),'/');
			$kullanici_id=$userid;
		}
	}

	$sepetkontrol=$dbsql->qwSql("SELECT * from sepet",array(
		'kullanici_id' => htmlspecialchars($kullanici_id),
		'urun_id' => htmlspecialchars($_GET['urun_id'])
	));
	$sepettencek=$sepetkontrol->fetch(PDO::FETCH_ASSOC);
	$sepet=$sepetkontrol->rowCount();
	$stok=$uruncek['urun_stok']-$sepettencek['urun_adet'];

	if ($stok>0)
	{
		if ($sepet<=0)
		{
			$sepetekle=$dbsql->insert("sepet",array(
				'urun_adet' => htmlspecialchars(1),
				'kullanici_id' =>  htmlspecialchars($kullanici_id),
				'urun_id' => htmlspecialchars($_GET['urun_id'])

			));

			if ($sepetekle['status']) {

				Header("Location:../../urun-$url");

			} 
		}
		else
		{
			$adet=$sepettencek['urun_adet'];
			$adet++;
			$duzenle=$dbsql->update("sepet",array(
				'urun_adet' => htmlspecialchars($adet),
				'sepet_id' => htmlspecialchars($sepettencek['sepet_id'])
			),[
				'columns' => 'sepet_id'
			]);

			if ($duzenle['status']) {
				Header("Location:../../cart.php");
			}
		}
	}
	else
	{
		Header("Location:../../urun-$url?durum=stoktakalmadi");
	}
}

if ($_GET['urun_onecikar']=="ok") {

	$duzenle=$dbsql->update("urun",array(
		'urun_onecikar' => htmlspecialchars($_GET['urun_one']),
		'urun_id' => htmlspecialchars($_GET['urun_id'])
	),[
		'columns' => 'urun_id'
	]);
	
	if ($duzenle) {

		Header("Location:../production/urun.php?durum=ok");

	} else {

		Header("Location:../production/urun.php?durum=no");
	}
}

if ($_GET['urun_vitrin']=="ok") {

	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	date_default_timezone_set('Etc/GMT-3');
	$tarih=date("Y.m.d  H:i:s");

	$duzenle=$dbsql->update("urun",array(
		'urun_onecikar' => htmlspecialchars($_GET['urun_one']),
		'vitrin_tarih' => htmlspecialchars($tarih),
		'urun_id' => htmlspecialchars($_GET['urun_id'])
	),[
		'columns' => 'urun_id'
	]);
	
	if ($duzenle['status']) {

		$kaydet=$dbsql->insert("vitrin",array(
			'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
			'urun_id' => htmlspecialchars($_GET['urun_id'])		
		));

		$sil=$db->prepare("CREATE EVENT `vitrin_$benzersizad` ON SCHEDULE EVERY 10 SECOND STARTS NOW() ON COMPLETION NOT PRESERVE ENABLE DO UPDATE urun SET urun_onecikar='0' WHERE vitrin_tarih <DATE_SUB(NOW(), INTERVAL 1 DAY) and urun_id=".htmlspecialchars($_GET['urun_id']));
		$kontrol=$sil->execute();

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=no");
	}

}

if ($_GET['yorum_onay']=="ok") {

	$duzenle=$dbsql->update("yorumlar",array(
		'yorum_onay' => htmlspecialchars($_GET['yorum_one']),
		'yorum_id' => htmlspecialchars($_GET['yorum_id'])
	),[
		'columns' => 'yorum_id'
	]);
	
	if ($duzenle['status']) {

		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}

if ($_GET['yorumsil']=="ok") {
	
	$sil=$dbsql->delete("yorumlar","yorum_id",htmlspecialchars($_GET['yorum_id']));

	if ($sil['status']) {

		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}


if (isset($_POST['bankaekle'])) {

	$kaydet=$dbsql->insert("banka",array(
		'banka_ad' => htmlspecialchars($_POST['banka_ad']),
		'banka_durum' => htmlspecialchars($_POST['banka_durum']),
		'banka_hesapadsoyad' => htmlspecialchars($_POST['banka_hesapadsoyad']),
		'banka_iban' => htmlspecialchars($_POST['banka_iban']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 		
	));

	if ($kaydet['status']) {

		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}


if (isset($_POST['bankaduzenle'])) {

	$banka_id=htmlspecialchars($_POST['banka_id']);

	$kaydet=$dbsql->update("banka",array(
		'banka_ad' => htmlspecialchars($_POST['banka_ad']),
		'banka_durum' => htmlspecialchars($_POST['banka_durum']),
		'banka_hesapadsoyad' => htmlspecialchars($_POST['banka_hesapadsoyad']),
		'banka_iban' => htmlspecialchars($_POST['banka_iban']),
		'banka_id' => htmlspecialchars($_POST['banka_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 			
	),[
		'columns' => 'banka_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=ok");

	} else {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=no");
	}
}

if ($_GET['bankasil']=="ok") {
	
	$sil=$dbsql->delete("banka","banka_id",htmlspecialchars($_GET['banka_id']));

	if ($sil['status']) {

		
		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}

if (isset($_POST['kullanicisifreguncelle'])) {

	echo $kullanici_eskipassword=trim(htmlspecialchars($_POST['kullanici_eskipassword'])); echo "<br>";
	echo $kullanici_passwordone=trim(htmlspecialchars($_POST['kullanici_passwordone'])); echo "<br>";
	echo $kullanici_passwordtwo=trim(htmlspecialchars($_POST['kullanici_passwordtwo'])); echo "<br>";


	$regex_lowercase = '/[a-z]/'; // küçük harf
	$regex_uppercase = '/[A-Z]/'; // büyük harf
	$regex_number = '/[0-9]/'; //sayı
	$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>~]/'; // özel karakter

	$kullanici_password=md5($kullanici_eskipassword);


	$kullanicisor=$dbsql->wread("kullanici","kullanici_password",htmlspecialchars($kullanici_password));
	$say=$kullanicisor->rowCount();

	if ($say==0) {

		header("Location:../production/profilephoto?durum=eskisifrehata");

	} else {

	//eski şifre doğruysa başla

		if ($kullanici_passwordone==$kullanici_passwordtwo) {

			if(!preg_match_all($regex_lowercase,$kullanici_passwordone) || !preg_match_all($regex_uppercase,$kullanici_passwordone) || !preg_match_all($regex_number,$kullanici_passwordone) || !preg_match_all($regex_special,$kullanici_passwordone))
			{
				header("Location:../production/profilephoto.php?durum=eksiksifrekarakter");
				exit();
			}

			if (strlen($kullanici_passwordone)>=6) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

				$kullanicikaydet=$dbsql->update("kullanici",array(
					'kullanici_password' => htmlspecialchars($password),
					'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])

				),[
					'columns' => 'kullanici_id'
				]);

				if ($kullanicikaydet['status']) {

					header("Location:../production");

				} else {
					header("Location:../production/profilephoto.php?durum=no");
				}

			} else {
				header("Location:../production/profilephoto.php?durum=eksiksifre");
			}
		} else {

			header("Location:../production/profilephoto?durum=sifreleruyusmuyor");
			exit;
		}
	}
	exit;
	if ($kullanicikaydet['status']) {

		header("Location:../production/profilephoto?durum=ok");

	} else {

		header("Location:../production/profilephoto?durum=no");
	}

}

if(isset($_POST['urunfotosil'])) {
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$checklist =$_POST["urunfotosec"];
	foreach($checklist as $list) {
		$cekelim=$db->prepare("SELECT * from urunfoto where urunfoto_id='".$list."'");
		$cekelim->execute();
		$sil=$dbsql->delete("urunfoto","urunfoto_id",htmlspecialchars($list));
		while($resim=$cekelim->fetch(PDO::FETCH_ASSOC)){
			$urunfoto_resimyol=$resim["urunfoto_resimyol"];
			unlink("../../$urunfoto_resimyol");
		}
	}
	if ($sil['status']) {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");
	} else {
		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
	}
} 

if(isset($_POST['urunfotomagazasil'])) {

	$urun_id=htmlspecialchars($_POST['urun_id']);
	$checklist =$_POST["urunfotosec"];
	foreach($checklist as $list) {
		$cekelim=$db->prepare("SELECT * from urunfoto where urunfoto_id='".$list."'");
		$cekelim->execute();
		$sil=$dbsql->delete("urunfoto","urunfoto_id",htmlspecialchars($list));
		while($resim=$cekelim->fetch(PDO::FETCH_ASSOC)){
			$urunfoto_resimyol=$resim["urunfoto_resimyol"];
			unlink("../../$urunfoto_resimyol");
		}
	}

	if ($list) {

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=hata");
	}


} 

if (isset($_POST['mailayarkaydet'])) {
	
	$ayarkaydet=$dbsql->update("ayar",array(
		'ayar_smtphost' => htmlspecialchars($_POST['ayar_smtphost']),
		'ayar_smtpuser' => htmlspecialchars($_POST['ayar_smtpuser']),
		'ayar_smtppassword' => htmlspecialchars($_POST['ayar_smtppassword']),
		'ayar_smtpport' => htmlspecialchars($_POST['ayar_smtpport']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/mail-ayar.php?durum=ok");

	} else {

		Header("Location:../production/mail-ayar.php?durum=no");
	}

}

if (isset($_POST['vergiayarkaydet'])) {
	
	$ayarkaydet=$dbsql->update("ayar",array(
		'vergi_dairesi' => htmlspecialchars($_POST['vergi_dairesi']),
		'vds' => htmlspecialchars($_POST['vds']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/sirket-ayar.php?durum=ok");

	} else {

		Header("Location:../production/sirket-ayar.php?durum=no");
	}

}


if (isset($_POST['sosyalayarkaydet'])) {
	
	$ayarkaydet=$dbsql->update("ayar",array(
		'ayar_facebook' => htmlspecialchars($_POST['ayar_facebook']),
		'ayar_twitter' => htmlspecialchars($_POST['ayar_twitter']),
		'ayar_youtube' => htmlspecialchars($_POST['ayar_youtube']),
		'ayar_google' => htmlspecialchars($_POST['ayar_google']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'ayar_id' => 0
	),[
		'columns' => 'ayar_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/sosyal-ayar.php?durum=ok");

	} else {

		Header("Location:../production/sosyal-ayar.php?durum=no");
	}

}

if ($_GET['siparissil']=="ok") {

	islemkontrol();
	$siparis_id=htmlspecialchars($_GET['siparis_id']);
	$siparissor=$dbsql->qwSql("SELECT siparis.*,siparis_detay.*,kullanici.*,urun.* FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_id=kullanici.kullanici_id INNER JOIN urun ON siparis_detay.urun_id=urun.urun_id",array(
		'siparis.kullanici_id' => htmlspecialchars($_GET['kullanici_id']),
		'siparis.siparis_zaman' => htmlspecialchars($_GET['siparis_zaman']),
		'siparis_detay.iade_et' => 0
	),[
		"columns_name" => "siparis_detay.urun_fiyat",
		"columns_sort" => "DESC",
	]);

	$say=$siparissor->rowCount();

	for ($i=1;$i<=$say;$i++)
	{
		$sil=$dbsql->delete("siparis","siparis_id",htmlspecialchars($siparis_id));

		if ($sil['status']) {

			$sildetay=$dbsql->delete("siparis_detay","siparis_id",htmlspecialchars($siparis_id));

			if ($sildetay['status'])
			{
				header("location:../production/siparisler.php?sil=ok");
			}
			else
			{
				header("location:../production/siparisler.php?sil=no");
			}
		} else {

			header("location:../production/siparisler.php?sil=no");

		}
		++$siparis_id;
	}
}

if ($_GET['sepeturunsil']=="ok") {

	$sil=$dbsql->delete("sepet","sepet_id",htmlspecialchars($_GET['sepet_id']));

	if ($sil['status']) {


		header("location:../../sepet.php?sil=ok");


	} else {

		header("location:../../sepet.php?sil=no");

	}

}


if ($_GET['siparisonay']=="ok") {

	islemkontrol();

	$duzenle=$dbsql->update("siparis",array(
		'siparis_durum' => htmlspecialchars($_GET['siparis_one']),
		'siparis_id' => htmlspecialchars($_GET['siparis_id'])
	),[
		'columns' => 'siparis_id'
	]);

	if ($duzenle['status']) {



		Header("Location:../production/siparisler.php?durum=ok");

	} else {

		Header("Location:../production/siparisler.php?durum=no");
	}

}


if ($_GET['magazaonay']=="red") {

	$kullaniciguncelle=$dbsql->update("kullanici",array(
		'kullanici_magaza' => 0,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])

	),[
		'columns' => 'kullanici_id'
	]);

	if ($kullaniciguncelle['status']) {

		Header("Location:../production/magazalar.php?durum=ok");


	} else {

		Header("Location:../production/magazalar.php?durum=no");
	}
}


if (isset($_POST['magazaonaykayit'])) {

	$kullaniciguncelle=$dbsql->update("kullanici",array(

		'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
		'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),		
		'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_magaza' => 2,
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);


	if ($kullaniciguncelle['status']) {

		Header("Location:../production/magazalar.php?durum=ok");


	} else {

		Header("Location:../production/magazalar.php?durum=no");
	}
}

if (isset($_POST['magazaurunekle'])) {

	$urun_seourl=seo(htmlspecialchars($_POST['urun_ad']));
	$beden_id=htmlspecialchars($_POST['beden_id']);
	if ($beden_id=="")
	{
		$beden_id=0;
	}

	$duzenle=$dbsql->insert("urun",array(

		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
		'urun_ad' => htmlspecialchars($_POST['urun_ad']),
		'urun_seourl' => htmlspecialchars($urun_seourl),
		'urun_detay' => htmlspecialchars($_POST['urun_detay']),
		'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
		'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
		'urun_stok' => htmlspecialchars($_POST['urun_stok']),
		'marka_id' => htmlspecialchars($_POST['marka_id']),
		'renk_id' => htmlspecialchars($_POST['renk_id']),
		'barkod_no' => htmlspecialchars($_POST['barkod_no']),
		'beden_id' => $beden_id,
		'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
	),[
		'dir' => 'urunfoto',
		"file_name" => 'urunfoto_resimyol',
		"dosyalink" => "../../urunlerim.php",
		"width" => 540,
		"height" => 530 
	]);
}

if (isset($_POST['magazaurunduzenle'])) {

	$favorisor=$dbsql->wread("favoriler","urun_id",htmlspecialchars($_POST['urun_id']));
	$favoricek=$favorisor->fetch(PDO::FETCH_ASSOC);
	if ($_POST['urun_fiyat']<$favoricek['favori_fiyat'])
	{
		$favori=$dbsql->update("favoriler",array(
			'favori_durum' => 1,
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id'
		]);
	}

	if ($_FILES['urunfoto_resimyol']['size']>0) {

		$urun_seourl=seo($_POST['urun_ad']);
		$beden_id=htmlspecialchars($_POST['beden_id']);
		if ($beden_id=="")
		{
			$beden_id=0;
		}

		$duzenle=$dbsql->update("urun",array(
			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
			'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_seourl' => htmlspecialchars($urun_seourl),
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
			'urun_stok' => htmlspecialchars($_POST['urun_stok']),
			'marka_id' => htmlspecialchars($_POST['marka_id']),
			'renk_id' => htmlspecialchars($_POST['renk_id']),
			'barkod_no' => htmlspecialchars($_POST['barkod_no']),
			'beden_id' => $beden_id,
			'islem_kullanici_id' =>	$_SESSION['userkullanici_id'],
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id',
			'dir' => 'urunfoto',
			"file_name" => 'urunfoto_resimyol',
			"file_delete" => htmlspecialchars($_POST['eski_yol']),
			"dosyalink" => ".../../urun-duzenle.php",
			"width" => 540,
			"height" => 530
		]);

		$urun_id=$_POST['urun_id'];

		if ($duzenle['status']) {

			Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle.php?durum=hata&urun_id=$urun_id");
		}

	} else {


//Fotoğraf Yoksa İşlemler

		$urun_seourl=seo($_POST['urun_ad']);
		$beden_id=htmlspecialchars($_POST['beden_id']);
		if ($beden_id=="")
		{
			$beden_id=0;
		}

		$duzenle=$dbsql->update("urun",array(
			'kategori_id' => htmlspecialchars($_POST['kategori_id']),
			'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
			'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
			'urun_ad' => htmlspecialchars($_POST['urun_ad']),
			'urun_seourl' => htmlspecialchars($urun_seourl),
			'urun_detay' => htmlspecialchars($_POST['urun_detay']),
			'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
			'urun_kdv' => htmlspecialchars($_POST['urun_kdv']),
			'urun_stok' => htmlspecialchars($_POST['urun_stok']),
			'marka_id' => htmlspecialchars($_POST['marka_id']),
			'renk_id' => htmlspecialchars($_POST['renk_id']),
			'barkod_no' => htmlspecialchars($_POST['barkod_no']),
			'beden_id' => $beden_id,
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id'
		]);

		$urun_id=$_POST['urun_id'];

		if ($duzenle['status']) {


			Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle.php?durum=hata&urun_id=$urun_id");
		}
	}
}

//Ürün Silme İşlemi

if ($_GET['urunsil']=="ok") {

	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']));
	while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
	{
		$urun_adi=$urun_ozellikcek['urunfoto_resimyol'];
		$dizi=array($urun_adi);		
		$adet++;
		for ($i = 0; $i < $adet; $i++) 
		{
			$resimsilunlink=$dizi[$i];
			$dosya = "../../$resimsilunlink";
			unlink($dosya);			
		}	
	}
	$resimsilunlink=htmlspecialchars($_GET['urunfoto_resimyol']);
	$dosya = "../../$resimsilunlink";
	$sil=$dbsql->delete("urun","urun_id",htmlspecialchars($_GET['urun_id']),$dosya);
	if ($sil['status']) {

		$silfoto=$dbsql->delete("urunfoto","urun_id",htmlspecialchars($_GET['urun_id']));
		$silozellik=$dbsql->delete("ozellik_detay_icerik","urun_id",htmlspecialchars($_GET['urun_id']));
		$silyorum=$dbsql->delete("yorumlar","urun_id",htmlspecialchars($_GET['urun_id']));
		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=hata");
	}
}

if (isset($_POST['markaekle'])) {

	$markaekle=$dbsql->insert("marka",array(
		'marka_adi' => htmlspecialchars($_POST['marka_adi']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'marka_durum' => 1
	));

	if ($markaekle['status']) {

		Header("Location:../production/marka.php?durum=ok");

	} else {

		Header("Location:../production/marka-ekle.php?durum=no");
	}

}


if (isset($_POST['markaduzenle'])) {

	$marka_id=htmlspecialchars($_POST['marka_id']);

	$ayarkaydet=$dbsql->update("marka",array(
		'marka_adi' => htmlspecialchars($_POST['marka_adi']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'marka_id' => htmlspecialchars($_POST['marka_id'])
	),[
		'columns' => 'marka_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/marka.php?");

	} else {

		Header("Location:../production/marka-duzenle.php?marka_id=$marka_id&durum=no");
	}

}


if ($_GET['markasil']=="ok") {

	$sil=$dbsql->delete("marka","marka_id",htmlspecialchars($_GET['marka_id']));

	if ($sil['status']) {

		header("location:../production/marka.php?sil=ok");

	} else {

		header("location:../production/marka.php?sil=no");

	}
}

if (isset($_POST['markaonaykayit'])) {

	$markaguncelle=$dbsql->update("marka",array(
		'marka_adi' => htmlspecialchars($_POST['marka_adi']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'marka_durum' => 1,
		'marka_id' => htmlspecialchars($_POST['marka_id'])
	),[
		'columns' => 'marka_id'
	]);

	if ($markaguncelle['status']) {

		Header("Location:../production/marka_onayla.php?durum=ok");


	} else {

		Header("Location:../production/marka_onayla.php?durum=no");
	}



}

if ($_GET['markaonay']=="red") {

	$markaguncelle=$dbsql->update("marka",array(
		'kullanici_magaza' => 0,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($markaguncelle['status']) {

		Header("Location:../production/magazalar.php?durum=ok");


	} else {

		Header("Location:../production/magazalar.php?durum=no");
	}
}

if (isset($_POST['magazabedenekle'])) {

	$bedenekle=$dbsql->insert("beden",array(
		'beden_icerik' => htmlspecialchars($_POST['beden_icerik']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	));

	if ($bedenekle['status']) {

		Header("Location:../../beden-ekle.php?durum=ok");

	} else {

		Header("Location:../../beden-ekle.php?durum=no");
	}

}

if (isset($_POST['magazamarkaekle'])) {

	$markaekle=$dbsql->insert("marka",array(
		'marka_adi' => htmlspecialchars($_POST['marka_adi']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id'])
	));

	if ($markaekle['status']) {

		Header("Location:../../marka-ekle.php?durum=ok");

	} else {

		Header("Location:../../marka-ekle.php?durum=no");
	}
}

if (isset($_POST['renkekle'])) {

	$renkekle=$dbsql->insert("renkler",array(
		'renk_adi' => htmlspecialchars($_POST['renk_adi']),
		'renk_kodu' => htmlspecialchars($_POST['renk_kodu']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])
	));

	if ($renkekle['status']) {

		Header("Location:../production/renkler.php?durum=ok");

	} else {

		Header("Location:../production/renk-ekle.php?durum=no");
	}

}

if (isset($_POST['renkduzenle'])) {

	$renk_id=htmlspecialchars($_POST['renk_id']);

	$ayarkaydet=$dbsql->update("renkler",array(
		'renk_adi' => htmlspecialchars($_POST['renk_adi']),
		'renk_kodu' => htmlspecialchars($_POST['renk_kodu']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']),
		'renk_id' => htmlspecialchars($_POST['renk_id'])
	),[
		'columns' => 'renk_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/renkler.php?");

	} else {

		Header("Location:../production/renk-duzenle.php?renk_id=$renk_id&durum=no");
	}

}

if ($_GET['renksil']=="ok") {

	$sil=$dbsql->delete("renkler","renk_id",htmlspecialchars($_GET['renk_id']));

	if ($sil['status']) {


		header("location:../production/renkler.php?sil=ok");


	} else {

		header("location:../production/renkler.php?sil=no");

	}
}

if (isset($_POST['ozellikekle'])) {

	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);

	$ozellikekle=$dbsql->insert("urun_ozellikler",array(
		'ozellik_adi' => htmlspecialchars($_POST['ozellik_adi']),
		'ozellik_durum' => htmlspecialchars($_POST['ozellik_durum']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => $_SESSION['kullanici_id']
	));

	if ($ozellikekle['status']) {

		Header("Location:../production/altkategoriozellik.php?durum=ok&alt_kategori_detay_id=$alt_kategori_detay_id");

	} else {

		Header("Location:../production/altkategoriozellik.php?durum=no");
	}

}

if (isset($_POST['ozellikduzenle'])) {

	$urun_ozellikleri_id=htmlspecialchars($_POST['urun_ozellikleri_id']);

	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);

	$ozellikduzenle=$dbsql->update("urun_ozellikler",array(
		'ozellik_adi' => htmlspecialchars($_POST['ozellik_adi']),
		'ozellik_durum' => htmlspecialchars($_POST['ozellik_durum']),
		'urun_ozellikleri_id' => htmlspecialchars($_POST['urun_ozellikleri_id']),
		'kullanici_id' => $_SESSION['kullanici_id']
	),[
		'columns' => 'urun_ozellikleri_id'
	]);
	if ($ozellikduzenle['status']) {

		Header("Location:../production/altkategoriozellik.php?durum=ok&alt_kategori_detay_id=$alt_kategori_detay_id");

	} else {

		Header("Location:../production/altkategoriozellik-duzenle.php?urun_ozellikleri_id=$urun_ozellikleri_id&durum=no");
	}
}


if ($_GET['ozelliksil']=="ok") {

	$alt_kategori_detay_id=htmlspecialchars($_GET['alt_kategori_detay_id']);

	$sil=$dbsql->delete("urun_ozellikler","urun_ozellikleri_id",htmlspecialchars($_GET['urun_ozellikleri_id']));

	if ($sil['status']) {


		Header("Location:../production/altkategoriozellik.php?durum=ok&alt_kategori_detay_id=$alt_kategori_detay_id");


	} else {

		Header("Location:../production/altkategoriozellik.php?durum=no&alt_kategori_detay_id=$alt_kategori_detay_id");

	}
}

if (isset($_POST['ozellikdetayekle'])) {

	$urun_ozellikleri_id=htmlspecialchars($_POST['urun_ozellikleri_id']);

	$ozellikdetayekle=$dbsql->insert("ozellik_detay",array(
		'ozellik_detay' => htmlspecialchars($_POST['ozellik_detay']),
		'urun_ozellikleri_id' => htmlspecialchars($_POST['urun_ozellikleri_id']),
		'kullanici_id' => $_SESSION['kullanici_id']
	));

	if ($ozellikdetayekle['status']) {

		Header("Location:../production/altkategoridetayozellik.php?durum=ok&urun_ozellikleri_id=$urun_ozellikleri_id");

	} else {

		Header("Location:../production/altkategoridetayozellik.php?durum=no&urun_ozellikleri_id=$urun_ozellikleri_id");
	}

}

if (isset($_POST['ozellikdetayduzenle'])) {

	$urun_ozellikleri_id=htmlspecialchars($_POST['urun_ozellikleri_id']);

	$ozellik_detay_id=htmlspecialchars($_POST['ozellik_detay_id']);

	$ayarkaydet=$dbsql->update("ozellik_detay",array(
		'ozellik_detay' => htmlspecialchars($_POST['ozellik_detay']),
		'kullanici_id' => $_SESSION['kullanici_id'],
		'ozellik_detay_id' => htmlspecialchars($_POST['ozellik_detay_id'])
	),[
		'columns' => 'ozellik_detay_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/altkategoridetayozellik.php?durum=ok&urun_ozellikleri_id=$urun_ozellikleri_id");

	} else {

		Header("Location:../production/altkategoridetayozellik-duzenle.php?ozellik_detay_id=$ozellik_detay_id&durum=no");
	}

}

if ($_GET['ozellikdetaysil']=="ok") {

	$urun_ozellikleri_id=htmlspecialchars($_GET['urun_ozellikleri_id']);

	$sil=$dbsql->delete("ozellik_detay","ozellik_detay_id",htmlspecialchars($_GET['ozellik_detay_id']));

	if ($sil['status']) {


		Header("Location:../production/altkategoridetayozellik.php?durum=ok&urun_ozellikleri_id=$urun_ozellikleri_id");


	} else {

		Header("Location:../production/altkategoridetayozellik.php?durum=no&urun_ozellikleri_id=$urun_ozellikleri_id");

	}
}

if (isset($_POST['urunozellikekle'])) 
{
	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$say=0;
	$durum=0;
	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_POST['alt_kategori_detay_id']));
	$urun_saysor=$dbsql->wread("ozellik_detay_icerik","urun_id",htmlspecialchars($_POST['urun_id']));
	$say=$urun_saysor->rowCount();

	if ($say==0)
	{
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
		{
			$urun_adi=$urun_ozellikcek['urun_ozellikleri_id'];
			$dizi=array($urun_adi);
			$adet++;
			for ($i = 0; $i < $adet; $i++) 
			{
				$urun_ozellikleri_id=htmlspecialchars($_POST[$dizi[$i]]);
				$ozellikekle=$dbsql->insert("ozellik_detay_icerik",array(
					'ozellik_detay_id' => htmlspecialchars($_POST[$dizi[$i]]),
					'urun_id' => htmlspecialchars($_POST['urun_id']),
					'kullanici_id' => $_SESSION['kullanici_id']
				));
				if ($ozellikekle['status']) {
					$durum=1;
					Header("Location:../production/urun.php?durum=ok");
					break;

				} else {

					Header("Location:../production/urun.php?durum=no");
				}
			}	
		}
		if ($durum==1)
		{
			$duzenle=$dbsql->update("urun",array(
				'urun_durum' => 1,
				'urun_id' => htmlspecialchars($_POST['urun_id'])
			),[
				'columns' => 'urun_id'
			]);
		}
	}
	else
	{
		echo "Zaten Var";
		Header("Location:../production/urun-ozellik.php?alt_kategori_detay_id=$alt_kategori_detay_id&urun_id=$urun_id");
	}	
}

if (isset($_POST['urunozellikduzenle'])) 
{
	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_POST['alt_kategori_detay_id']));
	while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
	{
		$urun_adi=$urun_ozellikcek['urun_ozellikleri_id'];
		$dizi=array($urun_adi);
		$adet++;
		for ($i = 0; $i < $adet; $i++) 
		{
			$urun_ozellikleri_id=htmlspecialchars($_POST[$dizi[$i]]);
			$duzenle=$dbsql->update("ozellik_detay_icerik",array(
				'ozellik_detay_id' => $urun_ozellikleri_id,
				'urun_id' => htmlspecialchars($_POST['urun_id']),
				'kullanici_id' => $_SESSION['kullanici_id'],
				'ozellik_detay_icerik_id' => htmlspecialchars($_POST['ozellik_detay_icerik_id'])
			),[
				'columns' => 'ozellik_detay_icerik_id'
			]);
			if ($duzenle['status']) 
			{
				Header("Location:../production/urun-ozellik.php?durum=ok&alt_kategori_detay_id=$alt_kategori_detay_id&urun_id=$urun_id");
			} 
		}	
	}
}

if (isset($_POST['magazaurunozellikekle'])) 
{
	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$say=0;
	$durum=0;
	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_POST['alt_kategori_detay_id']));
	$urun_saysor=$dbsql->wread("ozellik_detay_icerik","urun_id",htmlspecialchars($_POST['urun_id']));
	$say=$urun_saysor->rowCount();
	if ($say==0)
	{
		while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
		{
			$urun_adi=$urun_ozellikcek['urun_ozellikleri_id'];
			$dizi=array($urun_adi);
			$adet++;
			for ($i = 0; $i < $adet; $i++) 
			{
				$urun_ozellikleri_id=htmlspecialchars($_POST[$dizi[$i]]);
				$ozellikekle=$dbsql->insert("ozellik_detay_icerik",array(
					'ozellik_detay_id' => htmlspecialchars($_POST[$dizi[$i]]),
					'urun_id' => htmlspecialchars($_POST['urun_id']),
					'kullanici_id' => $_SESSION['userkullanici_id']
				));
				if ($ozellikekle['status']) {
					$durum=1;
					Header("Location:../../urunlerim.php?durum=ok");
					break;

				} else {

					Header("Location:../../urunlerim.php?durum=no");
				}
			}	
		}
		if ($durum==1)
		{
			$duzenle=$dbsql->update("urun",array(
				'urun_durum' => 1,
				'urun_id' => htmlspecialchars($_POST['urun_id'])
			),[
				'columns' => 'urun_id'
			]);
		}
	}

	else
	{
		echo "Zaten Var";
		Header("Location:../../urun-ozellik.php?alt_kategori_detay_id=$alt_kategori_detay_id&urun_id=$urun_id");
	}	
}

if (isset($_POST['magazaurunozellikduzenle'])) 
{
	$alt_kategori_detay_id=htmlspecialchars($_POST['alt_kategori_detay_id']);
	$urun_id=htmlspecialchars($_POST['urun_id']);
	$adet=0;
	$urun_ozelliksor=$dbsql->wread("urun_ozellikler","alt_kategori_detay_id",htmlspecialchars($_POST['alt_kategori_detay_id']));
	while($urun_ozellikcek=$urun_ozelliksor->fetch(PDO::FETCH_ASSOC))
	{
		$urun_adi=$urun_ozellikcek['urun_ozellikleri_id'];
		$dizi=array($urun_adi);
		$adet++;
		for ($i = 0; $i < $adet; $i++) 
		{
			$urun_ozellikleri_id=htmlspecialchars($_POST[$dizi[$i]]);
			$duzenle=$dbsql->update("ozellik_detay_icerik",array(
				'ozellik_detay_id' => $urun_ozellikleri_id,
				'urun_id' => htmlspecialchars($_POST['urun_id']),
				'kullanici_id' => $_SESSION['userkullanici_id'],
				'ozellik_detay_icerik_id' => htmlspecialchars($_POST['ozellik_detay_icerik_id'])
			),[
				'columns' => 'ozellik_detay_icerik_id'
			]);

			if ($duzenle['status']) 
			{
				Header("Location:../../urun-ozellik.php?durum=ok&alt_kategori_detay_id=$alt_kategori_detay_id&urun_id=$urun_id");
			} 
		}	
	}
}

if (isset($_POST['stokekle'])) {

	$stoksor=$dbsql->wread("urun","urun_id",htmlspecialchars($_POST['urun_id']));
	$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
	$yenistok=$stokcek['urun_stok']+htmlspecialchars($_POST['urun_stok']);
	$ayarkaydet=$dbsql->update("urun",array(
		'urun_stok' => $yenistok,
		'urun_durum' => 1,
		'urun_id' => htmlspecialchars($_POST['urun_id'])
	),[
		'columns' => 'urun_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../../urunlerim.php?durum=ok");

	} else {

		Header("Location:../../urunlerim.php?durum=no");
	}
}

if (isset($_POST['stokdus'])) {

	$stoksor=$dbsql->wread("urun","urun_id",htmlspecialchars($_POST['urun_id']));
	$stokcek=$stoksor->fetch(PDO::FETCH_ASSOC);
	if ($stokcek['urun_stok']<=0 || ($stokcek['urun_stok']-htmlspecialchars($_POST['urun_stok']))<0)
	{
		Header("Location:../../urunlerim.php?durum=no");
		exit();
	}
	else
	{
		$yenistok=($stokcek['urun_stok']-htmlspecialchars($_POST['urun_stok']));
		$duzenle=$dbsql->update("urun",array(
			'urun_stok' => $yenistok,
			'urun_id' => htmlspecialchars($_POST['urun_id'])
		),[
			'columns' => 'urun_id'
		]);

		if ($yenistok<=0)
		{
			$duzenle=$dbsql->update("urun",array(
				'urun_durum' => 0,
				'urun_id' => htmlspecialchars($_POST['urun_id'])
			),[
				'columns' => 'urun_id'
			]);
		}

		if ($duzenle['status']) {

			Header("Location:../../urunlerim.php?durum=ok");

		} else {

			Header("Location:../../urunlerim.php?durum=no");
		}
	}
}

if (isset($_POST['bedenekle'])) {

	$bedenekle=$dbsql->insert("beden",array(
		'beden_icerik' => htmlspecialchars($_POST['beden_icerik']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])
	));

	if ($bedenekle['status']) {

		Header("Location:../production/beden.php?durum=ok");

	} else {

		Header("Location:../production/beden-ekle.php?durum=no");
	}
}

if (isset($_POST['bedenduzenle'])) {

	$beden_id=htmlspecialchars($_POST['beden_id']);

	$ayarkaydet=$dbsql->update("beden",array(
		'beden_icerik' => htmlspecialchars($_POST['beden_icerik']),
		'alt_kategori_id' => htmlspecialchars($_POST['alt_kategori_id']),
		'kategori_id' => htmlspecialchars($_POST['kategori_id']),
		'alt_kategori_detay_id' => htmlspecialchars($_POST['alt_kategori_detay_id']),
		'beden_id' => htmlspecialchars($_POST['beden_id']),
		'kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])
	),[
		'columns' => 'beden_id'
	]);

	if ($ayarkaydet['status']) {

		Header("Location:../production/beden.php?durum=ok");

	} else {

		Header("Location:../production/beden-duzenle.php?beden_id=$beden_id&durum=no");
	}
}

if ($_GET['bedensil']=="ok") {

	$sil=$dbsql->delete("beden","beden_id",htmlspecialchars($_GET['beden_id']));

	if ($sil['status']) {

		header("location:../production/beden.php?sil=ok");

	} else {

		header("location:../production/beden.php?sil=no");

	}
}

if (isset($_POST['mesajolustur'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanicisor=$dbsql->wread("kullanici","kullanici_mail",htmlspecialchars($kullanici_mail));
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
			'kullanici_gon' => htmlspecialchars($_SESSION['kullanici_id']),
			'aciklama' => htmlspecialchars($aciklama),
			'kullanici_id' => $_SESSION['kullanici_id']
		));

		if ($kaydet['status']) {

			Header("Location:../production/mesaj-gonder?durum=ok");

		} else {

			Header("Location:../production/mesaj-gonder?durum=no");
		}
	}
}

if (isset($_POST['duyurugonder'])) {


	$kullanici_tip=htmlspecialchars($_POST['kullanici_tip']);

	if ($kullanici_tip=="Tüm Satıcılar")
	{
		$kullanicisor=$db->prepare("SELECT * FROM kullanici where (kullanici_tip=:kullanici_tip1 or kullanici_tip=:kullanici_tip2 or kullanici_tip=:kullanici_tip3) and kullanici_magaza=:kullanici_magaza");
		$kullanicisor->execute(array(
			'kullanici_tip1' => 'PERSONAL',
			'kullanici_tip2' => 'PRIVATE_COMPANY',
			'kullanici_tip3' => 'INCORPORATED_COMPANY',
			'kullanici_magaza' => 2
		));	
	}
	else
	{
		if ($kullanici_tip=="Alıcı")
		{
			$kullanici_tip="PERSONAL";
			$kullanici_magaza=0;
		}
		else if ($kullanici_tip=="Bireysel Satıcı") 
		{
			$kullanici_tip="PERSONAL";
			$kullanici_magaza=2;
		}
		else if ($kullanici_tip=="Satıcı(L.T.D.)") 
		{
			$kullanici_tip="PRIVATE_COMPANY";
			$kullanici_magaza=2;
		}
		else if ($kullanici_tip=="Satıcı(A.Ş.)") 
		{
			$kullanici_tip="INCORPORATED_COMPANY";
			$kullanici_magaza=2;
		}
		else if ($kullanici_tip=="Şirket Çalışanı") 
		{
			$kullanici_tip="LIMITED_OR_JOINT_STOCK_COMPANY";
			$kullanici_magaza=2;
		}
		else
		{
			$kullanici_tip="TECHNİCAL_PERSON";
			$kullanici_magaza=2;
			$kullanici_yetki=5;
		}

		$kullanicisor=$dbsql->qwSql("SELECT * FROM kullanici",array(
			'kullanici_tip' => $kullanici_tip,
			'kullanici_magaza' => $kullanici_magaza
		));	
	}

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);

	while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC))
	{
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
				'kullanici_gon' => htmlspecialchars($_SESSION['kullanici_id']),
				'aciklama' => htmlspecialchars($aciklama),
				'kullanici_id' => $_SESSION['kullanici_id']
			));

			if ($kaydet['status']) {


				Header("Location:../production/duyuru_yap?durum=ok");

			} else {

				Header("Location:../production/duyuru_yap?durum=no");

			}
		}
	}
}

if (isset($_POST['mesajcevapver'])) {

	echo $kullanici_gel=htmlspecialchars($_POST['kullanici_gel']);

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
			'kullanici_gon' => htmlspecialchars( $_SESSION['kullanici_id']),
			'aciklama' => htmlspecialchars($aciklama),
			'kullanici_id' => $_SESSION['kullanici_id']
		));

		if ($kaydet['status']) {

			Header("Location:../production/gelen-mesajlar?durum=ok");

		} else {

			Header("Location:../production/gelen-mesajlar?durum=hata");

		}
	}
}

if ($_GET['gidenmesajsil']=="ok") {

	$sil=$dbsql->delete("mesaj","mesaj_id",htmlspecialchars($_GET['mesaj_id']));

	if ($sil['status']) {

		Header("Location:../production/giden-mesajlar.php?durum=ok");

	} else {

		Header("Location:../production/giden-mesajlar.php?durum=hata");
	}
}

if ($_GET['gelenmesajsil']=="ok") {

	$sil=$dbsql->delete("mesaj","mesaj_id",htmlspecialchars($_GET['mesaj_id']));

	if ($sil['status']) {

		Header("Location:../production/gelen-mesajlar.php?durum=ok");

	} else {

		Header("Location:../production/gelen-mesajlar.php?durum=hata");
	}
}

if (isset($_POST['kargoduzenle'])) {

	$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
		'siparisdetay_onay' => 2,
		'siparis_kargoucret' => htmlspecialchars($_POST['siparis_kargoucret']),
		'siparisdetay_kargoad' => htmlspecialchars($_POST['siparisdetay_kargoad']),
		'siparisdetay_id' => htmlspecialchars($_POST['siparisdetay_id']),
		'islem_kullanici_id' =>	$_SESSION['kullanici_id']
	),[
		'columns' => 'siparisdetay_id'
	]);

	if ($siparis_detayguncelle['status']) {

		Header("Location:../production/kargo.php?durum=ok");

	} else {

		Header("Location:../production/kargo.php?durum=no");
	}
}

if ($_GET['teslim_et']=="ok") {

	date_default_timezone_set('Etc/GMT-3');
	$tarih=date("Y.m.d  H:i:s");

	$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
		'siparisdetay_onay' => 3,
		'siparisdetay_kargozaman' => $tarih,
		'siparisdetay_id' => htmlspecialchars($_GET['siparisdetay_id']),
		'islem_kullanici_id' =>	$_SESSION['kullanici_id']
	),[
		'columns' => 'siparisdetay_id'
	]);

	if ($siparis_detayguncelle['status']) {

		Header("Location:../production/kargo.php?durum=ok");

	} else {

		Header("Location:../production/kargo.php?durum=no");
	}
}

if (isset($_POST['iade_basvuru'])) {

	$siparis_id=htmlspecialchars($_POST['siparis_id']);
	$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
	$kargo_no = substr(str_shuffle($str), 0, 10);

	$kaydet=$dbsql->insert("iade",array(
		'iade_turu' => htmlspecialchars($_POST['iade_turu']),
		'iade_aciklama' => htmlspecialchars($_POST['iade_detay']),
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id']),
		'siparis_id' => htmlspecialchars($_POST['siparis_id']),
		'urun_id' => htmlspecialchars($_POST['urun_id']),
		'kargo_no' => $kargo_no		
	));

	if ($kaydet['status']) {

		$siparis_detayguncelle=$dbsql->update("siparis_detay",array(
			'iade_et' => 1,
			'siparisdetay_id' => htmlspecialchars($_POST['siparisdetay_id']),
			'islem_kullanici_id' =>	$_SESSION['userkullanici_id']
		),[
			'columns' => 'siparisdetay_id'
		]);

		Header("Location:../../iade_durum.php?durum=ok");

	} else {

		Header("Location:../../iade_durum.php?durum=no");
	}
}

if ($_GET['iade_onay']=="ok") {

	$iadeguncelle=$dbsql->update("iade",array(
		'iade_durum' => 1,
		'iade_id' => htmlspecialchars($_GET['iade_id'])
	),[
		'columns' => 'iade_id'
	]);

	if ($iadeguncelle['status']) {
		Header("Location:../../satici_iade.php?durum=ok");

	} else {

		Header("Location:../../satici_iade.php?durum=no");
	}
}

if (isset($_POST['iadeduzenle'])) {

	$iade_durum=0;
	$iade_turu=htmlspecialchars($_POST['iade_turu']);

	if ($iade_turu=="Para İadesi")
	{
		$iade_durum=3;
	}
	else
	{
		$iade_durum=2;
	}

	$iadeguncelle=$dbsql->update("iade",array(
		'iade_durum' => $iade_durum,
		'kargo_ucret' => htmlspecialchars($_POST['kargo_ucret']),
		'iade_id' => htmlspecialchars($_POST['iade_id'])
	),[
		'columns' => 'iade_id'
	]);

	if ($iadeguncelle['status']) {
		if ($iade_turu=="Para İadesi")
		{
			$sil=$dbsql->delete("siparis","siparis_id",htmlspecialchars($_POST['siparis_id']));
			$silsdetay=$dbsql->delete("siparis_detay","siparis_id",htmlspecialchars($_POST['siparis_id']));
		}
		Header("Location:../production/iadeler.php?durum=ok");
	} else {

		Header("Location:../production/iadeler.php?durum=no");
	}
}

if ($_GET['iade_et']=="ok") {

	date_default_timezone_set('Etc/GMT-3');
	$tarih=date("Y.m.d  H:i:s");

	$iade_guncelle=$dbsql->update("iade",array(
		'iade_durum' => 3,
		'iade_tarihi' => $tarih,
		'iade_id' => htmlspecialchars($_GET['iade_id'])
	),[
		'columns' => 'iade_id'
	]);

	if ($iade_guncelle['status']) {

		Header("Location:../production/iadeler.php?durum=ok");

	} else {

		Header("Location:../production/iadeler.php?durum=no");
	}
}

if (isset($_POST['sikayet_basvuru'])) {

	$kaydet=$dbsql->insert("sikayet",array(
		'sikayet_nedeni' => htmlspecialchars($_POST['sikayet_nedeni']),
		'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
		'kullanici_idsatici' => htmlspecialchars($_POST['kullanici_id'])
	));

	if ($kaydet['status']) {

		Header("Location:../../sikayet_et.php?durum=ok");

	} else {

		Header("Location:../../sikayet_et.php?durum=no");
	}
}

if ($_GET['engelle']=="ok") {

	$sikayet=$dbsql->update("kullanici",array(
		'kullanici_magaza' => 1,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($sikayet['status']) {

		Header("Location:../production/sikayetler.php?durum=ok");

	} else {

		Header("Location:../production/sikayetler.php?durum=no");
	}
}

if ($_GET['mengelle']=="ok") {

	$sikayet=$dbsql->update("kullanici",array(
		'kullanici_magaza' => 1,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($sikayet['status']) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar.php?durum=no");
	}
}

if ($_GET['engel_kaldir']=="ok") {

	$sikayet=$dbsql->update("kullanici",array(
		'kullanici_magaza' => 2,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($sikayet['status']) {

		Header("Location:../production/sikayetler.php?durum=ok");

	} else {

		Header("Location:../production/sikayetler.php?durum=no");
	}
}

if ($_GET['mengel_kaldir']=="ok") {

	$sikayet=$dbsql->update("kullanici",array(
		'kullanici_magaza' => 2,
		'kullanici_id' => htmlspecialchars($_GET['kullanici_id'])
	),[
		'columns' => 'kullanici_id'
	]);

	if ($sikayet['status']) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar.php?durum=no");
	}
}

if ($_GET['sikayetsil']=="ok") {

	$sil=$dbsql->delete("sikayet","sikayet_id",htmlspecialchars($_GET['sikayet_id']));

	if ($sil['status']) {

		header("location:../production/sikayetler.php?sil=ok");

	} else {

		header("location:../production/sikayetler.php?sil=no");

	}
}

if (isset($_POST['kampanyaolustur']))
{
	if ($_FILES['kampanya_logo']['name']=="")
	{
		$duzenle=$dbsql->insert("kampanya",array(
			'kampanya_adi' => htmlspecialchars($_POST['kampanya_adi']),
			'kampanya_aciklama' => htmlspecialchars($_POST['kampanya_aciklama']),
			'kampanya_oran' => htmlspecialchars($_POST['kampanya_oran']),
			'kampanyabaslangic_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabaslangic_tarihi'])),
			'kampanyabitis_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabitis_tarihi'])),
			'kategori_id' =>  htmlspecialchars($_POST['kategori_id']),
			'kullanici_id' => $_SESSION['kullanici_id']
		));
		if ($duzenle['status'])
		{
			header("location:../production/kampanya.php?kampanya=ok");
		}
		else
		{
			header("location:../production/kampanya.php?kampanya=no");
		}
	}

	else
	{
		$duzenle=$dbsql->insert("kampanya",array(
			'kampanya_adi' => htmlspecialchars($_POST['kampanya_adi']),
			'kampanya_aciklama' => htmlspecialchars($_POST['kampanya_aciklama']),
			'kampanya_oran' => htmlspecialchars($_POST['kampanya_oran']),
			'kampanyabaslangic_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabaslangic_tarihi'])),
			'kampanyabitis_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabitis_tarihi'])),
			'kategori_id' =>  htmlspecialchars($_POST['kategori_id']),
			'kullanici_id' => $_SESSION['kullanici_id']
		),[
			'dir' => 'kampanya',
			"file_name" => 'kampanya_logo',
			"dosyalink" => "../production/kampanya.php"
		]);
	}
}

if (isset($_POST['kampanyaduzenle'])) {

	if ($_FILES['kampanya_logo']['size']>0) {

		$duzenle=$dbsql->update("kampanya",array(
			'kampanya_adi' => htmlspecialchars($_POST['kampanya_adi']),
			'kampanya_aciklama' => htmlspecialchars($_POST['kampanya_aciklama']),
			'kampanya_oran' => htmlspecialchars($_POST['kampanya_oran']),
			'kampanyabaslangic_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabaslangic_tarihi'])),
			'kampanyabitis_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabitis_tarihi'])),
			'kategori_id' =>  htmlspecialchars($_POST['kategori_id']),
			'kullanici_id' => $_SESSION['kullanici_id'],
			'kampanya_id' => htmlspecialchars($_POST['kampanya_id'])
			
		),[
			'columns' => 'kampanya_id',
			'dir' => 'kampanya',
			"file_name" => 'kampanya_logo',
			"file_delete" => htmlspecialchars($_POST['eski_yol'])
		]);

		if ($duzenle['status']) {


			$ayarsor=$dbsql->wread("ayar","ayar_id",0);
			$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

			$logo="../../".$ayarcek['ayar_logo'];

			copy($logo,"../../dimg/kampanya/kampanya.png");
			Header("Location:../production/kampanya.php?durum=ok");

		} else {

			Header("Location:../production/kampanya-duzenle.php?durum=hata");
		}

	} else {

//Fotoğraf Yoksa İşlemler

		$duzenle=$dbsql->update("kampanya",array(
			'kampanya_adi' => htmlspecialchars($_POST['kampanya_adi']),
			'kampanya_aciklama' => htmlspecialchars($_POST['kampanya_aciklama']),
			'kampanya_oran' => htmlspecialchars($_POST['kampanya_oran']),
			'kampanyabaslangic_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabaslangic_tarihi'])),
			'kampanyabitis_tarihi' => htmlspecialchars(str_replace('T',' ',$_POST['kampanyabitis_tarihi'])),
			'kategori_id' =>  htmlspecialchars($_POST['kategori_id']),
			'kullanici_id' => $_SESSION['kullanici_id'],
			'kampanya_id' => htmlspecialchars($_POST['kampanya_id'])
		),[
			'columns' => 'kampanya_id'
		]);

		$kampanya_id=htmlspecialchars($_POST['kampanya_id']);

		if ($duzenle['status']) {

			Header("Location:../production/kampanya.php?durum=ok");

		} else {

			Header("Location:../production/kampanya-duzenle.php?durum=hata&kampanya_id=$kampanya_id");
		}
	}
}

if ($_GET['kampanyasil']=="ok") {

	$adet=0;
	$kampanya_sor=$dbsql->wread("kampanya_galeri","kampanya_id",htmlspecialchars($_GET['kampanya_id']));
	while($kampanya_cek=$kampanya_sor->fetch(PDO::FETCH_ASSOC))
	{
		$kampanya=$kampanya_cek['kampanya_resimyol'];
		$dizi=array($kampanya);
		$adet++;
		for ($i = 0; $i < $adet; $i++) 
		{
			$resimsilunlink=$dizi[$i];
			$dosya = "../../$resimsilunlink";
			unlink($dosya);
		}	
	}

	$silkampanya=$dbsql->delete("kampanya","kampanya_id",htmlspecialchars($_GET['kampanya_id']));
	$silk_detay=$dbsql->delete("kampanya_detay","kampanya_id",htmlspecialchars($_GET['kampanya_id']));
	$silk_galeri=$dbsql->delete("kampanya_galeri","kampanya_id",htmlspecialchars($_GET['kampanya_id']));
	if ($silkampanya['status']) {

		$resimsilunlink=htmlspecialchars($_GET['kampanya_resimyol']);
		$dosya = "../../$resimsilunlink";
		if ($dosya!="../../dimg/kampanya/kampanya.png")
			unlink($dosya);
		Header("Location:../production/kampanya.php?durum=ok");

	} else {

		Header("Location:../production/kampanya.php?durum=hata");
	}
}

if ($_GET['kampanya_urun_ekle']=="ok") {

	$kampanya_id=htmlspecialchars($_GET['kampanya_id']);
	$urun_id=htmlspecialchars($_GET['urun_id']);

	$duzenle=$dbsql->insert("kampanya_detay",array(
		'kampanya_id' => htmlspecialchars($kampanya_id),
		'urun_id' => htmlspecialchars($urun_id),
		'durum' => 1,
		'kullanici_id' => $_SESSION['userkullanici_id']
	));

	if ($duzenle['status']) {

		Header("Location:../../kampanya_onay.php?kampanya_id=$kampanya_id");

	} else {

		Header("Location:../../kampanya_onay.php?durum=hata");
	}
}

if ($_GET['kampanya_urun_kaldir']=="ok") {

	$kampanya_id=htmlspecialchars($_GET['kampanya_id']);
	$urun_id=htmlspecialchars($_GET['urun_id']);

	$sil=$dbsql->delete("kampanya_detay","urun_id",htmlspecialchars($urun_id));

	if ($sil['status']) {

		Header("Location:../../kampanya_onay.php?kampanya_id=$kampanya_id");

	} else {

		Header("Location:../../kampanya_onay.php?durum=hata");
	}

}

if ($_GET['kampanyabaslat']=="ok") {


	$kampanyazamansor=$db->prepare("SELECT *,NOW()-kampanyabaslangic_tarihi AS baslamafark,NOW()-kampanyabitis_tarihi AS bitisfark FROM kampanya where kampanya_id=:kampanya_id");
	$kampanyazamansor->execute(array(
		'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
	));
	$kampanyacek=$kampanyazamansor->fetch(PDO::FETCH_ASSOC);
	if ($kampanyacek['baslamafark']>0 && $kampanyacek['bitisfark']<0)
	{
		$kampanyadetaysor=$dbsql->wread("kampanya_detay","kampanya_id",htmlspecialchars($_GET['kampanya_id']));

		while($kampanyadetaycek=$kampanyadetaysor->fetch(PDO::FETCH_ASSOC))
		{

			$urunsor=$dbsql->wread("urun","urun_id",$kampanyadetaycek['urun_id']);
			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
			$duzenle=$dbsql->update("urun",array(
				'urun_fiyat_yedek' => htmlspecialchars($uruncek['urun_fiyat']),
				'urun_id' => $kampanyadetaycek['urun_id']
			),[
				'columns' => 'urun_id'
			]);

			$fiyat=($uruncek['urun_fiyat'])-($uruncek['urun_fiyat']*$kampanyacek['kampanya_oran']/100);

			$duzenlefiyat=$dbsql->update("urun",array(
				'urun_fiyat' => htmlspecialchars($fiyat),
				'urun_id' => $kampanyadetaycek['urun_id']
			),[
				'columns' => 'urun_id'
			]);

			if ($duzenlefiyat['status']) {

				$duzenle=$dbsql->update("kampanya",array(
					'durum' => 1,
					'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
				),[
					'columns' => 'kampanya_id'
				]);

				Header("Location:../production/kampanya.php?durum=ok");

			} else {

				Header("Location:../production/kampanya-duzenle.php?durum=hata");
			}
		}
	}
}

if ($_GET['kampanyabitir']=="ok")
{

	$kampanyazamansor=$db->prepare("SELECT *,NOW()-kampanyabaslangic_tarihi AS baslamafark,NOW()-kampanyabitis_tarihi AS bitisfark FROM kampanya where kampanya_id=:kampanya_id");
	$kampanyazamansor->execute(array(
		'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
	));
	$kampanyacek=$kampanyazamansor->fetch(PDO::FETCH_ASSOC);
	if ($kampanyacek['bitisfark']>0)
	{
		$kampanyadetaysor=$dbsql->wread("kampanya_detay","kampanya_id",htmlspecialchars($_GET['kampanya_id']));

		while($kampanyadetaycek=$kampanyadetaysor->fetch(PDO::FETCH_ASSOC))
		{

			$urunsor=$dbsql->wread("urun","urun_id",$kampanyadetaycek['urun_id']);
			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
			$duzenle=$dbsql->update("urun",array(
				'urun_fiyat' => htmlspecialchars($uruncek['urun_fiyat_yedek']),
				'urun_fiyat_yedek' =>  NULL,
				'urun_id' => $uruncek['urun_id']
			),[
				'columns' => 'urun_id'
			]);


			if ($duzenle['status']) {

				$duzenlekampanya=$dbsql->update("kampanya",array(
					'durum' => 0,
					'kampanya_id' => htmlspecialchars($_GET['kampanya_id'])
				),[
					'columns' => 'kampanya_id'
				]);

				Header("Location:../production/kampanya.php?durum=ok");

			} else {

				Header("Location:../production/kampanya-duzenle.php?durum=hata");
			}
		}
	}
	else
	{
		Header("Location:../production/kampanya.php?durum=no");
	}
}

if(isset($_POST['kampanyafotosil'])) {
	$kampanya_id=htmlspecialchars($_POST['kampanya_id']);
	$checklist =$_POST["kampanyafotosec"];
	foreach($checklist as $list) {
		$cekelim=$db->prepare("SELECT * from kampanya_galeri where kampanya_galeri_id='".$list."'");
		$cekelim->execute();
		$sil=$dbsql->delete("kampanya_galeri","kampanya_galeri_id",htmlspecialchars($list));
		while($resim=$cekelim->fetch(PDO::FETCH_ASSOC)){
			$kampanyafoto_resimyol=$resim["kampanya_resimyol"];
			unlink("../../$kampanyafoto_resimyol");
		}
	}
	if ($sil['status']) {
		Header("Location:../production/kampanya_slider_ekle.php?kampanya_id=$kampanya_id&durum=ok");
	} else {
		Header("Location:../production/kampanya_slider_ekle.php?kampanya_id=$kampanya_id&durum=no");
	}
} 

if ($_GET['favorilere_ekle']=="ok") {

	$urunsor=$dbsql->wread("urun","urun_id",htmlspecialchars($_GET['urun_id']));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
	$url=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'];

	if (isset($_SESSION['userkullanici_id']))
	{


		$favorisor=$dbsql->qwSql("SELECT * from favoriler",array(
			'favoriler.kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
			'favoriler.favori_durum' => 0,
			'favoriler.urun_id' => $uruncek['urun_id']
		));

		if($favorisor->rowCount()>0)
		{
			Header("Location:../../urun-$url?durum=tekrar");

			exit();
		}



		$kaydet=$dbsql->insert("favoriler",array(
			'urun_id' => htmlspecialchars($uruncek['urun_id']),
			'kullanici_id' => htmlspecialchars($_SESSION['userkullanici_id']),
			'favori_fiyat' => htmlspecialchars($uruncek['urun_fiyat'])
		));


		if ($kaydet['status']) {

			Header("Location:../../urun-$url?durum=basarili");

		} else {

			Header("Location:../../urun-$url?durum=basarisiz");
		}

	}
	else
	{
		echo "Üye Olmalısınız...";
		Header("refresh: 1; url=../../urun-$url");
	}
}

if (isset($_POST['hesapekle'])) {

	$kaydet=$dbsql->insert("hesap",array(
		'hesap_adi' => htmlspecialchars($_POST['hesap_adi']),
		'hesap_iban' => htmlspecialchars($_POST['hesap_iban']),
		'kullanici_id' => $_SESSION['kullanici_id']		
	));

	if ($kaydet['status']) {

		Header("Location:../production/hesap.php?durum=ok");

	} else {

		Header("Location:../production/hesap-ekle.php?durum=no");
	}

}

if (isset($_POST['hesapduzenle'])) {

	$hesap_id=htmlspecialchars($_POST['hesap_id']);

	$kaydet=$dbsql->update("hesap",array(
		'hesap_adi' => htmlspecialchars($_POST['hesap_adi']),
		'hesap_iban' => htmlspecialchars($_POST['hesap_iban']),
		'hesap_id' => htmlspecialchars($_POST['hesap_id']),
		'kullanici_id' => $_SESSION['kullanici_id']			
	),[
		'columns' => 'hesap_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/hesap.php?hesap_id=$hesap_id&durum=ok");

	} else {

		Header("Location:../production/hesap-duzenle.php?hesap_id=$hesap_id&durum=no");
	}
}

if ($_GET['hesapsil']=="ok") {

	$sil=$dbsql->delete("hesap","hesap_id",htmlspecialchars($_GET['hesap_id']));
	$silislem=$dbsql->delete("hesap_islem","hesap_id",htmlspecialchars($_GET['hesap_id']));

	if ($sil['status'] && $silislem['status']) {


		Header("Location:../production/hesap.php?durum=ok");

	} else {

		Header("Location:../production/hesap.php?durum=no");
	}

}

if (isset($_POST['cariekle'])) {

	$kaydet=$dbsql->insert("hesap_islem",array(
		'hesap_id' => htmlspecialchars($_POST['hesap_id']),
		'islem_tip' => htmlspecialchars($_POST['islem_tip']),
		'islem_ucret' => htmlspecialchars($_POST['islem_ucret']),	
		'islem_aciklama' => htmlspecialchars($_POST['islem_aciklama']),
		'kullanici_id' => $_SESSION['kullanici_id']	
	));

	if ($kaydet['status']) {

		Header("Location:../production/hesap.php?durum=ok");

	} else {

		Header("Location:../production/cari-islem.php?durum=no");
	}

}

if (isset($_POST['calisanekle'])) {

	$calisansor=$dbsql->wread("kullanici","kullanici_id",htmlspecialchars($_POST['kullanici_id']));
	$calisancek=$calisansor->fetch(PDO::FETCH_ASSOC);

	$kaydet=$dbsql->insert("calisanlar",array(
		'calisan_ad' => htmlspecialchars($calisancek['kullanici_ad']),
		'calisan_soyad' => htmlspecialchars($calisancek['kullanici_soyad']),
		'calisan_maas' => htmlspecialchars($_POST['calisan_maas']),	
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id']),
		'calisan_departman' => htmlspecialchars($_POST['calisan_departman']),	
		'calisan_unvan' => htmlspecialchars($calisancek['kullanici_unvan']),
		'islem_kullanici_id' => htmlspecialchars($_SESSION['kullanici_id'])

	));

	if ($kaydet['status']) {

		Header("Location:../production/calisanlar.php?durum=ok");

	} else {

		Header("Location:../production/calisan-ekle.php?durum=no");
	}

}

if (isset($_POST['calisanduzenle'])) {

	$calisan_id=htmlspecialchars($_POST['calisan_id']);

	$kaydet=$dbsql->update("calisanlar",array(
		'calisan_ad' => htmlspecialchars($_POST['calisan_ad']),
		'calisan_soyad' => htmlspecialchars($_POST['calisan_soyad']),
		'calisan_maas' => htmlspecialchars($_POST['calisan_maas']),
		'calisan_departman' => htmlspecialchars($_POST['calisan_departman']),
		'calisan_unvan' => htmlspecialchars($_POST['calisan_unvan']),
		'calisan_id' => $calisan_id,
		'islem_kullanici_id' => htmlspecialchars($_SESSION['kullanici_id']) 	
	),[
		'columns' => 'calisan_id'
	]);

	if ($kaydet['status']) {

		Header("Location:../production/calisanlar.php?&durum=ok");

	} else {

		Header("Location:../production/calisan-duzenle.php?calisan_id=$calisan_id&durum=no");
	}
}

if ($_GET['calisansil']=="ok") {

	$sil=$dbsql->delete("calisanlar","calisan_id",htmlspecialchars($_GET['calisan_id']));

	if ($sil['status']) {


		Header("Location:../production/calisanlar.php?durum=ok");

	} else {

		Header("Location:../production/calisanlar.php?durum=no");
	}

}

if (isset($_POST['maasode'])) {

	$maaslarsor=$dbsql->read("calisanlar");
	while($maas=$maaslarsor->fetch(PDO::FETCH_ASSOC))
	{
		$kaydet=$dbsql->insert("hesap_islem",array(
			'hesap_id' => htmlspecialchars($_POST['hesap_id']),
			'islem_tip' => "Gider",
			'islem_ucret' => $maas['calisan_maas'],	
			'islem_aciklama' => "MAAŞ Ödeme",
			'kullanici_id' => $_SESSION['kullanici_id']	
		));
	} 

	if ($kaydet['status']) {


		Header("Location:../production/calisanlar.php?durum=ok");

	} else {

		Header("Location:../production/calisanlar.php?durum=no");
	}
}

if ($_GET['hesap_kapa']=="ok") {

	$duzenle=$dbsql->update("hesap",array(
		'durum' => htmlspecialchars($_GET['hesap_one']),
		'hesap_id' => htmlspecialchars($_GET['hesap_id'])
	),[
		'columns' => 'hesap_id'
	]);

	if ($duzenle) {

		Header("Location:../production/hesap.php?durum=ok");

	} else {

		Header("Location:../production/hesap.php?durum=no");
	}
}

if (isset($_POST['siteyetkile'])) {

	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);

	$kaydet=$dbsql->insert("yetki",array(
		'yetki_adi' => htmlspecialchars($_POST['yetki_adi']),
		'kullanici_id' => htmlspecialchars($_POST['kullanici_id']),
		'vkullanici_id' => $_SESSION['kullanici_id']
	));

	if ($kaydet['status']) {


		Header("Location:../production/yetkile.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/yetkile.php?kullanici_id=$kullanici_id&durum=no");
	}
}

if (isset($_POST['yetkiduzenle'])) {

	$kullanici_id=htmlspecialchars($_POST['kullanici_id']);

	$duzenle=$dbsql->update("yetki",array(
		'yetki_adi' => htmlspecialchars($_POST['yetki_adi']),
		'yetki_id' => htmlspecialchars($_POST['yetki_id']),
		'vkullanici_id' => $_SESSION['kullanici_id']
	),[
		'columns' => 'yetki_id'
	]);

	if ($duzenle) {

		Header("Location:../production/yetkile.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/yetkile-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
	}
}

if ($_GET['yetkisil']=="ok") {

	$kullanici_id=htmlspecialchars($_GET['kullanici_id']);

	$sil=$dbsql->delete("yetki","yetki_id",htmlspecialchars($_GET['yetki_id']));

	if ($sil['status']) {


		Header("Location:../production/yetkile.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/yetkile.php?kullanici_id=$kullanici_id&durum=ok");
	}

}

if ($_GET['urunfavoridenkaldir']=="ok") {

	$sil=$dbsql->delete("favoriler","favoriler_id",htmlspecialchars($_GET['favoriler_id']));

	if ($sil['status']) {


		Header("Location:../../favoriler.php");

	} 
}

?>