<?php 
require_once 'class.crud-guncel.php';
$dbsql=new crud();

if (isset($_GET['kategori_sirala'])) {
	
	$sonuc=$dbsql->orderUpdate("kategori",$_POST['item'],"kategori_sira","kategori_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}


if (isset($_GET['altkategori_sirala'])) {
	
	$sonuc=$dbsql->orderUpdate("alt_kategori",$_POST['item'],"alt_kategori_sira","alt_kategori_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];
	echo json_encode($returnMsg);
}


if (isset($_GET['altkategoridetay_sirala'])) {
	
	$sonuc=$dbsql->orderUpdate("alt_kategori_detay",$_POST['item'],"alt_kategori_detay_sira","alt_kategori_detay_id");

	// $returnMsg=array();
	$returnMsg= ['islemSonuc' => true, 'islemMsj' => $sonuc['status']];

}
 ?>