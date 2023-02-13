<?php 

ob_start();
session_start();

include 'baglan.php';

if (!empty($_FILES)) {



	$uploads_dir = '../../dimg/kampanya_slider';
	@$tmp_name = $_FILES['file']["tmp_name"];
	@$name = $_FILES['file']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	include('SimpleImage.php');
	$image = new SimpleImage();
	$image->load($tmp_name);
	$image->resize(540,530);
	$image->save($tmp_name);

	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$kampanya_id=htmlspecialchars($_POST['kampanya_id']);

	$kaydet=$db->prepare("INSERT INTO kampanya_galeri SET
		kampanya_resimyol=:resimyol,
		kampanya_id=:kampanya_id,
		kullanici_id=:kullanici_id
		");
	$insert=$kaydet->execute(array(
		'resimyol' => $refimgyol,
		'kampanya_id' => $kampanya_id,
		'kullanici_id' => $_SESSION['kullanici_id']
		));




}





?>