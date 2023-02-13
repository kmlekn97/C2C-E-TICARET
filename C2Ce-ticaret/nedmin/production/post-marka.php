<?php
require_once '../netting/baglan.php';
require_once '../netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islem.php';
$cons=new Sınıf_Islem();
$dbsql=new crud();
require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
$marka=htmlspecialchars($_POST["marka"]);
$arraylistmarka=array();
$markalist=new ArrayList($arraylistmarka);
$markalist=$admindbservices->markapostArrayListele($marka);
$markalist=$markalist->toArray();
foreach ($markalist as $markalarim) 
{
  if($adet==0)
  {
   echo '<option>'."Bir Marka Seçiniz...".'</option>';
   $adet++;
 }
 if ($markalarim->get_alt_kategori_id()==0)
 {
  $arraylistkategori=array();
  $kategorilist=new ArrayList($arraylistkategori);
  $kategorilist=$admindbservices->kategoriListele($markalarim->get_kategori_id());
  $kategorilist=$kategorilist->toArray();
  foreach ($kategorilist as $kategorim) 
  {

   $kategori=$kategorim->get_kategori_ad();
 }
}
else
{
  $arraylistaltkategori=array();
  $altkategorilist=new ArrayList($arraylistaltkategori);
  $altkategorilist=$admindbservices->altKategoriListelearray($markalarim->get_alt_kategori_id());
  $altkategorilist=$altkategorilist->toArray();
  foreach ($altkategorilist as $alt_kategori) 
  {
   $kategori=$alt_kategori->get_alt_kategori_ad();
 }
}

echo '<option value="'.$markalarim->get_marka_id().'">'.$markalarim->get_marka_adi()." (".$kategori.")".'</option>';
}

?>