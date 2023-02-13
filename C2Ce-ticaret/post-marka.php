<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$dbsql=new crud();
$cons=new Sınıf_Islemleri();
$dbservice=new DBService($dbsql,$cons);
$marka=htmlspecialchars($_POST["marka"]);
$arraylistmarka=array();
$markalist=new ArrayList($arraylistmarka);
$markalist=$dbservice->markapostListele($marka);
$markalist=$markalist->toArray();
foreach ($markalist as $markalar) 
{
    echo $markalar;
}

?>