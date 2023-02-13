<?php
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/netting/class.crud-guncel.php';
require_once 'CLASS/Sınıf_Islemleri.php';
require_once 'services/DBService.php';
$cons=new Sınıf_Islemleri();
$dbsql=new crud();
$dbservice=new DBService($dbsql,$cons);

if ($_POST['durum']==1)
{
	if (isset($_SESSION['userkullanici_id']))
	{
		$karsilastir_id=$_SESSION['userkullanici_id'];
	}
	else if (isset($_COOKIE['karsilastir'])==0)
	{
		$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
		$karsilastir_id = substr(str_shuffle($str), 0, 10);
		setcookie("karsilastir", $karsilastir_id,strtotime("+30 day"),'/'); 
	}
	else
	{
		$karsilastir_id=$_COOKIE['karsilastir'];
	}

	$dbservice->karsilastirmayap($karsilastir_id);
}

if ($_POST['durum']==2)
{
	$dbservice->karsilastirmasil();
}
