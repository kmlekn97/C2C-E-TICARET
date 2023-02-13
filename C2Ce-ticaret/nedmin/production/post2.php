<?php
require_once '../netting/baglan.php';
require_once '../netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islem.php';
$cons=new Sınıf_Islem();
$dbsql=new crud();
require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
$altkategori=htmlspecialchars($_POST["altkategori"]);
$arraylistaltkategoridetay=array();
$altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
$altkategoridetaylist=$admindbservices->altkategoridetayListele($altkategori,$kategorialtcek);
$altkategoridetaylist=$altkategoridetaylist->toArray();
foreach ($altkategoridetaylist as $alt_kategori_detay) 
{
   echo '<option value="'.$alt_kategori_detay->get_alt_kategori_detay_id().'">'.$alt_kategori_detay->get_alt_kategori_detay_ad().'</option>';
}

?>