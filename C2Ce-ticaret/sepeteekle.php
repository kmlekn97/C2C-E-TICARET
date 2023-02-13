<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$dbsql=new crud();
$cons=new Sınıf_Islemleri();
$dbservice=new DBService($dbsql,$cons);

if($_POST["durum"]==0)
{
	$adet = htmlspecialchars($_POST["sepet"]);
	$sepet_id= htmlspecialchars($_POST["sepet_id"]);
	$sepetcek=$dbservice->sepetpostlistele($sepet_id);
	$stokcek=$dbservice->sepetpoststok($sepetcek['urun_id']);
	$stokadet=0;
	$stokadet=$stokcek['urun_stok'];

	if($stokadet-$adet<=0)
	{
		echo "kalmadı";
		$adet=$stokadet+1;
		exit();
	}
	else
	{
		echo $adet;
		$dbservice->SepetpostGuncelle($adet,$sepet_id);
	}
}
if($_POST["durum"]==1)
{
	$sepet_id=htmlspecialchars($_POST["sepet_id"]);
	$sepetcek=$dbservice->sepetpostlistele($sepet_id);
	$stokcek=$dbservice->sepetpoststok($sepetcek['urun_id']);
	$stokadet=0;
	$stokadet=$stokcek['urun_stok'];

	$adet=$sepetcek['urun_adet'];
	$adet++;
	if($stokadet-$adet<0)
	{
		echo "kalmadı";
		$adet=$stokadet+1;
	}
	else
	{
		echo $adet;
		$dbsql->adetguncelle($adet,$sepet_id);
	}
}
if($_POST["durum"]==2)
{
	$sepet_id=htmlspecialchars($_POST["sepet_id"]);
	$sepetcek=$dbservice->sepetpostlistele($sepet_id);
	$adet=$sepetcek['urun_adet'];
	$adet--;
	if ($adet<1)
		$adet=1;
	else
	{
		echo $adet;
		$dbsql->adetguncelle($adet,$sepet_id);
	}
}

if($_POST["durum"]==3)
{
	$fiyat=0;
	$sepet_id=htmlspecialchars($_POST["sepet_id"]);
	$sepetcek=$dbservice->sepetpostbilgigetir($sepet_id);
	$adet=$sepetcek['urun_adet'];
	$fiyat=number_format($adet * $sepetcek['urun_fiyat'], 2, ',', '.');
	echo $fiyat;
}

if($_POST["durum"]==-1)
{
	$sepet_id=htmlspecialchars($_POST["sepet_id"]);
	$sil=$dbservice->sepetremove($sepet_id);
}