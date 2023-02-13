<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$cons=new Sınıf_Islemleri();
$dbsql=new crud();
$kategori=htmlspecialchars($_POST["kategori"]);
$dbservice=new DBService($dbsql,$cons);
$arraylistaltkategoridetay=array();
$altkategoridetaylist=new ArrayList($arraylistaltkategoridetay);
$altkategoridetaylist=$dbservice->postaltkategoriListeleme($kategori);
$altkategoridetaylist=$altkategoridetaylist->toArray();
foreach ($altkategoridetaylist as $altkategorilerdetay) 
{
    echo $altkategorilerdetay;
}                                            
?>