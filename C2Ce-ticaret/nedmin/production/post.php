<?php
require_once '../netting/baglan.php';
require_once '../netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islem.php';
$cons=new Sınıf_Islem();
$dbsql=new crud();
require_once '../../services/AdminDBServices.php';
$admindbservices=new AdminDBServices($dbsql,$cons);
$kategori=htmlspecialchars($_POST["kategori"]);
$arraylistaltkategori=array();
$altkategorilist=new ArrayList($arraylistaltkategori);
$altkategorilist=$admindbservices->altkategoriSiraliListele($kategori);
$altkategorilist=$altkategorilist->toArray();
foreach ($altkategorilist as $alt_kategori) 
{
   if($adet==0)
   {
       echo '<option value="0">'."Bir Alt Kategori Seçiniz...".'</option>';
       $adet++;
   }
   echo '<option value="'.$alt_kategori->get_alt_kategori_id().'">'.$alt_kategori->get_alt_kategori_ad().'</option>';
}

?>