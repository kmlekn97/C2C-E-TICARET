<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$cons=new Sınıf_Islemleri();
$dbsql=new crud();
$dbservice=new DBService($dbsql,$cons);
$altkategori=htmlspecialchars($_POST["altkategori"]);
echo '<option value="0">'."Bir Alt Kategori İçerik Seçiniz...".'</option>';
$arraylistaltkategori=array();
$altkategorilist=new ArrayList($arraylistaltkategori);
$altkategorilist=$dbservice->postaltkategoridetayListeleme($altkategori);
$altkategorilist=$altkategorilist->toArray();
foreach ($altkategorilist as $altkategoriler) 
{
    echo $altkategoriler;
}              

?>