<?php
require_once '../netting/class.crud-guncel.php';
$db5=new crud();
 $login=json_decode($_COOKIE['adminsLogin']);
if (!isset($_SESSION['kullanici_id']) && isset($_COOKIE['adminsLogin'])) {

	$adminsLogin=json_decode($_COOKIE['adminsLogin']);

	$sonuc=$db5->adminsLogin(htmlspecialchars($login->kullanici_mail),htmlspecialchars($_COOKIE['remmeber_me']));

	if (isset($_COOKIE['adminsLogin'])) {
		header("Location:index.php");
		exit;
	}
}

if (!isset($_SESSION['kullanici_id']) && !isset($_COOKIE['adminsLogin'])) {
	header("Location:login.php");
	exit;
}
 ?>