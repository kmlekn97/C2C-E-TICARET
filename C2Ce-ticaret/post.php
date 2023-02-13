<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$cons=new Sınıf_Islemleri();
$dbsql=new crud();
$dbservice=new DBService($dbsql,$cons);
$kategori=htmlspecialchars($_POST["kategori"]);
echo '<option value="0">'."Bir Alt Kategori Seçiniz...".'</option>';
$arraylistkategori=array();
$kategorilist=new ArrayList($arraylistkategori);
$kategorilist=$dbservice->postaltkategoriListeleme($kategori);
$kategorilist=$kategorilist->toArray();
foreach ($kategorilist as $kategoriler) 
{
    echo $kategoriler;
}                                       
?>